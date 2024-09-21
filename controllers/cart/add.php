<?php

$product = Getonerow('books', $_GET['id']);
$i = 1; 

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
}

if (isset($_SESSION['cart'][$product_id])) {
    $i = $_SESSION['cart'][$product_id]['quantity'] + 1;
}


$cart_item = [
    'title'    => $product['title'],
    'price'    => $product['price'],
    'image'    => $product['image'],
    'sale'     => $product['sale_percentage'],
    'quantity' => $i, 
];


$_SESSION['cart'][$product['id']] = $cart_item;

$_SESSION['added-to-cart'] = "Item has been added to the cart";


redirect('single_product&id='.$product_id);
