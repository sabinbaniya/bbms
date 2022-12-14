<?php

// redirect to login if not logged in

session_start();

if (!isset($_SESSION["admin_loggedin"])) {
    header("Location: ./login.php");
}
require_once('../../app/db/index.php');

if ($stmt1 =
    $conn->prepare('SELECT id, name, email, mobile, bloodgroup, district, lastdonated, dob, timestamps, admin_verified, donation_count FROM users ')
) {
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($id, $name, $email, $mobile, $bloodgroup, $district, $lastdonated, $dob, $timestamps, $admin_verified, $donation_count);
}

if (isset($_GET["id"]) && isset($_GET["action"])) {
    if ($_GET["action"] === "delete") {
        if ($stmt2 = $conn->prepare("DELETE FROM users WHERE id = ?")) {
            $stmt2->bind_param("i", $_GET["id"]);
            $stmt2->execute();
            if ($stmt2->affected_rows == 1) {
                $stmt3 = $conn->prepare("DELETE FROM blood_records WHERE userid = ?");
                $stmt3->bind_param("i", $_GET["id"]);
                $stmt3->execute();
                header("Location: ./manage-users.php?status=success&message=Successfully deleted 1 user and their blood records.");
                return;
            }
            header("Location: ./manage-users.php?status=failure&message=Couldn't delete that user.");
        }
    } elseif ($_GET["action"] === "verify") {
        $stmt2 = $conn->prepare("UPDATE users SET admin_verified = ? WHERE id = ?");
        $val = 1;
        $stmt2->bind_param("ii", $val, $_GET["id"]);
        $stmt2->execute();
        header("Location: ./manage-users.php?status=success&message=Successfully verified user");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | BBMS</title>
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
                <span class="text-xl font-bold">No User Records Found</span>
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
                        <th>Last Donated</th>
                        <th>Date of birth</th>
                        <th>User Since</th>
                        <th>Verified User</th>
                        <th>Donation Count</th>
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
                                    <td>' . $bloodgroup . '</td>
                                    <td>' . $district . '</td>
                                    <td>' . $lastdonated . '</td>
                                    <td>' . $dob . '</td>
                                    <td>' . $timestamps . '</td>
                                    <td>' . ($admin_verified ? "Yes" : "No") . '</td>
                                    <td>' . $donation_count . '</td>
                                    <td style="width: 100px">
                                        <a class="hover:underline" href="./manage-users.php?id=' . $id . '&action=delete">Delete</a>
                                        </br>
                                        ' . (!$admin_verified ? "<a class='hover:underline' href=./manage-users.php?id=$id&action=verify>Verify User</a>" : "") . '
                                    </td>
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