<?php
session_start();
if (isset($_SESSION['admin_loggedin'])) {
    header('Location: ./');
}

// echo password_hash("123456789", PASSWORD_DEFAULT)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BBMS</title>
    <link rel="stylesheet" href="../styles/output.css">
</head>

<body class="overflow-hidden">
    <div class="relative min-h-screen bg-emerald-400 flex justify-center items-center overflow-hidden">
        <?php require_once('../include/notification.php') ?>
        <div class="absolute w-60 h-60 rounded-xl bg-emerald-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block">
        </div>
        <div class="absolute w-48 h-48 rounded-xl bg-emerald-300 -bottom-6 -right-10 transform rotate-12 hidden md:block">
        </div>
        <form method="POST" action="../../app/controllers/auth/admin/index.php" class="py-12 px-12 bg-white rounded-2xl shadow-xl z-20">
            <div>
                <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">Hello, Admin 👋</h1>
                <p class="w-80 text-center text-sm mb-8 text-gray-700 tracking-wide cursor-pointer">Sign in to your Admin Account</p>
            </div>
            <div class="space-y-4">
                <div class="space-y-1">
                    <label for="username">Username</label>
                    <input required autocomplete="off" name="username" id="username" type="text" placeholder="Username" autocomplete="off" class="transition-all block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-emerald-400" />
                </div>
                <div class="space-y-1">
                    <label for="password">Password</label>
                    <input required autocomplete="off" name="password" id="password" type="password" placeholder="Password" autocomplete="off" class="transition-all block text-sm py-3 px-4 rounded-lg w-full border outline-none focus:border-2 focus:border-emerald-400" />
                </div>
            </div>
            <div class="flex flex-col justify-center text-center mt-6">
                <button class="py-3 w-full text-xl text-white bg-emerald-400 rounded-2xl">Sign in</button>
            </div>
        </form>
        <div class="w-40 h-40 absolute bg-emerald-300 rounded-full top-0 right-12 hidden md:block"></div>
        <div class="w-20 h-40 absolute bg-emerald-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block">
        </div>
    </div>
</body>

</html>