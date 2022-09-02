<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$lugares = $_POST["lugares"];

	$consulta=mysqli_query($con,"INSERT INTO lugares (descrip_l) VALUES ('$lugares')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_lugares.php");

?>
