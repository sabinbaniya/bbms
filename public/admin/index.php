<?php

// redirect to login if not logged in

session_start();

if (!isset($_SESSION["admin_loggedin"])) {
    header("Location: ./login.php");
}
require_once('../../app/db/index.php');
$stmt = $conn->prepare('SELECT id FROM users');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id);

$stmt1 = $conn->prepare('SELECT id FROM blood_records');
$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($record_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | BBMS</title>
    <link rel="stylesheet" href="../styles/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php require_once("../include/admin/navbar.php") ?>
    <main class="relative min-h-[92vh] max-h-[92vh] w-full bg-gray-200 px-2 sm:px-4 grid place-items-center bg-center bg-no-repeat bg-cover">
        <?php require_once("../include/notification.php") ?>
        <div>
            <p class="text-3xl font-bold">What would you like to do, today?</p>
            <div class="flex justify-between items-center space-x-8 my-8">
                <a href="./manage-records.php" class="block relative w-80 h-40 bg-emerald-600 rounded-xl hover:scale-105 transition-all">
                    <i class="fa-solid fa-list-check text-emerald-400 text-7xl absolute top-4 left-4"></i>
                    <p class="absolute bottom-4 left-4 text-xl text-emerald-200 font-bold">Manage Blood Records</p>
                </a>
                <a href="./manage-users.php" class="block relative w-80 h-40 bg-orange-600 rounded-xl hover:scale-105 transition-all">
                    <i class="fa-solid fa-users text-orange-400 text-7xl absolute top-4 left-4"></i>
                    <p class="absolute bottom-4 left-4 text-xl text-orange-200 font-bold">Manage Users</p>
                </a>
            </div>
        </div>
        <div class="-mt-32">
            <p class="text-3xl font-bold">Stats</p>
            <div class="flex justify-between items-center space-x-8 my-8">
                <p class="block relative w-80 h-40 bg-purple-600 rounded-xl">
                    <i class="fa-solid fa-user-plus text-purple-400 text-7xl absolute top-4 left-4"></i>
                    <span class="absolute -top-6 right-8 text-[128px] font-bold text-purple-900">
                        <?= $stmt->num_rows() ?>
                    </span>
                    <span class="absolute bottom-4 left-4 text-xl text-purple-200 font-bold z-10">Total Users</span>
                </p>
                <p class="block relative w-80 h-40 bg-red-600 rounded-xl">
                    <i class="fa-solid fa-hand-holding-droplet text-red-400 text-7xl absolute top-4 left-4"></i>
                    <span class="absolute -top-6 right-6 text-[128px] font-bold text-red-800">
                        <?= $stmt1->num_rows() ?>
                    </span>
                    <span class="absolute bottom-4 left-4 text-xl text-red-200 font-bold">Total Donations</span>
                </p>
            </div>
        </div>
    </main>
</body>

</html>