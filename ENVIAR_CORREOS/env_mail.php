<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';



$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
/*
Enable SMTP debugging
0 = off (for production use)
1 = client messages
2 = client and server messages
*/
// informacion@merchan-juridico.com 
//mercalop2022*
$mail->SMTPDebug = 0;
$mail->Host = 'mail.merchan-juridico.com'; //servidor de correo
$mail->Port = 587; //puerto de correo
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "informacion@merchan-juridico.com"; //correo del hosting - donde llegan y envia los correos
$mail->Password = "mercalop2022*"; //contraseña del correo de arriba
$mail->setFrom('informacion@merchan-juridico.com', 'Pagina Web'); //indica de donde se envia el correo
$mail->addAddress('socola.erlin17@gmail.com', 'cliente '); // $correo_cli
$mail->Subject = 'Consulta Prueba';
$mail->Body = "<div style='padding:5px;'> <br> Nombre de Cliente : nombre prueba<br><br>Correo:prueba@hotmail.com  <br><br>  Asunto: sin asunto p <br> <br>   Mensaje: mensaje de prueba <br> </div>";
//$mail->addAttachment('/levox2.png', 'My uploaded file'); <img src='/levox2.png' width='150' height='110'>
$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
$mail->IsHTML(true);
$mail->send();

if (!$mail->send())
{
	echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
}
else
{
	echo "enivo exitosamente";
}
?>