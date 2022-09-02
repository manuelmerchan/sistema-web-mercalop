<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];
$idcsj=$_REQUEST['idcsj'];
$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM deudas WHERE id_deudas='$id'");
header("Location:../ingreso_deuda_caso_juridico.php?id=$idcsj");
?>
