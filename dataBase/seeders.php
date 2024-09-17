<?php
require_once "../controllers/db_class/Database.php";

$db = new Database("localhost", "root", "", "ebook_project");

$results = $db->sqlQuery("
INSERT INTO `slider` (`id`, `image`) VALUES (1, '1.jpg'),(2, '2.jpg'),(3, '3.jpg');
");