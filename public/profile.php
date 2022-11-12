<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    exit(header("Location: ./index.php"));
}

require_once("../app/db/index.php");

if (isset($_POST["mark_unavailable"])) {
    $stmt2 = $conn->prepare("DELETE FROM blood_records WHERE userid = ?");
    $stmt2->bind_param("i", $_SESSION["id"]);
    $stmt2->execute();
    if ($stmt2->affected_rows > 0) {
        header("Location: ./profile.php?status=success&message=Successfully deleted your blood record.");
        return;
    }
    header("Location: ./profile.php?status=failure&message=Couldn't delete that blood record.");
} else {
    if ($stmt = $conn->prepare("SELECT name, bloodgroup, district, email, mobile, lastdonated, dob, admin_verified, donation_count FROM users WHERE id = ? ")) {
        $stmt->bind_param("i", $_SESSION["id"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name, $bloodgroup, $district, $email, $mobile, $lastdonated, $dob, $admin_verified, $donation_count);
        $stmt->fetch();
    }

    if ($stmt1 = $conn->prepare("SELECT id FROM blood_records WHERE userid = ? ")) {
        $stmt1->bind_param("i", $_SESSION["id"]);
        $stmt1->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | BBMS</title>
    <link rel="stylesheet" href="./styles/output.css">
</head>

<body>
    <?php require_once('./include/navbar.php') ?>
    <main class="grid grid-cols-12 min-h-[92vh] max-h-[92vh] bg-gray-200">
        <?php require_once('./include/sidenav.php') ?>
        <main class="relative w-full col-start-3 col-end-13 px-2 sm:px-4 py-4" style="<?php if (isset($_GET["status"])) echo "padding-top: 5rem;"; ?>">
            <?php require_once('./include/notification.php') ?>
            <h1 class="text-center font-bold text-3xl">Your Profile </h1>
            <div class="space-y-4 max-w-xl mx-auto mt-4">
                <div class="flex justify-between items-center space-x-4 w-full">
                    <div class="space-y-1 basis-1/2">
                        <label for="name">Name</label>
                        <input readonly id="name" type="text" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none pointer-events-none border-gray-500" value="<?= $name ?>" />
                    </div>
                    <div class="space-y-1 basis-1/2">
                        <label for="email">Email</label>
                        <input readonly id="email" type="email" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none pointer-events-none border-gray-500" value="<?= $email ?>" />
                    </div>
                </div>
                <div class="flex justify-between items-center space-x-4">
                    <div class="space-y-1 basis-1/2">
                        <label for="mobile">Mobile</label>
                        <input readonly id="mobile" type="tel" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none pointer-events-none border-gray-500" value="<?= $mobile ?>" />
                    </div>
                    <div class="space-y-1 basis-l/2 w-1/2">
                        <label for="dob">Date of birth</label>
                        <input readonly id="dob" type="text" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none pointer-events-none border-gray-500" value="<?= $dob ?>" />
                    </div>
                </div>
                <div class="flex justify-between items-center space-x-4">
                    <div class="space-y-1 basis-1/2">
                        <label for="district">District</label>
                        <input readonly id="district" type="text" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none pointer-events-none border-gray-500" value="<?= $district ?>" />
                    </div>
                    <div class="space-y-1 basis-1/2 max-w-[50%]">
                        <label for="bloodgroup">Blood Group</label>
                        <input readonly id="bloodgroup" type="text" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none pointer-events-none border-gray-500" value="<?= $bloodgroup ?>" />
                    </div>
                </div>
                <?php
                if ($lastdonated !== "") {
                ?>
                    <div>
                        You have donated your blood
                        <?= $donation_count ?>
                        time/s your latest donation was on:
                        <span class="underline">
                            <?= $lastdonated ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <?php
            if ($stmt1->affected_rows > 0) {
            ?>
                <div class="text-center mt-16">
                    <h1 class="font-bold text-3xl">Blood Availability</h1>
                    <p class="font-medium text-gray-500 text-base mt-2 max-w-2xl mx-auto">If the blood you donated last time isn't currently available then please mark the record as unavailable using button below, so that it won't show up on search</p>
                    <form action="./profile.php" method="POST">
                        <button type="submit" name="mark_unavailable" class="bg-blue-400 px-6 py-2 font-semibold text-sm text-white rounded-md mt-6">Mark Unavailable</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </main>
    </main>

</body>

</html>