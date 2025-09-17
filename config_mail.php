<?php
// config_mail.php
// Centralized email configuration for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

// Create a mailer instance with default config
function getMailer(): PHPMailer {
    $mail = new PHPMailer(true);

    // Enable SMTP
    $mail->isSMTP();

    /**
     * ============================
     * EDIT THESE SETTINGS TO SWITCH
     * ============================
     */

    // 🔹 Gmail Example
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mynameme75@gmail.com'; // my Gmail email
    $mail->Password   = 'eewpzdcdhrixkphd'; // my Gmail APP password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // 🔹 Outlook / Office365 Example (comment Gmail and uncomment this block if using Outlook)
    /*
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'youremail@outlook.com';
    $mail->Password   = 'your-app-password'; // Outlook app password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    */

    // 🔹 Custom Domain Example
    /*
    $mail->Host       = 'mail.yourdomain.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support@yourdomain.com';
    $mail->Password   = 'your-email-password';
    $mail->SMTPSecure = 'ssl'; // or 'tls' depending on your host
    $mail->Port       = 465;   // or 587
    */

    // Default sender (you can override in your code)
    $mail->setFrom($mail->Username, 'AdimoreHub Support');

    // General settings
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    return $mail;
}
