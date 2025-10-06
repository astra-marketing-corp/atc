<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize POST data
    $name    = trim($_POST['full_name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');

     if (!$name || !$email || !$phone || !$service) {
        header("Location: ../form-error.html");
        exit;
    }
    $mail = new PHPMailer(true);

    // Set charset to UTF-8 to support emojis and special characters
    $mail->CharSet = 'UTF-8';

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'fiallo2000@gmail.com';    // Your Gmail
        $mail->Password   = 'txgkmczrwcohwhoj';         // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Sender & recipient
        $mail->setFrom('fiallo2000@gmail.com', 'ATC Shutters');
        $mail->addAddress('joseph@astraresults.com', 'Joseph');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'You\'ve Got a New Lead! 🎉';
        $mail->Body    = "
            <h2>Contact Request</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Service:</strong><br>{$service}</p>
        ";

        // Send email
        if($mail->send()) {
            // Redirect to thank-you page
            header('Location: ../thank-you.html');
            exit;
        } else {
            // Redirect to error page
            header('Location: ../form-error.html');
            exit;
        }

    } catch (Exception $e) {
        // If sending failed, redirect to error page
        header('Location: ../form-error.html');
        exit;
    }

} else {
    // Invalid request
    header('Location: ../form-error.html');
    exit;
}
