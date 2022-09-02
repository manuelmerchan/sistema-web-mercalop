<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$estado_civil = $_POST["estado_civil"];

	$consulta=mysqli_query($con,"INSERT INTO estado_civil (descrip_ec) VALUES ('$estado_civil')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_estado_civil.php");

?>
