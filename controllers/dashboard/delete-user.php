<?php
$user_id = $_GET['id'];
$sql = "DELETE FROM `users` WHERE `id` = '$user_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn)) {
    $_SESSION['success'] =  "User with $user_id has been deleted successfully";
}
redirect('users');
