<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"DELETE FROM genero WHERE id_genero='$id'");

if($consulta){
    $_SESSION['eliminar']=1;
    header('Location:../ingreso_genero.php');
}else{
    $_SESSION['confi']=10;
    header('Location:../ingreso_genero.php');
}
?>
