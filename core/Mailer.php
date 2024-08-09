<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function send($from, $to, $subject, $body, $altBody = '')
    {
        try {
            // Initialize
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'masando0110@gmail.com';
            $mail->Password = 'abirhgjzombshsva';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Recipients
            $mail->setFrom($from[0], $from[1]);
            $mail->addAddress($to[0], $to[1]);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $altBody;

            // Send email
            $mail->send();

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}