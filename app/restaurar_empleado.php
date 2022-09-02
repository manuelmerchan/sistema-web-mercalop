<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['confirmar']=1;
mysqli_query($con,"UPDATE empleados SET id_estado='1' WHERE cedula='$id'");
header('Location:../lista_Restaurar_empleado.php');
?>
