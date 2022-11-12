<?php
require_once("../app/db/index.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Blood | BBMS</title>
    <link rel="stylesheet" href="./styles/output.css">
</head>

<body>
    <?php require_once("./include/navbar.php"); ?>
    <main class="relative min-h-[92vh] max-h-[92vh] px-2 sm:px-4 bg-gray-200 grid place-items-center">
        <div class="-mt-28 text-center space-y-8 max-w-2xl mx-auto">

            <?php require_once('./include/notification.php') ?>
            <?php
            // if user has clicked donate button, this code is triggered and inserts the values in the db
            if (isset($_POST['donate'], $_POST['bloodgroup'])) {
                // echo "here";
                if ($stmt = $conn->prepare('INSERT INTO blood_records (userid, bloodgroup, district) VALUES (?,?,?)')) {
                    $stmt->bind_param('iss', $_SESSION['id'], $_POST['bloodgroup'], $_POST['district']);
                    $stmt->execute();
                    // var_dump($stmt);
                    if ($stmt->affected_rows > 0) {
                        if ($stmt1 = $conn->prepare('UPDATE users SET lastdonated=? , donation_count=donation_count+1 WHERE id=?')) {
                            $stmt1->bind_param('si',  date('Y-m-d'), $_SESSION['id']);
                            $stmt1->execute();
                            header('location: ./donate.php?status=success&message=You have succesfully donated blood. ');
                        } else {
                            header('location: ./donate.php?status=failure&message=Error donating blood please try again later. ');
                        }
                    } else {
                        header('location: ./donate.php?status=failure&message=Error donating blood please try again later. ');
                    }
                }
            }

            ?>

            <?php
            // checks if user can donate the blood
            if ($stmt = $conn->prepare('SELECT district, bloodgroup, lastdonated FROM users WHERE id = ? LIMIT 1')) {
                $stmt->bind_param('i', $_SESSION['id']);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($district, $bloodgroup, $lastdonated);
                    $stmt->fetch();
                    if ($lastdonated === "") {
                        //last donate is empty means the user is here for the first time
            ?>
                        <div class="text-3xl font-bold">Great, it's your first time donating blood.</div>
                        <form action="./donate.php" method="POST">
                            <input type="hidden" name="bloodgroup" value=<?= $bloodgroup ?> />
                            <input type="hidden" name="district" value=<?= $district ?> />
                            <button name="donate" class="bg-blue-400 hover:bg-blue-500 font-bold text-white px-4 py-2 my-4 rounded-lg">Click here to Donate blood</button>
                        </form>
                        <p class="text-gray-600 font-bold text-sm">Note: You can donate blood every three months</p>
                        <?php
                    } else if ($lastdonated) {
                        $donatedDate =  date_create($lastdonated);
                        $todaysDate =  date_create('now');
                        $diff = date_diff($donatedDate, $todaysDate);

                        if ($diff->days > 90) {
                            // 3months have gone since the user has donated blood and we can show donate blood option
                        ?>
                            <div class="text-3xl font-bold">Great, it's been more than 90 days since you donated your blood.</div>
                            <form action="./donate.php" method="POST">
                                <input type="hidden" name="bloodgroup" value=<?= $bloodgroup ?> />
                                <input type="hidden" name="district" value=<?= $district ?> />
                                <button name="donate" class="bg-blue-400 hover:bg-blue-500 font-bold text-white px-4 py-2 my-4 rounded-lg">Donate blood again</button>
                            </form>
                            <p class="text-gray-600 font-bold text-sm">Note: You can donate blood every three months</p>
                        <?php
                        } else {
                            // 3months haven't gone by and we need to show them message to wait for remaining days
                        ?>
                            <div class="text-3xl font-bold">Oops ! Looks like you have to wait <?= 90 - $diff->days  ?> days more before you can donate blood again</div>
                            <p>You donated your blood last time in: <?= $lastdonated ?></p>
                            <p class="text-gray-600 font-bold text-sm">Note: You can donate blood every three months</p>
            <?php
                        }
                    }
                }
                $stmt->close();
            }
            ?>
        </div>

    </main>
</body>

</html>