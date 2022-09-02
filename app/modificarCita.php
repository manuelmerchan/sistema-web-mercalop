<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=2;

	$idcita = $_REQUEST["id"];

	$originalDate = $_POST["fecham"];
	$fechac = date("Y/m/d", strtotime($originalDate));

	$consultorio = $_POST["consultoriom"];
	$doctor = $_POST["medicom"];
	$mensaje = $_POST["mensajem"];

	$guardar=mysqli_query($con,"UPDATE cita SET cita_fecha='$fechac', cita_mensaje='$mensaje', consultorio_id='$consultorio', empleado_id='$doctor' WHERE cita_id='$idcita'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../buscar_citas.php");

?>