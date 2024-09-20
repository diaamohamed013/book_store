<?php

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];


    if (isset($_SESSION['favourites'][$product_id])) {
        unset($_SESSION['favourites'][$product_id]);
        $_SESSION['added-to-favourites'] = "Item removed from favourites";
    }
    redirect('favourites');
}
