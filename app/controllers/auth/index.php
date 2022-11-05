<?php

require_once("../../db/index.php");

if (!isset($_POST["password"], $_POST["email"])) {
    // redirect if $_POST[passowrd is not set] i.e. directly accessing from url bar
    header("Location: ../../../public/index.php");
    exit();
}

session_start();

if (!isset($_POST["name"])) {
    //login code
    if ($stmt = $conn->prepare('SELECT name, id, password FROM users WHERE email = ? LIMIT 1')) {
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($name, $id, $password);
            $stmt->fetch();

            if (password_verify($_POST['password'], $password)) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $name;
                $_SESSION['id'] = $id;

                header("Location: ../../../public/index.php?status=success&message=Successfully logged in");
            } else {
                header("Location: ../../../public/login.php?status=failure&message=Password is incorrect");
            }
        } else {
            header("Location: ../../../public/login.php?status=faliure&message=User not found");
        }
        $stmt->close();
    }
} else {
    // signup code 

    // check if a user is entering an already used email or username
    if ($stmt = $conn->prepare("SELECT email FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param("s", $_POST["email"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($email);
        $stmt->fetch();

        if ($_POST["email"] === $email) {
            header("Location: ../../../public/signup.php?status=failure&message=Email already in use, please use another one.");
            exit();
        }
    }

    // create the user
    if ($stmt = $conn->prepare('INSERT INTO users (name, bloodgroup, district, email, mobile, password, dob) VALUES (?,?,?,?,?,?,?)')) {
        $pw = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt->bind_param('sssssss', $_POST['name'], $_POST['bloodgroup'], $_POST['district'], $_POST["email"], $_POST["mobile"], $pw, $_POST["dob"]);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            //login code
            if ($stmt = $conn->prepare('SELECT name, id, password FROM users WHERE email = ? LIMIT 1')) {
                $stmt->bind_param('s', $_POST['email']);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $stmt->bind_result($name, $id, $password);
                    $stmt->fetch();

                    if (password_verify($_POST['password'], $password)) {
                        session_regenerate_id();
                        $_SESSION['loggedin'] = TRUE;
                        $_SESSION['name'] = $name;
                        $_SESSION['id'] = $id;

                        header("Location: ../../../public/index.php?status=success&message=Successfully created new account");
                    }
                } else {
                    header("Location: ../../../public/login.php?status=failure&message=User not found");
                }
                $stmt->close();
            }

            exit();
        } else {
            header("Location: ../../../public/signup.php?status=failure&message=Sorry, your account couldn't be created");
            exit();
        }
        $stmt->close();
        $conn->close();
    }
}
