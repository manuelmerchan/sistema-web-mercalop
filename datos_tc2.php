<?php
include('config/conexion.php');
$tc=$_POST['tc'];
$sql="SELECT * from tipo_caso where id_tipo_caso='$tc'";

$result=mysqli_query($con,$sql);

$ver=mysqli_fetch_array($result);

$cadena=$ver['descrip_tcj'];

echo  $cadena;
?>
