<?php
session_start();
include('../config/conexion.php');

$id=$_REQUEST['id'];
$idcsj=$_REQUEST['idcsj'];

$_SESSION['eliminar']=1;

mysqli_query($con,"DELETE FROM expedientes WHERE id_expedientes='$id'");
header("Location:../ingreso_expedientes.php?id=$idcsj");
?>
