<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

$errors = [];

if (checkRequestMethod('POST') && checkInput("email")) {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Validate password
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 3) {
        $errors['password'] = "Password must be at least 3 characters long";
    } elseif (strlen($password) > 10) {
        $errors['password'] = "Password must be no more than 10 characters long";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['auth'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $email,
            ];
        } else {
            $_SESSION['error']['password'] = "Incorrect Email or Password";
        }
    }
    redirect("account");
}