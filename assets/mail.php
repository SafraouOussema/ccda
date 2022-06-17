<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "PHPMailer/Exception.php";
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";

$mail = new PHPMailer(true);

 
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company = trim($_POST['subject']);
    $message = trim($_POST['message']); 
    $language = trim($_POST["language"]);
    if ($name == "") {
        $msg['err'] = "\n Name can not be empty!";
        $msg['field'] = "contact-name";
        $msg['code'] = FALSE;
    } else if ($email == "") {
        $msg['err'] = "\n Email can not be empty!";
        $msg['field'] = "contact-email";
        $msg['code'] = FALSE;
    } else if ($company == "") {
        $msg['err'] = "\n Company Name can not be empty!";
        $msg['field'] = "contact-company";
        $msg['code'] = FALSE;
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $msg['err'] = "\n Please put a valid email address!";
        $msg['field'] = "contact-email";
        $msg['code'] = FALSE;
    } else if ($message == "") {
        $msg['err'] = "\n Message can not be empty!";
        $msg['field'] = "contact-message";
        $msg['code'] = FALSE;
    } else {



        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'safraou.oussemagta@gmail.com';                     //SMTP username
            $mail->Password   = 'italylgfqtgwaloc';                               //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress('safraou.oussemagta@gmail.com', $name);     //Add a recipient
            $mail->addReplyTo($email, 'Information');
          //  $mail->addCC('safraou.oussemagta@gmail.com');
         //   $mail->addBCC('safraou.oussemagta@gmail.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
         
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $company;
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
           
        }
    }

    /*
    $to = 'pronetoussema@gmail.com';
    $subject = 'Abstrak Contact Query';
    $_message = '<html><head></head><body>';
    $_message .= '<p>Name: ' . $name . '</p>';
    $_message .= '<p>Email: ' . $email . '</p>';
    $_message .= '<p>Company: ' . $company . '</p>';
    $_message .= '<p>Message: ' . $message . '</p>';
    $_message .= '</body></html>';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:  Abstrak <pronetoussema@gmail.com>' . "\r\n";
    $headers .= 'cc: pronetoussema@gmail.com' . "\r\n";
    $headers .= 'bcc: pronetoussema@gmail.com' . "\r\n";
    mail($to, $subject, $_message, $headers, '-f pronetoussema@gmail.com');

    $msg['success'] = "\n Email has been sent successfully.";
    $msg['code'] = TRUE;
    */

