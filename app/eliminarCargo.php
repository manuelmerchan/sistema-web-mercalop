<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM cargo WHERE cargo_id='$id'");
header('Location:../ingresar_cargo.php');
?>
