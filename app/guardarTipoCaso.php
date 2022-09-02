<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$detalle = $_POST["tipo_caso"];

	$consulta=mysqli_query($con,"INSERT INTO tipo_caso (descrip_tcj) VALUES ('$detalle')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_tipo_caso.php");

?>
