<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
	$tipo_cli = $_POST["tipo_cli"];

	$consulta=mysqli_query($con,"UPDATE tipo_cliente SET descrip_tc='$tipo_cli' where id_tipo_cliente='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_tipo_cliente.php");

?>
