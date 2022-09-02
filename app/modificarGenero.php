<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
	$genero = $_POST["genero"];

	$consulta=mysqli_query($con,"UPDATE genero SET descrip_g='$genero' where id_genero='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_genero.php");

?>
