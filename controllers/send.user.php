<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

// $errors = [];
if (checkRequestMethod('POST') && checkInput("name")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for name
    if (inpRequire($name)) {
        $errors['name'] = "Name is required";
    } elseif (minVal($name, 3)) {
        $errors['name'] = "Name must be greater than 3 chars";
    } elseif (maxVal($name, 25)) {
        $errors['name'] = "Name must be smaller than 25 chars";
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
        $id = mysqli_insert_id($conn);
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('$name','$email','$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['auth'] = [
                'id' => $id,
                'name' => $name,
                'email' => $email
            ];
            $_SESSION['success'] = "Your data has been sent successfully";
        }
    }
    redirect("account");
}
