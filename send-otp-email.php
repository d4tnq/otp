<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "generateOTP.php";


function sendmail($email){
    require ('vendor\phpmailer\phpmailer\src\PHPMailer.php');
    require ('vendor\phpmailer\phpmailer\src\Exception.php');
    require ('vendor\phpmailer\phpmailer\src\SMTP.php');
    global $site;
    $mail = new PHPMailer(true);
    $otp = generateOTP();
    $_SESSION['otp'] = $otp;
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;            
        $mail->Username   = 'nqdat16062002@gmail.com'; // email gửi
        $mail->Password   = 'xxx';   // app password   (Hướng dẫn tạo: https://support.google.com/mail/answer/185833?hl=en)              
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
        $mail->Port       = 465;                           

        $mail->setFrom('nqdat16062002@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'OTP From Quoc Dat';
        $mail->Body    = "OTP: ". $otp;

        $mail->send();
            return true;
    } catch (Exception $e) {
            return false;
    }
}

$email = $_POST['email'];

sendmail($email);

header('location: verify-otp.php');

?>
