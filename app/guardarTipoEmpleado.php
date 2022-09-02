<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;

	$tipo_emple = $_POST["tipo_emple"];

	$consulta=mysqli_query($con,"INSERT INTO tipo_empleado (descrip_te) VALUES ('$tipo_emple')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_tipo_empleado.php");

?>
