<?php

require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['query'])) {
    $searchQuery = $conn->real_escape_string($_POST['query']);

    // Search query

    $sql = "SELECT *  FROM books WHERE `title` LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<li class='list-group-item' style='padding: 7px; border-bottom: 1px solid #ddd;'>
        <a href='" . url("single_product") . "&id=" . $row['id'] . "' style='text-decoration: none; color: #333; display: block;'>"
                . $row['title'] .
                "</a>
      </li>";
        }
    } else {
        echo "<p>No results found</p>";
    }
}
$conn->close();
