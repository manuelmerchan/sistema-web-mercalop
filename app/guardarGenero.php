<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$genero = $_POST["genero"];

	$consulta=mysqli_query($con,"INSERT INTO genero (descrip_g) VALUES ('$genero')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_genero.php");

?>
