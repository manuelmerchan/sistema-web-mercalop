<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$idCaso = $_REQUEST["idcaso"];
	$idProceso = $_REQUEST["idproceso"];

	$modificar=mysqli_query($con,"UPDATE casos_juridicos SET proceso='$idProceso' WHERE id_casos_juridicos='$idCaso'") or die ("error".mysqli_error());

	$_SESSION['cambio']=1;
	mysqli_close($con);
	header("Location:../buscar_caso_juridico.php");

?>