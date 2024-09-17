<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

if (checkRequestMethod('POST') && checkInput("title")) {
    foreach ($_POST as $key => $value) {
        $$key = sanitizeInput($value);
    }
    // for name
    if (inpRequire($title)) {
        $errors['title'] = "اسم الكتاب مطلوب";
    } elseif (minVal($title, 5)) {
        $errors['title'] = "يجب الا يقل اسم الكتاب عن 5 حروف";
    } elseif (maxVal($title, 25)) {
        $errors['title'] = "يجب الا يزيد اسم الكتاب عن 25 حرف";
    }

    if (inpRequire($price)) {
        $errors['price'] = "السعر مطلوب";
    }

    if (inpRequire($category)) {
        $errors['category'] = "التصنيف الخاص بالكتاب مطلوب";
    }

    if (inpRequire($book_lang)) {
        $errors['book_lang'] = "اللغة الخاصة بالكتاب مطلوبة";
    }

    if (inpRequire($quantity)) {
        $errors['quantity'] = "الكمية الخاصة بالكتاب مطلوبة";
    }

    if (inpRequire($auth_name)) {
        $errors['auth_name'] = "اسم المؤلف مطلوب";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = $errors;
        redirect("add-book");
    } else {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $sale_percentage = $_POST['sale_percentage'];
        $quantity = $_POST['quantity'];
        $category = $_POST['category'];
        $book_lang = $_POST['book_lang'];
        $auth_id = $_POST['auth_name'];


        //upload images 
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_temp = $image['tmp_name'];
        $image_extention = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_without_extention = pathinfo($image_name, PATHINFO_FILENAME);
        $image_new_name = $image_without_extention . uniqid() . ".$image_extention";
        $image_new = "assets/images/books/$image_new_name";
        $move = move_uploaded_file($image_temp, $image_new);

        $sql = "INSERT INTO `books` (`title`,`price`,`sale_percentage`, `quantity`,`image`,`category_id`,`lang_id`,`auth_id`) 
                VALUES ('$title','$price','$sale_percentage','$quantity','$image_new_name','$category','$book_lang','$auth_name')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "Your Book Data has been Added successfully";
        }
        redirect("books");
    }
}

