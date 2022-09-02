<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"DELETE FROM tipo_cliente WHERE id_tipo_cliente='$id'");
if($consulta){
    $_SESSION['eliminar']=1;
    header('Location:../ingreso_tipo_cliente.php');
}else{
    $_SESSION['confi']=10;
    header('Location:../ingreso_tipo_cliente.php');
}
?>