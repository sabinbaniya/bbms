<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo '
    <nav class="bg-white flex justify-between items-center border-b min-h-[8vh] max-h-[8vh] px-2 sm:px-4">
        <a href="./" class="font-black text-2xl">BBMS</a>
        ';
if (isset($_SESSION['loggedin'])) {
    echo '
                <div class="space-x-4">
                    <p class="inline">Hey, ' . $_SESSION['name'] . '</p>
                    ';

    if (!strpos($_SERVER['REQUEST_URI'], "profile")) {
        echo
        '
<a href="./profile.php" class="underline">Go to Profile</a>
                </div> ';
    } else {
        echo
        '
<a href="./" class="underline">Go to Home Page</a>
                </div> ';
    }
} else {
    echo
    ' <div class="space-x-4">
                    <a href="./login.php" class="underline">Sign In</a>
                    <a href="./signup.php" class="bg-blue-400 px-4 py-2 rounded-lg hover:bg-blue-500 text-white font-bold focus:ring focus:ring-blue-500 focus:ring-offset-2 ">Donate Blood</a>
                </div> 
        ';
}
echo '</nav>';
