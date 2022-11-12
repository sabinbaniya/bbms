<?php
require_once('../app/db/index.php');
$stmt = $conn->prepare('SELECT district_name FROM districts');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($district_name);

if (isset($_POST['search'])) {
    if (isset($_POST['district']) && isset($_POST['bloodgroup'])) {
        $stmt1 = $conn->prepare('SELECT users.name AS name, users.email AS email, users.mobile AS mobile, users.donation_count AS donation_count, users.admin_verified AS admin_verified, blood_records.bloodgroup AS bloodgroup, blood_records.district AS district FROM blood_records INNER JOIN users ON users.id = blood_records.userid AND blood_records.district = ? AND blood_records.bloodgroup = ?');
        $stmt1->bind_param("ss", $_POST["district"], $_POST["bloodgroup"]);
    } else if (isset($_POST['district'])) {
        $stmt1 = $conn->prepare('SELECT users.name AS name, users.email AS email, users.mobile AS mobile, users.donation_count AS donation_count, users.admin_verified AS admin_verified, blood_records.bloodgroup AS bloodgroup, blood_records.district AS district FROM blood_records INNER JOIN users ON users.id = blood_records.userid AND blood_records.district = ?');
        $stmt1->bind_param("s", $_POST["district"]);
    } else if (isset($_POST['bloodgroup'])) {
        $stmt1 = $conn->prepare('SELECT users.name AS name, users.email AS email, users.mobile AS mobile, users.donation_count AS donation_count, users.admin_verified AS admin_verified, blood_records.bloodgroup AS bloodgroup, blood_records.district AS district FROM blood_records INNER JOIN users ON users.id = blood_records.userid AND blood_records.bloodgroup = ?');
        $stmt1->bind_param("s", $_POST["bloodgroup"]);
    } else if (!isset($_POST["district"]) && !isset($_POST["bloodgroup"])) {
        $stmt1 = $conn->prepare('SELECT users.name AS name, users.email AS email, users.mobile AS mobile, users.donation_count AS donation_count, users.admin_verified AS admin_verified, blood_records.bloodgroup AS bloodgroup, blood_records.district AS district FROM blood_records LEFT JOIN users ON users.id = blood_records.userid');
    }

    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($name, $email, $mobile, $donation_count, $admin_verified, $bloodgroup, $district);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | BBMS</title>
    <link rel="stylesheet" href="./styles/output.css">
</head>

<body>
    <?php require_once("./include/navbar.php") ?>
    <main class="relative min-h-[92vh] max-h-[92vh] w-full bg-gray-200 px-2 sm:px-4 grid place-items-center bg-center bg-no-repeat bg-cover" style="background-image: url('./assets/bloodcover.webp');">
        <?php require_once("./include/notification.php") ?>
        <div class="-mt-28">
            <h1 class="text-center my-4 text-3xl font-bold text-white drop-shadow-lg">Search for available Bloods</h1>
            <form action="../public/" method="POST" class="pt-4">
                <div class="flex justify-between items-center space-x-4 max-w-3xl mx-auto w-full">
                    <div class="space-y-1 basis-1/2">
                        <label for="district " class="text-white drop-shadow-lg">District</label>
                        <div class="border border-gray-400 px-4 py-2 rounded-md bg-white">
                            <select name="district" id="district" class="pr-6 outline-none w-full">
                                <option selected disabled value="">Select your district</option>
                                <?php
                                while ($stmt->fetch()) {
                                    echo '<option value=' . $district_name . '>' . $district_name . '</option>';
                                }
                                $conn->close()
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1 basis-1/2 max-w-[50%]">
                        <label for="bloodgroup " class="text-white drop-shadow-lg">Blood Group</label>
                        <div class="border border-gray-400 px-4 py-2 rounded-md bg-white">
                            <select name="bloodgroup" id="bloodgroup" class="pr-4 outline-none w-full">
                                <option selected disabled value="">Select blood group</option>
                                <option value="O+">O +ve</option>
                                <option value="O-">O -ve</option>
                                <option value="A+">A +ve</option>
                                <option value="A-">A -ve</option>
                                <option value="B+">B +ve</option>
                                <option value="B-">B -ve</option>
                                <option value="AB+">AB +ve</option>
                                <option value="AB-">AB -ve</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" name="search" class="bg-blue-400 text-white rounded-lg w-full py-2 my-4 hover:bg-blue-500 focus:ring focus:ring-blue-500 focus:ring-offset-2 font-bold">Search</button>
                </div>
            </form>
            <div class=" max-h-[50vh] overflow-auto">
                <?php
                if (isset($_POST['search'])) {
                    if ($stmt1->num_rows() === 0) {
                ?>
                        <p class="text-lg text-center font-semibold underline">No Results for bloodgroups
                            <?php if (isset($_POST["bloodgroup"]))
                                echo $_POST["bloodgroup"];
                            ?>
                            <?php if (isset($_POST["district"]))
                                echo " in " . $_POST["district"];
                            ?>
                        </p>
                    <?php
                    } else {
                    ?>
                        <table id="results" class="max-w-2xl">
                            <tr>
                                <th>S. N</th>
                                <th>Donor Name</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                                <th>Blood Group</th>
                                <th>District</th>
                                <th>Donation Count</th>
                                <th>Admin Verified</th>
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
                                    <td>' . $donation_count . '</td>
                                    <td>' . ($admin_verified ? "Verified" : "Not verified") . '</td>
                                </tr>';
                                $count++;
                            }
                            ?>
                        </table>

                <?php }
                }
                ?>
            </div>

        </div>

    </main>
</body>

</html>