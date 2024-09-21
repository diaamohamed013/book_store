<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';
require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
// Assuming this is your database connection file and it returns a mysqli object
$email = $_POST["email"];
$baseUrl = BASE_URL . "index.php?page=";

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

// $mysqli = require _DIR_ . "/database.php";

$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();



if ($conn->affected_rows) {

    $mail = require __DIR__ . "/mail.php";

    $mail->setFrom("diaamohamed013@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END


    Click <a href="{$baseUrl}reset-password&token={$token}">here</a> to reset your password.
    END;

    try {

        $mail->send();
    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
}

?>


<div class="container" style="margin-top: 10rem; margin-bottom: 10rem">
    <div class="row">
        <div class="col-12 text-center">
            <h3 style="color: #04a6a8">تم الإرسال</h3>
            <p style="color: #000">تم إرسال رابط تعيين كلمة المرور إلى عنوان بريدك الإلكتروني</p>
        </div>
    </div>
</div>



<?php


require_once ROOT_PATH . 'inc/website/footer.php'; ?>