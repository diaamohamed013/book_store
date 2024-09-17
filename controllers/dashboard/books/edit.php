<?php
require_once "controllers/db_class/Database.php";
$db = new Database("localhost", "root", "", "ebook_project");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $title = $_POST['title'];
    $price = $_POST['price'];
    $sale_percentage = $_POST['sale_percentage'];
    $quantity = $_POST['quantity'];
    $author = $_POST['auth_name'];
    $book_lang = $_POST['book_lang'];
    $category = $_POST['category'];

    // image
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_temp = $image['tmp_name'];

    //upload & update image 
    if (!empty($image_name)) {
        $sql = "SELECT `image` From `products` WHERE `id` = '$id'";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);
        $old_image = $product['image'];
        // dd($category);
        // die;
        unlink('public/images/products/' . $old_image);
        //upload images 


        $image_new_name = uniqid() . $image_name;
        $image_temp_new = "assets/images/books/$image_new_name";
        $move = move_uploaded_file($image_temp, $image_temp_new);


        //update image 
        $update_image = "UPDATE `books` SET `image` = '$image_new_name' WHERE `id` = '$id' ";

        mysqli_query($conn, $update_image);
    }
    $update_book = "UPDATE `books` SET `title` = '$title' , `price` = '$price',`auth_id` = '$author' , `quantity` = '$quantity',`sale_percentage` = '$sale_percentage' , `category_id` = '$category',`lang_id` = '$book_lang' WHERE `id` = '$id' ";
    mysqli_query($conn, $update_book);
    redirect("books");
}
