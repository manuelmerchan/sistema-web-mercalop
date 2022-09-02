<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

mysqli_query($con,"DELETE FROM cotizacion WHERE id_cotizacion='$id'");

$_SESSION['eliminar']=1;
    header('Location:../buscar_cotizacion.php');

// if($consulta){
//     $_SESSION['eliminar']=1;
//     header('Location:../buscar_cotizacion.php');
// }else{
//     $_SESSION['confi']=10;
//     header('Location:../buscar_cotizacion.php');
// }
?>
