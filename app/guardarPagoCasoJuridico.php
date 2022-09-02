<?php
	session_start();
	include ("../config/conexion.php");
  $fecha=date('Y-m-d');
	$hora=date('H:i:s');
  $idcj=$_REQUEST['id'];

	$_SESSION['confirmar']=1;

  $id_emple=$_SESSION['ID_EMPLE'];

  $pagos = $_POST["pagos"];

	$consulta=mysqli_query($con,"INSERT INTO pago_abono (fecha, hora, abono, id_empleados, id_casos_juridicos) VALUES ('$fecha','$hora','$pagos','$id_emple','$idcj')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_pago_caso_juridico.php?id=$idcj");

?>
