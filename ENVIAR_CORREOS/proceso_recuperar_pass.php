<?php
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
require 'OAuth.php';
include('../config/conexion.php');


$cedula = $_REQUEST["cedula"];
$correo = $_REQUEST["correo"];

$consulta=mysqli_query($con,"SELECT * from empleados E inner join usuarios U on U.id_empleados=E.cedula where E.cedula='$cedula' and E.correo='$correo' ");
$num_rows=mysqli_num_rows($consulta);

if($num_rows>0){
    $row=mysqli_fetch_array($consulta);
    $e_mail=$row['correo'];
    $usuario=$row['usuario'];
    $clave=$row['clave'];
    
    
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
  $mail->setFrom('informacion@merchan-juridico.com', 'Merchan Juridicos');
  $mail->addAddress($e_mail, 'Mercalop'); // $correo_cli
  $mail->Subject = 'Restaurar Credenciales';
  $mail->Body = '<div style="padding:5px;"> <br> usuario : '.$usuario.'<br><br>Clave: '.$clave.'  <br>  </div>';
  //$mail->addAttachment('/levox2.png', 'My uploaded file'); <img src='/levox2.png' width='150' height='110'>
  //$mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
  $mail->IsHTML(true);
  if($mail->send()){  }else{
      echo "Error al enviar el E-Mail: ".$mail->ErrorInfo;
  }
  
  header("Location:../recuperar_pass.php?enviado=1");
    
}else{
    header("Location:../recuperar_pass.php?enviado=0");
}
  

?>