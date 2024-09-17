<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

if (checkRequestMethod('POST') && checkInput("author_name")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for name
    if (inpRequire($author_name)) {
        $errors['author_name'] = "اسم المؤلف مطلوب";
    } elseif (minVal($author_name, 5)) {
        $errors['author_name'] = "يجب الا يقل اسم الكتاب عن 5 حروف";
    } elseif (maxVal($author_name, 25)) {
        $errors['author_name'] = "يجب الا يزيد اسم الكتاب عن 25 حرف";
    }

    // for name
    if (inpRequire(input: $description)) {
        $errors['description'] = "الوصف مطلوب";
    } elseif (minVal($description, 15)) {
        $errors['description'] = "يجب الا يقل الوصف عن 15 حروف";
    } elseif (maxVal($description, 100)) {
        $errors['description'] = "يجب الا يزيد الوصف عن 100 حرف";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $author_name = $_POST['author_name'];
        $description = $_POST['description'];

        $sql = "INSERT INTO `authors` (`name`,`description`) VALUES ('$author_name','$description')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Your Authors Data has been Added successfully";
        }
    }
    redirect("add-author");
}
