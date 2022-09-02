<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
	$lugares = $_POST["lugares"];

	$consulta=mysqli_query($con,"UPDATE lugares SET descrip_l='$lugares' where id_lugares='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_lugares.php");

?>
