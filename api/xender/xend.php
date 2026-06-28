<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';
function sendMailByMe($to, $subject, $html)
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();

        $mail->Host = 'server143.web-hosting.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'shoplenca@air9ja.com';

        $mail->Password = 'Samuel252.';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom(
            'shoplenca@air9ja.com',
            'ShopLenca'
        );

        $mail->addAddress($to);

        $mail->isHTML(true);

        $mail->Subject = $subject;

        $mail->Body = $html;

        $mail->send();

        return [
            'success' => true,
            'message' => 'Email sent successfully'
        ];

    } catch (Exception $e) {

        return [
            'success' => false,
            'message' => $mail->ErrorInfo
        ];
    }
}