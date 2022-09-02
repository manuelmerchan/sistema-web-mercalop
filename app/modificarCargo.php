<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=2;

	$idcargo = $_REQUEST["id"];
	$cargo = $_POST["cargon"];

	$consulta=mysqli_query($con,"UPDATE cargo SET cargo_dscrp='$cargo' WHERE cargo_id='$idcargo'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingresar_cargo.php");

?>