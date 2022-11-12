<?php

// redirect to login if not logged in

session_start();

if (!isset($_SESSION["admin_loggedin"])) {
    header("Location: ./login.php");
}
require_once('../../app/db/index.php');

$stmt1 = $conn->prepare('SELECT 
    users.name AS name,
    users.email AS email,
    users.mobile AS mobile,
    users.donation_count AS dc,
    users.admin_verified AS av,
    blood_records.id AS bid,
    blood_records.bloodgroup AS bg,
    blood_records.district AS dist,
    blood_records.timestamps AS donated_on
    FROM users RIGHT JOIN blood_records ON users.id = blood_records.userid');

$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($name, $email, $mobile, $dc, $av, $bid, $bg, $dist, $donated_on);

if (isset($_GET["id"])) {
    if ($stmt2 = $conn->prepare("DELETE FROM blood_records WHERE id = ?")) {
        $stmt2->bind_param("i", $_GET["id"]);
        $stmt2->execute();
        if ($stmt2->affected_rows == 1) {
            header("Location: ./manage-records.php?status=success&message=Successfully deleted 1 blood record.");
            return;
        }
        header("Location: ./manage-records.php?status=failure&message=Couldn't delete that blood record.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Records | BBMS</title>
    <link rel="stylesheet" href="../styles/output.css">
</head>

<body>
    <?php require_once("../include/admin/navbar.php") ?>
    <main class="relative min-h-[92vh] max-h-[92vh] w-full bg-gray-200 px-2 sm:px-4 grid place-items-center bg-center bg-no-repeat bg-cover">
        <?php require_once("../include/notification.php") ?>
        <div class="max-h-[80vh] overflow-auto">
            <?php
            if ($stmt1->num_rows() === 0) {
            ?>
                <span class="text-xl font-bold">No Blood Records Found</span>
            <?php
            } else {
            ?>
                <table id="results" class="max-w-7xl">
                    <tr>
                        <th>S. No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Blood Group</th>
                        <th>District</th>
                        <th>Donated on</th>
                        <th>Donation Count</th>
                        <th>Verified User</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $count = 1;
                    while ($stmt1->fetch()) {
                        echo '<tr>
                                    <td>' . $count . '</td>
                                    <td>' . $name . '</td>
                                    <td>' . $email . '</td>
                                    <td>' . $mobile . '</td>
                                    <td>' . $bg . '</td>
                                    <td>' . $dist . '</td>
                                    <td>' . $donated_on . '</td>
                                    <td>' . $dc . '</td>
                                    <td>' . ($av ? "Yes" : "No") . '</td>
                                    <td><a class="hover:underline" href="./manage-records.php?id=' . $bid . '">Delete</a></td>
                                </tr>';

                        $count++;
                    }
                    ?>
                </table>
            <?php } ?>
        </div>

    </main>
</body>

</html>