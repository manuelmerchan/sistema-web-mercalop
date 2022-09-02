<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"DELETE FROM estado_civil WHERE id_estado_civil='$id'");

if($consulta){
    $_SESSION['eliminar']=1;
    header('Location:../ingreso_estado_civil.php');
}else{
    $_SESSION['confi']=10;
    header('Location:../ingreso_estado_civil.php');
}
?>
