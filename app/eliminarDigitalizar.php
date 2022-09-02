<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM digitalizacion WHERE id_digitalizacion='$id'");
header('Location:../ingreso_digitalizar.php');
?>
