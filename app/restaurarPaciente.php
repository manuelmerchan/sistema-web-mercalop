<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['confirmar']=1;
mysqli_query($con,"UPDATE paciente SET estado_id='1' WHERE paciente_id='$id'");
header('Location:../lista_pacientes_inactivos.php');
?>