<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

// $errors = [];
if (checkRequestMethod('POST') && checkInput("old_pass")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for old pass
    if (inpRequire($old_pass)) {
        $errors['old_pass'] = "Password is required";
    } elseif (minVal($old_pass, 3)) {
        $errors['old_pass'] = "Password must be greater than 3 chars";
    } elseif (maxVal($old_pass, 10)) {
        $errors['old_pass'] = "Password must be smaller than 10 chars";
    }

    // for new pass
    if (inpRequire(input: $new_pass)) {
        $errors['new_pass'] = "Password is required";
    } elseif (minVal($new_pass, 3)) {
        $errors['new_pass'] = "Password must be greater than 3 chars";
    } elseif (maxVal($new_pass, 10)) {
        $errors['new_pass'] = "Password must be smaller than 10 chars";
    }

    // for new pass 2
    if (inpRequire($new_pass_cur)) {
        $errors['new_pass_cur'] = "Password is required";
    } elseif (minVal($new_pass_cur, 3)) {
        $errors['new_pass_cur'] = "Password must be greater than 3 chars";
    } elseif (maxVal($new_pass_cur, 10)) {
        $errors['new_pass_cur'] = "Password must be smaller than 10 chars";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $user_name = $_GET['name'];
        if ($new_pass == $new_pass_cur) {
            $old_pass = password_hash($old_pass, PASSWORD_DEFAULT);
            $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $new_pass_cur = password_hash($new_pass_cur, PASSWORD_DEFAULT);
            $new_user_password = "UPDATE `users` SET `password` = '$new_pass' WHERE `name` = '$user_name'";
            $result = mysqli_query($conn, $new_user_password);
            if ($result) {
                $_SESSION['success'] = "لقد تم تعديل كلمة السر الخاصة بك";
            } else {
                $_SESSION['error'] = "برجاء المحاولة مرة آخرى";
            }
        } else {
            $errors['new_pass_cur'] = "برجاء التأكد من البيانات";
        }
    }
    redirect("logout");
}
