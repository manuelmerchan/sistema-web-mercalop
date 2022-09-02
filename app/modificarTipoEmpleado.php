<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

  $id = $_REQUEST["id"];
	$tipo_emple = $_POST["tipo_emple"];

	$consulta=mysqli_query($con,"UPDATE tipo_empleado SET descrip_te='$tipo_emple' where id_tipo_empleado='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_tipo_empleado.php");

?>
