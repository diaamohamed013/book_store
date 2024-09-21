<?php
$message_id = $_GET['id'];
$sql = "DELETE FROM `messages` WHERE `id` = '$message_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn)) {
    $_SESSION['success'] =  "Message with $message_id has been deleted successfully";
}
redirect('messages');
