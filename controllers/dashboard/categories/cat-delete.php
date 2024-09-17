<?php



if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $sql = "DELETE FROM `categories` WHERE `id` = '$category_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn)) {
    $_SESSION['success'] =  "  category has been deleted successfully";
    }
    redirect('categories');


    }