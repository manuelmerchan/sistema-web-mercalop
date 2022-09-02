<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['asignar']=1;

$consulta=mysqli_query($con,"SELECT * from iva  where id_iva='$id'");
$row=mysqli_fetch_array($consulta);
$estado=$row['id_estado'];
if ($estado=='1') {
  // no hace nada 
}else{
  $consulta2=mysqli_query($con,"SELECT * from iva  where id_estado='1'");
  while ($row2=mysqli_fetch_array($consulta2)) {
    $estado2=$row2['id_iva'];
    mysqli_query($con,"UPDATE iva SET id_estado='2' WHERE id_iva='$estado2'");
  }

  mysqli_query($con,"UPDATE iva SET id_estado='1' WHERE id_iva='$id'");
}

header('Location:../ingreso_iva.php');
?>
