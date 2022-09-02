<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"SELECT * from iva  where id_iva='$id'");
$row=mysqli_fetch_array($consulta);
$estado=$row['id_estado'];
if ($estado=='1') {
    $_SESSION['confi']=10;
    header('Location:../ingreso_iva.php');
}else{
    $consulta=mysqli_query($con,"DELETE FROM iva WHERE id_iva='$id'");
    $_SESSION['eliminar']=1;
    header('Location:../ingreso_iva.php');
}

?>
