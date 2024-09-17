<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

if (checkRequestMethod('POST') && checkInput("book_lang")) {
    // for book_lang
    $book_lang = sanitizeInput($_POST['book_lang']);
    if (inpRequire($book_lang)) {
        $errors['book_lang'] = "اللغة الخاصة بالكتاب مطلوبة";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
    } else {
        $sql = "INSERT INTO `languages` (`lang_name`) VALUES ('$book_lang')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Your Book Language has been Added successfully";
        }
    }
    redirect("book-lang");
}
