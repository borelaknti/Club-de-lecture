<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once 'PHPMailer/PHPMailer.php';
include_once 'PHPMailer/SMTP.php';
include_once 'PHPMailer/Exception.php';

class PhpMail
{

    function send_mail_by_PHPMailer($to, $from, $subject, $message){

        // SEND MAIL by PHP MAILER
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'c7f95e6b9b8132';
        $mail->Password = 'f4f187de05b06a';
        $mail->Port = 587;
        $mail->setFrom($from); // sender
        $mail->addAddress($to); // Add receiver
        $mail->addReplyTo($from); // Address to reply
        $mail->isHTML(true); // use HTML message
        $mail->Subject = $subject;
        $mail->Body = $message;

        // SEND
        if( !$mail->send() ){

            // render error if it is
            $tab = array('error' => 'Mailer Error: '.$mail->ErrorInfo );
            die(var_dump($tab));
            echo json_encode($tab);
            exit;
        }
        else{
            return true;
        }

    }

}
?>