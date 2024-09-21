<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

// $errors = [];
if (checkRequestMethod('POST') && checkInput("userName")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for name
    if (inpRequire($userName)) {
        $errors['userName'] = "Name is required";
    } elseif (minVal($userName, 3)) {
        $errors['userName'] = "Name must be greater than 3 chars";
    } elseif (maxVal($userName, 25)) {
        $errors['userName'] = "Name must be smaller than 25 chars";
    }

    // for content
    if (inpRequire($usercontent)) {
        $errors['usercontent'] = "Content is required";
    } elseif (minVal($usercontent, 10)) {
        $errors['usercontent'] = "Content must be greater than 10 chars";
    } elseif (maxVal($usercontent, 200)) {
        $errors['usercontent'] = "Content must be smaller than 100 chars";
    }

    // for email
    if (inpRequire($userEmail)) {
        $errors['userEmail'] = "Email is required";
    } elseif (!emailValid($userEmail)) {
        $errors['userEmail'] = "please enter a valid email";
    }

    // for phone
    if (inpRequire($userPhone)) {
        $errors['userPhone'] = "Phone is required";
    } elseif (number($userPhone)) {
        $errors['userPhone'] = "please enter a valid phone";
    }
    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $sql = "INSERT INTO `messages` (`name`, `email`,`phone`, `subject`, `content`) VALUES ('$userName','$userEmail','$userPhone','$userSubject','$usercontent')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Your Message has been sent successfully";
        }
    }
    redirect("contact");
}
