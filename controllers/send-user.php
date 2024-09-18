<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

// $errors = [];
if (checkRequestMethod('POST') && checkInput("user_name")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for name
    if (inpRequire($user_name)) {
        $errors['user_name'] = "Name is required";
    } elseif (minVal($user_name, 3)) {
        $errors['user_name'] = "Name must be greater than 3 chars";
    } elseif (maxVal($user_name, 25)) {
        $errors['user_name'] = "Name must be smaller than 25 chars";
    }

    // for content
    if (inpRequire($user_password)) {
        $errors['user_password'] = "Password is required";
    } elseif (minVal($user_password, 3)) {
        $errors['user_password'] = "Password must be greater than 3 chars";
    } elseif (maxVal($user_password, 10)) {
        $errors['user_password'] = "Password must be smaller than 10 chars";
    }

    // for email
    if (inpRequire($user_email)) {
        $errors['user_email'] = "Email is required";
    } elseif (!emailValid($user_email)) {
        $errors['user_email'] = "please enter a valid email";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
        redirect("account");
    } else {
        $id = mysqli_insert_id($conn);
        $user_password = password_hash($user_password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$user_name','$user_email','$user_password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['auth'] = [
                'id' => $id,
                'name' => $user_name,
                'email' => $user_email
            ];
            $_SESSION['success'] = "Your data has been sent successfully";
        }
        redirect("home");
    }
    
}
