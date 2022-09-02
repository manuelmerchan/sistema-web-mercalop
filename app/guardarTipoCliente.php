<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$tipo_cli = $_POST["tipo_cli"];

	$consulta=mysqli_query($con,"INSERT INTO tipo_cliente (descrip_tc) VALUES ('$tipo_cli')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_tipo_cliente.php");

?>
