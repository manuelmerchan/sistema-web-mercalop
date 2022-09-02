<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"DELETE FROM tipo_empleado WHERE id_tipo_empleado='$id'");
if($consulta){
    $_SESSION['eliminar']=1;
    header('Location:../ingreso_tipo_empleado.php');
}else{
    $_SESSION['confi']=10;
    header('Location:../ingreso_tipo_empleado.php');
}
?>
