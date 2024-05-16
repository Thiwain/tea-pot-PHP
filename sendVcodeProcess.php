<?php
session_start();
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateVerificationCode()
{
    return sprintf("%06d", mt_rand(1, 999999));
}

$emailToUpdate = $_POST['email'];

$rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $emailToUpdate . "'");
$n = $rs->num_rows;

if ($n == 1) {
    $newVerificationCode = generateVerificationCode();

    $updateQuery = "UPDATE `user` SET `vcode` = '$newVerificationCode' WHERE `email` = '$emailToUpdate'";
    Database::iud($updateQuery);

    $mail = new PHPMailer(true);

    try {
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'medagamathiwain@gmail.com';
        $mail->Password = 'uelt skyt idjl mazs';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom('medagamathiwain@gmail.com', 'Reset Password');
        $mail->addReplyTo('medagamathiwain@gmail.com', 'Teapot Account Reset Password');
        $mail->addAddress($emailToUpdate);
        $mail->isHTML(true);
        $mail->Subject = 'Teapot account Verification-Code';
        $bodyContent = '<div style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
        <h1 style="color: #333; margin-bottom: 20px;">Your Verification code is</h1>
        <h1 style="color: #ffd700; font-weight: bold; background-color: #333; padding: 10px; display: inline-block; border-radius: 5px;">
            ' . $newVerificationCode . '
        </h1>
    </div>
    ';
        $mail->Body = $bodyContent;

        $mail->send();
        echo 'Sent';
    } catch (Exception $e) {
        echo 'Verification code sending failed. Error: ' . $mail->ErrorInfo;
    }
} else {
    echo ("Invalid Email");
}
