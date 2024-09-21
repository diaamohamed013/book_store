<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

// $errors = [];
if (checkRequestMethod('POST') && checkInput("email")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }

    // for content
    if (inpRequire($password)) {
        $errors['password'] = "Password is required";
    } elseif (minVal($password, 3)) {
        $errors['password'] = "Password must be greater than 3 chars";
    } elseif (maxVal($password, 10)) {
        $errors['password'] = "Password must be smaller than 10 chars";
    }

    // for email
    if (inpRequire($email)) {
        $errors['email'] = "Email is required";
    } elseif (!emailValid($email)) {
        $errors['email'] = "please enter a valid email";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $email = 'saif@gmail.com';
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '1234567' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $_SESSION['dash-auth'] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $email,
            ];
        } else {
            $_SESSION['error']['password'] = "Incorrect Pasword or Email";
        }
    }
    redirect("dashboard");
}
