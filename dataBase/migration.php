<?php 


$conn = mysqli_connect("localhost", "root", "", "bookstore");

$sql = "CREATE TABLE IF NOT EXISTS `slider` (
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `image` varchar(255) NOT NULL
)";

mysqli_query($conn, $sql);

//insert slider 

$sql = "INSERT INTO `slider` (`id`, `image`) VALUES (4, '4.png')";
mysqli_query($conn, $sql);