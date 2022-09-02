<?php
	session_start();
	include ("../config/conexion.php");
  $fecha=date('Y-m-d');
	$hora=date('H:i:s');
  $idcj=$_REQUEST['id'];

	$_SESSION['confirmar']=1;

  $deuda = $_POST["deuda"];
  $descrip = $_POST["descrip"];

  $ingreso3=mysqli_query($con,"INSERT INTO deudas (fecha, valor_deuda, descripcion, id_casos_juridicos) VALUES ('$fecha','$deuda','$descrip','$idcj')") or die ("error".mysqli_error());
	mysqli_close($con);
	header("Location:../ingreso_deuda_caso_juridico.php?id=$idcj");

?>
