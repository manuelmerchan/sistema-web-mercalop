<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
	$tipo_caso = $_POST["tipo_caso"];

	$consulta=mysqli_query($con,"UPDATE tipo_caso SET descrip_tcj='$tipo_caso' where id_tipo_caso='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_tipo_caso.php");

?>
