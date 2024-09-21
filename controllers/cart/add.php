<?php


$product=Getonerow('books',$_GET['id']);

$cart_item=[
    'title'=> $product['title'],
    'price'=> $product['price'],
    'image'=> $product['image'],
    'sale'=> $product['sale_percentage'],
    'quantity'=>$product['quantity'],
    

];
$_SESSION['cart'][$product['id']]=$cart_item;

$_SESSION['added-to-cart']="item is added to cart"; 


redirect('shop&nr_page=1');