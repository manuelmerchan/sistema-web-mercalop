<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"DELETE FROM lugares WHERE id_lugares='$id'");

if($consulta){
    $_SESSION['eliminar']=1;
    header('Location:../ingreso_lugares.php');
}else{
    $_SESSION['confi']=10;
    header('Location:../ingreso_lugares.php');
}
?>
