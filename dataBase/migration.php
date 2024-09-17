<?php 
require_once "../controllers/db_class/Database.php";

$db = new Database("localhost","root","","ebook_project");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `messages`  (
`id` int PRIMARY KEY AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`phone` varchar(100) NOT NULL,
`subject` enum('استفسار','استبدال','استرجاع','استعجال اوردر','اخرى') Default ('استفسار') NOT NULL,
`content` varchar(255) NOT NULL)
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `users`  (
`id` int PRIMARY KEY AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`password` varchar(255) NOT NULL,
`role` enum('user','admin') DEFAULT ('user') NOT NULL
)
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS categories(

id INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(200)

)
");


$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS languages(

id INT PRIMARY KEY AUTO_INCREMENT,
lang_name VARCHAR(200)

)
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS books(

id INT PRIMARY KEY AUTO_INCREMENT,
title VARCHAR(200)NOT NULL ,
author_name VARCHAR(200)NOT NULL ,
price SMALLINT NOT NULL,
sale_percentage SMALLINT NOT NULL,
image VARCHAR(250),
category_id INT NOT NULL ,
FOREIGN KEY (category_id) REFERENCES categories(id),
lang_id INT NOT NULL ,
FOREIGN KEY (lang_id) REFERENCES languages(id)
)
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `orders`  (
`id` int PRIMARY KEY AUTO_INCREMENT,
`first_name` varchar(255) NOT NULL,
`last_name` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`city` enum('القاهرة','الإسكندرية') DEFAULT ('القاهرة') NOT NULL,
`phone` varchar(255) NOT NULL,
`address` varchar(255) NOT NULL,
`info` varchar(255) NOT NULL,
`created_at` TIMESTAMP DEFAULT(now()) NOT NULL,
`status` enum('pending','processing','delivered','shipped') DEFAULT ('pending') NOT NULL,
`total_price` FLOAT NOT NULL,
`user_id` int NOT NULL,
FOREIGN KEY (`user_id`) REFERENCES `users` (`id`))
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `order_items`  (
`id` int PRIMARY KEY AUTO_INCREMENT,
`book_id` int NOT NULL,
`order_id` int NOT NULL,
FOREIGN KEY (`book_id`) REFERENCES `books` (`id`), 
FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
)
");
$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `slider` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `image` varchar(255) NOT NULL
)
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `authors`  (
`id` int PRIMARY KEY AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`description` varchar(255) NOT NULL
)
");

$results = $db->sqlQuery("
CREATE TABLE IF NOT EXISTS `author_book`  (
`id` int PRIMARY KEY AUTO_INCREMENT,
`book_id` int NOT NULL,
`author_id` int NOT NULL,
FOREIGN KEY (`book_id`) REFERENCES `books` (`id`), 
FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`)
)
");