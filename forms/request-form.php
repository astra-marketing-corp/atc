<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize POST data
    $name    = trim($_POST['full_name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');

    if (!$name || !$email || !$phone || !$service) {
        header("Location: /atc-shutters/form-error");
        exit;
    }

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        
        // UPDATE THESE WITH REAL CREDENTIALS
        $mail->Username   = 'fiallo2000@gmail.com';        // Your Gmail address
        $mail->Password   = 'xpvwipitprpynphx';         // Your 16-character App Password (no spaces)
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // // Sender & recipient
        // $mail->setFrom('fiallo2000@gmail.com', 'ATC Shutters');  // Must match Username
        // $mail->addAddress('joseph@astraresults.com', 'Joseph');
        

        // $mail->setFrom('fiallo2000@gmail.com', 'ATC Shutters');
        // $mail->addAddress('gopal@aresourcepool.com', 'Gopal');
        // $mail->addAddress('leonlawgroupmarketing@gmail.com', 'leon');


         // From & To
        $mail->setFrom('fiallo2000@gmail.com', 'ATC Shutters')
        $mail->addAddress('fiallo2000@gmail.com');

        // Add CC recipients
        $mail->addCC('development@astraresults.com');
        $mail->addCC('joseph@astraresults.com');

        

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'You\'ve Got a New Lead!';
        $mail->Body    = "
            <h3>New Request Form Submission</h3>
            <p><strong>Full Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Service:</strong> $service</p>
        ";

        // Send email
        if ($mail->send()) {
            header("Location: https://atcshutters.com/atc-shutters/thank-you");
            exit;
        } else {
            header("Location: https://atcshutters.com/atc-shutters/form-error");
            exit;
        }

    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        header("Location: https://atcshutters.com/atc-shutters/form-error");
        exit;
    }

} else {
    header("Location: /atc-shutters/form-error");
    exit;
}