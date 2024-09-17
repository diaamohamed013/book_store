<?php
$conn = mysqli_connect("localhost", "root", "", "bookstore");


function getAll($tableName)
{
    global $conn;
    $query = "SELECT * FROM `$tableName`";
    return mysqli_query($conn, $query);
}

function getRow($tableName1 , $tableName2,$id)
{
    global $conn;
    $query = "SELECT $tableName1* FROM `$tableName1` INNER JOIN `$tableName2` ON `$tableName2`.id = `$tableName1`.category_id  WHERE `category_id` = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function check($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)) {
        return true;
    }
    return false;
}
