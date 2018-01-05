<?php

require 'PHPMailer/PhpMailer.class.php';
require 'PHPMailer/smtp.class.php';

$ad = htmlspecialchars(isset($_POST['ad']) ? $_POST['ad'] : '');
$email = htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : '');
$tel = htmlspecialchars(isset($_POST['tel']) ? $_POST['tel'] : '');
$mesaj = htmlspecialchars(isset($_POST['mesaj']) ? $_POST['mesaj'] : '');

$mail = new PhpMailer(true); //New instance, with exceptions enabled

$body = $mesaj . '<br><br><br> <span>Telefon Numarası:' . $tel . '</span>'; // $mesaj


$mail->IsSMTP();                           // tell the class to use SMTP
$mail->SMTPAuth = true;                  // enable SMTP authentication
$mail->Port = 587;                    // set the SMTP server port
$mail->Host = 'mail.kaandemirkol.com'; // SMTP server
$mail->Username = 'info@kaandemirkol.com';     // SMTP server username
$mail->Password = 'pGoCg6Vzw7SfGAJUZqhg';           // SMTP server password

$mail->From = $email;
$mail->FromName = $ad;

$to = 'info@kaandemirkol.com';

$mail->AddAddress($to);

$mail->Subject = 'Web Sitesi İletişim Formu';

$mail->AltBody = ""; // optional, comment out and test
$mail->WordWrap = 80; // set word wrap

$mail->MsgHTML($body);

$mail->IsHTML(true); // send as HTML

$mail->Send();

if ($mail->Send()) {
    echo 1;
}

$err_msg = '<span font-size:15px; font-weight:bold;">' . $e->errorMessage() . '</span>';
?>

