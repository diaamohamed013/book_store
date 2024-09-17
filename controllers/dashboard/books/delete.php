<?php
require_once "controllers/db_class/Database.php";
$book_id = $_GET['id'];
$db = new Database("localhost", "root", "", "ebook_project");
$results = $db->sqlQuery("DELETE FROM `books` WHERE `id` = '$book_id'");
if ($db->affectedRow()) {
    $_SESSION['success'] =  "Author with $book_id has been deleted successfully";
}
redirect('books');
