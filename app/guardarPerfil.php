<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

	$perfil = $_POST["perfil"];

	$consulta=mysqli_query($con,"INSERT INTO perfil (perfil_dscrp) VALUES ('$perfil')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingresar_perfil.php");

?>