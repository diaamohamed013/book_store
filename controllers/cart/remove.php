<?php

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['added-to-cart'] = "Item removed from cart";
    }
}

// redirect('shop')
?>
