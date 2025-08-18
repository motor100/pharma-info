<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["name"]) &&
   isset($_POST["surname"]) &&
   isset($_POST["phone"]) && 
   isset($_POST["email"]) && 
   isset($_POST["checkbox-read"]) &&
   isset($_POST["checkbox-agree"])) {

    $name = htmlspecialchars($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    $cc = htmlspecialchars($_POST["cc"]);
    $checkbox_read = $_POST["checkbox-read"];
    $checkbox_agree = $_POST["checkbox-agree"];

    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'config.php';

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    // Настройки SMTP
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;

    $mail->Host = $Host;
    $mail->Username = $Username; // Для Яндекс почты должно быть одинаковым
    $mail->Password = $Password;

    $mail->Port = 465;

    // От кого
    $mail->From = $Username; // Для Яндекс почты должно быть одинаковым
    $mail->FromName = $Username; // Для Яндекс почты должно быть одинаковым

    // Кому
    $mail->addAddress($To);

    if ($cc) {
      $mail->addCC($cc);
    }

    // Тема письма
    $mail->Subject = 'Сообщение с сайта Информационный';

    $mail->isHTML(true);

    if (strlen($name) >= 3 &&
      strlen($name) <= 50 &&
      strlen($surname) >= 3 &&
      strlen($surname) <= 50 &&
      strlen($phone) == 18 && 
      strlen($email) >= 3 &&
      strlen($email) <= 50 &&
      $checkbox_read == "on" &&
      $checkbox_agree == "on") {

        // Тело письма
        $mail->Body = "Имя: $name<br> Фамилия: $name<br> Телефон: $phone<br> Email: $email<br> Сообщение: $message<br>";
        $mail->AltBody = "Имя: $name\r\n Фамилия: $name\r\n Телефон: $phone\r\n Email: $email\r\n Сообщение: $message\r\n";

        $mail->send();
    }

    $mail->smtpClose();

} else {
    header("Location: /");
    exit;
}

?>