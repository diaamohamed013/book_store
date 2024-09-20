<?php


$product = Getonerow('books', $_GET['id']);

$fav_item = [
    'title' => $product['title'],
    'price' => $product['price'],
    'image' => $product['image'],
    'sale' => $product['sale_percentage'],
    'quantity' => $product['quantity'],


];
$_SESSION['favourites'][$product['id']] = $fav_item;

$_SESSION['added-to-favourites'] = "item is added to favourites";


redirect('home');
