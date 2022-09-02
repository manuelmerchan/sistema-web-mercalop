<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];
$id_tcj=$_REQUEST['id_tcj'];

$consulta=mysqli_query($con,"DELETE FROM detalle_tipo_caso WHERE id_detalle_tipo_caso='$id'");

if($consulta){
    $_SESSION['eliminar']=1;
    header("Location:../ingreso_detalle_tipo_caso.php?id=$id_tcj");
}else{
    $_SESSION['confi']=10;
    header("Location:../ingreso_detalle_tipo_caso.php?id=$id_tcj");
}
?>
