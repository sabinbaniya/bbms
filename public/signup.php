<?php

session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: ./');
}

require_once('../app/db/index.php');
$stmt = $conn->prepare('SELECT district_name FROM districts');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($district_name);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account | BBMS</title>
    <link rel="stylesheet" href="./styles/output.css">
</head>

<body class="overflow-hidden">
    <div class="relative min-h-screen bg-blue-400 flex justify-center items-center">
        <?php require_once("./include/notification.php") ?>
        <div class="absolute w-60 h-60 rounded-xl bg-blue-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block">
        </div>
        <div class="absolute w-48 h-48 rounded-xl bg-blue-300 -bottom-6 -right-10 transform rotate-12 hidden md:block">
        </div>
        <form method="POST" action="../app/controllers/auth/index.php" class="py-12 px-12 bg-white rounded-2xl shadow-xl z-20">
            <div>
                <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">Create An Account</h1>
                <p class="text-center text-sm mb-8 text-gray-700 tracking-wide cursor-pointer">Create a BBMS Account for you</p>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center space-x-4 w-full">
                    <div class="space-y-1 basis-1/2">
                        <label for="name">Name</label>
                        <input required name="name" id="name" type="text" placeholder="Name" autocomplete="off" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-blue-400" />
                    </div>
                    <div class="space-y-1 basis-1/2">
                        <label for="email">Email</label>
                        <input required name="email" id="email" type="email" placeholder="Email Address" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-blue-400" />
                    </div>
                </div>
                <div class="flex justify-between items-center space-x-4">
                    <div class="space-y-1 basis-1/2">
                        <label for="mobile">Mobile</label>
                        <input required name="mobile" id="mobile" type="tel" placeholder="Mobile" autocomplete="off" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-blue-400" />
                    </div>
                    <div class="space-y-1 basis-l/2 w-1/2">
                        <label for="dob">Date of birth</label>
                        <input required name="dob" id="dob" type="date" placeholder="Password" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-blue-400" />
                    </div>
                </div>
                <div class="flex justify-between items-center space-x-4">
                    <div class="space-y-1 basis-1/2">
                        <label for="district">District</label>
                        <div class="border border-blue-200 px-4 py-2 rounded-md">
                            <select required name="district" id="district" class="pr-6 outline-none">
                                <option selected disabled value="">Select your district</option>
                                <?php
                                while ($stmt->fetch()) {
                                    echo '<option value=' . $district_name . '>' . $district_name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-1 basis-1/2 max-w-[50%]">
                        <label for="bloodgroup">Blood Group</label>
                        <div class="border border-blue-200 px-4 py-2 rounded-md">
                            <select required name="bloodgroup" id="bloodgroup" class="pr-4 outline-none">
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
                <div class="space-y-1">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" placeholder="Password" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-blue-400" />
                </div>
            </div>
            <div class="flex flex-col justify-center text-center mt-6">
                <button class="py-3 w-full text-xl text-white bg-blue-400 rounded-2xl">Create Account</button>
                <a href="./login.php" class="mt-4 text-sm">Already Have An Account? <span class="underline cursor-pointer"> Sign In</span>
                </a>
            </div>
        </form>
        <div class="w-40 h-40 absolute bg-blue-300 rounded-full top-0 right-12 hidden md:block"></div>
        <div class="w-20 h-40 absolute bg-blue-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block">
        </div>
    </div>
</body>

</html>