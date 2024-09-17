<?php
require_once "controllers/db_class/Database.php";
$author_id = $_GET['id'];
$db = new Database("localhost", "root", "", "ebook_project");
$results = $db->sqlQuery("DELETE FROM `authors` WHERE `id` = '$author_id'");
if ($db->affectedRow()) {
    $_SESSION['success'] =  "Author with $author_id has been deleted successfully";
}
redirect('authors');
