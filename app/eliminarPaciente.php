<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"UPDATE paciente SET estado_id='2' WHERE paciente_id='$id'");
header('Location:../ingreso_paciente.php');
?>
