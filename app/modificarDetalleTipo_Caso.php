<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;
$id=$_REQUEST['id'];
$idtcj=$_REQUEST['idtcj'];
	$detalle = $_POST["detalle"];

	$consulta=mysqli_query($con,"UPDATE detalle_tipo_caso SET  descrip_dtc='$detalle' where id_detalle_tipo_caso='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_detalle_tipo_caso.php?id=$idtcj");

?>
