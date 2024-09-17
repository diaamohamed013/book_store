<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

if (checkRequestMethod('POST') && checkInput("cat_name")) {
    $cat_name = sanitizeInput($_POST['cat_name']);
    if (inpRequire($cat_name)) {
        $errors['cat_name'] = "التنصنيف الخاص بالكتب مطلوب";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $sql = "INSERT INTO `categories` (`name`) VALUES ('$cat_name')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Your Book category has been Added successfully";
        }
    }
    redirect("showAll");
}
