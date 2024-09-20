<?php
$order_id = $_GET['id'];
$new_status = "UPDATE `orders` SET `status` = 'processing' WHERE `id` = '$order_id'";
$result = mysqli_query($conn, $new_status);
if (mysqli_query($conn, $new_status)) {
    $_SESSION['success'] = "لقد تم تعديل حالة الطلب";
}
redirect("allOrders");
