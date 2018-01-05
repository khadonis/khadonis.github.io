<?php

require 'PHPMailer/PhpMailer.class.php';
require 'PHPMailer/smtp.class.php';

function GetIP() {
    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

$ip_adress = GetIP();
$name = addslashes(strip_tags($_POST['ad']));
$sub = addslashes(strip_tags($_POST['tel']));
$email = addslashes(strip_tags($_POST['email']));
$message = addslashes(strip_tags($_POST['mesaj']));

if (empty($name) || empty($email) || empty($message)) {
    header("Location:contact.php?empty");
} else {

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "mail.kaandemirkol.com"; // smtp host
    $mail->Port = "587";  // Port
    $mail->SMTPAuth = true;
    $mail->Username = "info@kaandemirkol.com";  //mail address
    $mail->Password = "pGoCg6Vzw7SfGAJUZqhg"; //email password
    $mail->From = $email; // from mail address
    $mail->FromName = $name; // From Name
    $mail->AddAddress("info@kaandemirkol.com", "kaandemirkol.com İletişim Formu İletisi"); //your mail address and name
    $mail->WordWrap = 80;
    $mail->Subject = "Web Site İletişim Formu"; // Mail Subject
    $mail->Body = "	Ad : " . $name . "
						<br>E-mail: " . $email . "
					<br>Mesaj: " . $message . "
					<br>Tel: " . $sub . "
					<br>IP : " . $ip_adress;


    $mail->AddReplyTo($email, "İletişim Formu");
    $mail->AddAddress('info@kaandemirkol.com');  //mail address
    $mail->IsHTML(true);

    if ($mail->Send())
        echo "";
}
?>
