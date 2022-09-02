<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

	$cargo = $_POST["cargo"];

	$consulta=mysqli_query($con,"INSERT INTO cargo (cargo_dscrp) VALUES ('$cargo')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingresar_cargo.php");

?>