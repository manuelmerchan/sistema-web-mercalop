<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;
    $id=$_REQUEST['id'];
	$detalle = $_POST["detalle"];

	$consulta=mysqli_query($con,"INSERT INTO detalle_tipo_caso (descrip_dtc, id_tipo_caso) VALUES ('$detalle','$id')") or die ("error1".mysqli_error());
	
	mysqli_close($con);
	header("Location:../ingreso_detalle_tipo_caso.php?id=$id");

?>
