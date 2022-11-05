<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo '
    <nav class="bg-white flex justify-between items-center border-b min-h-[8vh] max-h-[8vh] px-2 sm:px-4">
        <a href="./" class="font-black text-2xl">ADMIN | BBMS</a>
            <div class="space-x-4">
                <p class="inline">Hey, ' . $_SESSION['admin_username'] . '</p>      
                <a href="../logout.php" class="underline">Logout</a>
            </div>
    </nav>';
