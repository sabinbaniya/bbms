<?php

if (isset($_GET['status'], $_GET['message'])) {

    if ($_GET['status'] === "failure") {

        echo '<div id="notification" class="absolute w-full top-0 left-0 right-0 bg-red-500 text-center font-bold text-white py-3 px-2 sm:px-4 z-[999]">
            ' .
            $_GET['message']

            . '
    <button class="absolute right-4 bg-red-700 rounded-full w-7 h-7" onclick="document.getElementById(\'notification\').remove()">
    X
    </button>

    </div>';
    }

    if ($_GET["status"] === "success") {

        echo '<div id="notification" class="absolute w-full top-0 left-0 right-0 bg-green-500 text-center font-bold text-white py-3 px-2 sm:px-4 z-[999]">
            ' .
            $_GET['message']

            . '
    <button class="absolute right-4 bg-green-700 rounded-full w-7 h-7" onclick="document.getElementById(\'notification\').remove()">
    X
    </button>

    </div>';
    }
}
