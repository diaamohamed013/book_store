<?php

require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

$token = $_POST["token"];

$token_hash = hash("sha256", $token);


$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();



$result = $stmt->get_result();


$user = $result->fetch_assoc();
$result = $stmt->store_result();


if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("si", $password_hash, $user["id"]);

$stmt->execute();

if ($conn->affected_rows) {
    redirect("account");
} else {
    die("Something went wrong");
} 
