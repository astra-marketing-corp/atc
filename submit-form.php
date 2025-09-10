<?php
ob_start(); // Prevent header issues
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $phone = $_POST['phoneNumber'];
    $email = $_POST['email'];
    //$event = $_POST['event'];
    $edate = $_POST['edate'];
    $help = $_POST['help'];
    $message = $_POST['message'];
    
    //START: Google reCAPTCHA v2 verification
    $recaptchaSecret = "6LeZYqwrAAAAAGybu_VODU4-DejugP6n8kl_hd06";
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$response}&remoteip={$remoteip}");
    $captcha_success = json_decode($verify);

    if (!$captcha_success->success) {
        die("reCAPTCHA verification failed. Please go back and try again.");
    }
    //END: reCAPTCHA verification

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.smashdevelop.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'test@smashdevelop.com';
        $mail->Password   = 'Test@2025';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('test@smashdevelop.com', 'TWO BROS');
        $mail->addAddress('alex@smashtoday.com', 'Alex');
        $mail->addAddress('sales@twobrosrentals.com', 'Two Bros');

        $mail->isHTML(true);
        $mail->Subject = 'New Estimate Request';
        $mail->Body    = "
            <h3>New Inquiry</h3>
            <p><strong>Full Name:</strong> {$fullName}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Event Date:</strong> {$edate}</p>
            <p><strong>Event Type:</strong> {$help}</p>
            <p><strong>Tell us about the event:</strong> {$message}</p>
        ";
        $mail->AltBody = "Full Name: $fullName\nPhone: $phone\nEmail: $email\nEvent Date: $edate\nEvent Type: $help\nTell us about the event: $message";

        $mail->send();

        header("Location: thankyou.html");
        exit;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
