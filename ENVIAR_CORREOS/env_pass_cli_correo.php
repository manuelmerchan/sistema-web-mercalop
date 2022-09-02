<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';
include('../config/conexion.php');

$cedula = $_REQUEST["cedula"];
$clave = $cedula;
$e_mail = $_REQUEST["correo"];

    
    
  $mail = new PHPMailer\PHPMailer\PHPMailer();
  $mail->isSMTP();
  /*
  Enable SMTP debugging
  0 = off (for production use)
  1 = client messages
  2 = client and server messages
  */

  $mail->SMTPDebug = 0;
  $mail->Host = 'mail.merchan-juridico.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Username = "informacion@merchan-juridico.com";
  $mail->Password = "mercalop2022*";
  $mail->setFrom('informacion@merchan-juridico.com', 'Merchan Jurídicos');
  $mail->addAddress($e_mail, 'Mercalop'); // $correo_cli
  $mail->Subject = 'Asignación de Clave';
  $mail->Body = '<div style="padding:5px;">Estimado cliente, se adjunta su usuario y clave para que pueda acceder a nuestra aplicación móvil MERCALOP <br><br> <b>USUARIO : </b>'.$cedula.'<br><br> <b>CLAVE: </b>'.$clave.'  <br>  </div>';
  //$mail->addAttachment('/levox2.png', 'My uploaded file'); <img src='/levox2.png' width='150' height='110'>
  $mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
  $mail->IsHTML(true);
  if($mail->send()){
      header("Location:../ingreso_clientes.php");
  }else{
      echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
  }

?>