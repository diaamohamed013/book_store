<?php
require_once "controllers/db_class/Database.php";
$db = new Database("localhost", "root", "", "ebook_project");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $auth_name = $_POST['author_name'];
    $description = $_POST['description'];

    $results = $db->sqlQuery("UPDATE `authors` SET `name` = '$auth_name' WHERE `id` = '$id'");

    redirect("authors");
}
