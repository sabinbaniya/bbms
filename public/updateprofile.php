<?php
session_start();

if (!isset($_SESSION["loggedin"])) {
    exit(header("Location: ./index.php"));
}

require_once("../app/db/index.php");

// get districts from db 
$stmt = $conn->prepare('SELECT district_name FROM districts');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($district_name);


// get users current info from db to show in form
if ($stmt2 = $conn->prepare("SELECT name, bloodgroup, district, email, mobile, lastdonated, dob FROM users WHERE id = ? ")) {
    $stmt2->bind_param("i", $_SESSION["id"]);
    $stmt2->execute();
    $stmt2->store_result();
    $stmt2->bind_result($name, $bloodgroup, $district, $email, $mobile, $lastdonated, $dob);
    $stmt2->fetch();
}

if (isset($_POST["update"])) {
    if ($stmt3 = $conn->prepare("UPDATE users SET name = ?, email = ? , mobile = ?, dob = ? , district = ? , bloodgroup = ? WHERE id = ?")) {
        echo "hi";

        $stmt3->bind_param("ssssssi", $_POST["name"], $_POST["email"], $_POST["mobile"], $_POST["dob"], $_POST["district"], $_POST["bloodgroup"], $_SESSION["id"]);
        $stmt3->execute();
        if ($stmt3->affected_rows === 1) {
            // success
            header('location: ./updateprofile.php?status=success&message=Profile Updated successfully.');
        } else {
            //failure to update
            header('location: ./updateprofile.php?status=failure&message=Error updating, please try again later.');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | BBMS</title>
    <link rel="stylesheet" href="./styles/output.css">
</head>

<body>
    <?php require_once('./include/navbar.php') ?>
    <main class="grid grid-cols-12 min-h-[92vh] max-h-[92vh] bg-gray-200">
        <?php require_once('./include/sidenav.php') ?>
        <main class="relative w-full col-start-3 col-end-13 px-2 sm:px-4 py-4" style="<?php if (isset($_GET["status"])) echo "padding-top: 5rem;"; ?>">
            <?php require_once('./include/notification.php') ?>
            <h1 class="text-center font-bold text-3xl">Update Profile </h1>
            <form method="POST" class="space-y-4 max-w-xl mx-auto mt-4">
                <div class="flex justify-between items-center space-x-4 w-full">
                    <div class="space-y-1 basis-1/2">
                        <label for="name">Name</label>
                        <input name="name" id="name" type="text" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none border-gray-400" value="<?= $name ?>" />
                    </div>
                    <div class="space-y-1 basis-1/2">
                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none border-gray-400" value="<?= $email ?>" />
                    </div>
                </div>
                <div class="flex justify-between items-center space-x-4">
                    <div class="space-y-1 basis-1/2">
                        <label for="mobile">Mobile</label>
                        <input name="mobile" id="mobile" type="tel" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none border-gray-400" value="<?= $mobile ?>" />
                    </div>
                    <div class="space-y-1 basis-l/2 w-1/2">
                        <label for="dob">Date of birth</label>
                        <input name="dob" id="dob" type="date" class="block text-sm py-3 px-4 rounded-lg w-full border-2 outline-none border-gray-400" value="<?= $dob ?>" />
                    </div>
                </div>
                <div class="flex justify-between items-center space-x-4">
                    <div class="space-y-1 basis-1/2">
                        <label for="district">District</label>
                        <div class="border-2 border-gray-400 px-4 py-2 rounded-md bg-white">
                            <select name="district" id="district" class="pr-6 outline-none w-full">
                                <option disabled value="">Select your district</option>
                                <?php
                                while ($stmt->fetch()) {
                                    if ($district_name === $district) {
                                        echo '<option selected value=' . $district_name . '>' . $district_name . '</option>';
                                    }
                                    echo '<option value=' . $district_name . '>' . $district_name . '</option>';
                                }
                                $conn->close()
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1 basis-1/2 max-w-[50%]">
                        <label for="bloodgroup">Blood Group</label>
                        <div class="border-2 border-gray-400 px-4 py-2 rounded-md bg-white">
                            <select name="bloodgroup" id="bloodgroup" class="pr-4 outline-none w-full">
                                <option disabled value="">Select blood group</option>
                                <option <?php if ($bloodgroup === "O+") echo "selected"; ?> value="O+">O +ve</option>
                                <option <?php if ($bloodgroup === "O-") echo "selected"; ?> value="O-">O -ve</option>
                                <option <?php if ($bloodgroup === "A+") echo "selected"; ?> value="A+">A +ve</option>
                                <option <?php if ($bloodgroup === "A-") echo "selected"; ?> value="A-">A -ve</option>
                                <option <?php if ($bloodgroup === "B+") echo "selected"; ?> value="B+">B +ve</option>
                                <option <?php if ($bloodgroup === "B-") echo "selected"; ?> value="B-">B -ve</option>
                                <option <?php if ($bloodgroup === "AB+") echo "selected"; ?> value="AB+">AB +ve</option>
                                <option <?php if ($bloodgroup === "AB-") echo "selected"; ?> value="AB-">AB -ve</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-12">
                    <button name="update" class="font-semibold py-2 px-8 text-sm text-white bg-blue-500 rounded-md">Update</button>
                    <a href="./profile.php" class="font-semibold mt-4 text-sm bg-gray-500 text-white py-2 px-4 rounded-md">Cancel</a>
                </div>
            </form>

        </main>
    </main>

</body>

</html>