<?php
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ROOT_PATH . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "diaamohamed013@gmail.com";
$mail->Password = "omcksmgqrutgetiq";

$mail->isHtml(true);

return $mail;
