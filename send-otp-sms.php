<?php
// require 'connection.php';
require __DIR__ . '/vendor/autoload.php'; 

use Twilio\Rest\Client;

// Twilio API config, => Tạo tài khoản tại https://www.twilio.com/ và nhét token dưới đây:
$accountSid = 'xxx';
$authToken = 'xxx';
$twilioPhoneNumber = 'xxx';

include "generateOTP.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate OTP
    $otp = generateOTP();

    $phoneNumber = '+84'.$_POST['phone_number'];

    // send otp
    try {
        $client = new Client($accountSid, $authToken);
        // Send OTP via SMS
        $client->messages->create(
            $phoneNumber,
            [
                'from' => $twilioPhoneNumber,
                'body' => 'Your OTP is: ' . $otp,
            ]
        );
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['phone_number']= $phoneNumber;
        // Redirect 
        header('Location: verify-otp.php');
        exit();
    } catch (Exception $e) {
        echo '<script>';
        echo 'alert("Error!")';
        echo '</script>';
    } 
    
}
?>