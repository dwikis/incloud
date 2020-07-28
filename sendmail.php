<?php
// require 'PHPMailer-master/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
require_once "vendor/autoload.php";
// require_once "constants.php";
 $email = $_GET['email'];
$mail = new PHPMailer(true);
$otp = random_int(11111,99999);
$_SESSION['otp'] = $otp;
try {
    // $mail->isSMTP();
    // // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
    // $mail->SMTPAuth = true;
    // $mail->Username = "hidroponikapps@gmail.com";   //username
    // $mail->Password = "fjmzspstqnmnxgoh";   //password
    // $mail->SMTPSecure = 'ssl';
    // $mail->Port = 465;                    //smtp port
    // $mail->setFrom('hidroponikapps@gmail.com', 'Incloud');
    // $mail->addAddress($email, 'incloud');
    // $mail->isHTML(true);
    // $mail->Subject = 'Email Subject';
    // $mail->Body    = '<b>Anda Mengirim Request Daftar Akun</b><br><b>password OTP :'.$otp.' </b>';
    // $mail->send();
    // echo 'Message has been sent';
    // header('Location: http://localhost/Music-Streaming/otp.php');
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'finneon.sg.rapidplex.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'incloud@fredynurapriyanto.com';                 // SMTP username
$mail->Password = 'incloudemail';                           // SMTP password
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = 'incloud@fredynurapriyanto.com';
$mail->FromName = 'incloudapps';
$mail->addAddress($email);               // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
}

// use PHPMailer\PHPMailer\PHPMailer;
// require 'vendor/autoload.php';
// $mail = new PHPMailer;
// $mail->isSMTP();
// $mail->SMTPDebug = 2;
// $mail->Host = 'finneon.sg.rapidplex.com';
// $mail->Port = 465;
// $mail->SMTPAuth = true;
// $mail->Username = 'incloud@fredynurapriyanto.com';
// $mail->Password = 'incloudemail';
// $mail->setFrom('incloud@fredynurapriyanto.com', 'incloud');
// // $mail->addReplyTo('test@hostinger-tutorials.com', 'Your Name');
// $mail->addAddress('bmokerz@gmail.com', 'Bondan');
// $mail->Subject = 'Verifikasi Email';
// $mail->msgHTML(file_get_contents(''), __DIR__);
// $mail->Body = 'This is a plain text message body';
// //$mail->addAttachment('test.txt');
// if (!$mail->send()) {
//     echo 'Mailer Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'The email message was sent.';
// }
?>