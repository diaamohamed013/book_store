<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']); 
    $id = (int)$_GET['id']; 
    $sql = "UPDATE `categories` SET `name` = '$name' WHERE `id` = '$id'";

 
    if (mysqli_query($conn, $sql)) {
        
        $_SESSION['success'] = "Your book category has been edited successfully";
        
       
        redirect("showAll");
    } else {
        
        echo "Error updating category: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request";
}
