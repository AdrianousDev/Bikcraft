<?php

$email = ""; // meu email
$senha = ""; // minha senha

// não deixar esse arquivo e nem a biblioteca expostas.

$smtp = "smtp.titan.email"; //hostgator
$porta = 465; //hostgator

$body = "";
foreach($_POST as $label => $value) {
  $body .=  filter_var($label, FILTER_SANITIZE_STRING)
  . ": "
  . filter_var($value, FILTER_SANITIZE_STRING) . "<br>";
}

$email_contato = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$email_valid = filter_var($email_contato, FILTER_VALIDATE_EMAIL);

if(!$email_valid) {
  throw new Exception('Email inválido');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./PHPMailer/src/Exception.php";
require "./PHPMailer/src/PHPMailer.php";
require "./PHPMailer/src/SMTP.php";

$mail = new PHPMailer(true);

try {
  // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->Host       = $smtp;
  $mail->SMTPAuth   = true;
  $mail->Username   = $email;
  $mail->Password   = $senha;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port       = $porta;
  $mail->CharSet    = "utf-8";

  //Recipients
  $mail->setFrom($email, "Formulário");
  $mail->addAddress($email, "Formulário");
  $mail->addReplyTo($email_contato);

  $mail->isHTML(true);
  $mail->Subject = "Formulário Email";
  $mail->Body    = $body;

  $mail->send();
  echo "<h1>Mensagem enviada.</h1>";
} catch (Exception $e) {
  echo "<h1>Erro, mensagem não enviada.</h1>";
}