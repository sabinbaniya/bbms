<?php

require_once("../../../db/index.php");

if (!isset($_POST["password"], $_POST["username"])) {
    // redirect if $_POST[passowrd is not set] i.e. directly accessing from url bar
    header("Location: ../../../../public/index.php");
    exit();
}

session_start();

if ($stmt = $conn->prepare('SELECT username, id, password FROM admin WHERE username = ? LIMIT 1')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username, $id, $password);
        $stmt->fetch();

        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['admin_loggedin'] = TRUE;
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_id'] = $id;

            header("Location: ../../../../public/admin/index.php?status=success&message=Successfully logged in");
        } else {
            header("Location: ../../../../public/admin/login.php?status=failure&message=Password is incorrect");
        }
    } else {
        header("Location: ../../../../public/admin/login.php?status=failure&message=User not found");
    }
    $stmt->close();
}
