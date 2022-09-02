<?php
include('config/conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  	$id_estu=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT * from empleados where  cedula='$id_estu'");
	$rows=mysqli_num_rows($consulta);
	if ($rows>0) {
  		$salida="1";
	}else {
  		// $salida="0";
  		$consulta2=mysqli_query($con,"SELECT * from clientes where  cedula='$id_estu'");
  		$rows2=mysqli_num_rows($consulta2);
  		if ($rows2>0) {
	  		$salida="2";
		}else {
	  		$salida="0";
		}
	}
	
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
