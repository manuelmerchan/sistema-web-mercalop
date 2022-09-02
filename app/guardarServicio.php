<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$sevicios = $_POST["servicios"];
  $valor = $_POST["valor"];

	$consulta=mysqli_query($con,"INSERT INTO servicios (descrip_s,valor) VALUES ('$sevicios','$valor')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_servicios.php");

?>
