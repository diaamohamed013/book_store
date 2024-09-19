<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

// $errors = [];
if (checkRequestMethod('POST') && checkInput("user_name_new")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for name
    if (inpRequire($user_name_new)) {
        $errors['user_name_new'] = "Name is required";
    } elseif (minVal($user_name_new, 3)) {
        $errors['user_name_new'] = "Name must be greater than 3 chars";
    } elseif (maxVal($user_name_new, 25)) {
        $errors['user_name_new'] = "Name must be smaller than 25 chars";
    }

    // for email
    if (inpRequire($user_email_new)) {
        $errors['user_email_new'] = "Email is required";
    } elseif (!emailValid($user_email_new)) {
        $errors['user_email_new'] = "please enter a valid email";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $old_user_name = $_GET['name'];
        $new_user = "UPDATE `users` SET `name` = '$user_name_new', `email` = '$user_email_new' WHERE `name` = '$old_user_name'";
        $result = mysqli_query($conn, $new_user);
        if (mysqli_query($conn, $new_user)) {
            $_SESSION['auth'] = [
                'id' => $id,
                'name' => $user_name_new,
                'email' => $user_email_new
            ];
            $_SESSION['success'] = "لقد تم تعديل الحساب الخاص بك";
        }
    }
    redirect("account_details");
}
