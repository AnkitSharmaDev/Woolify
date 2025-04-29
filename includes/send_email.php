<?php
// includes/send_email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';
require_once __DIR__ . '/PHPMailer/Exception.php';

function send_email_gmail($to, $subject, $body, $altBody = '') {
    $mail = new PHPMailer(true);
    try {
        // SMTP config
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ankitsharma64604@gmail.com';  
        $mail->Password = 'bzdn wvks hwoi fkxk';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender & recipient
        $mail->setFrom('ankitsharma64604@gmail.com', 'Woolify');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altBody ?: $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        // For debugging: error_log($mail->ErrorInfo);
        return false;
    }
} 