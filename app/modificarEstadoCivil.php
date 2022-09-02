<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
	$estado_civil = $_POST["estado_civil"];

	$consulta=mysqli_query($con,"UPDATE estado_civil SET descrip_ec='$estado_civil' where id_estado_civil='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_estado_civil.php");

?>
