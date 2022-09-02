<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
	$servicios = $_POST["servicios"];
  $valor = $_POST["valor"];

	$consulta=mysqli_query($con,"UPDATE servicios SET descrip_s='$servicios',valor='$valor' where id_servicios='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_servicios.php");

?>
