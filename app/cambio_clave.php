<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

	$usuario = $_POST["usuario"];
	$nuevaclave = $_POST["clave"];

	$consulta=mysqli_query($con,"SELECT * FROM usuario WHERE usuario_nombre='$usuario'") or die ("error".mysqli_error());
	$num=mysqli_num_rows($consulta);
	if ($num>0) {
		$row=mysqli_fetch_array($consulta);
		$idu=$row['usuario_id'];
	}

	$modificar=mysqli_query($con,"UPDATE usuario SET usuario_clave='$nuevaclave' WHERE usuario_id='$idu'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../../validacion.php");

?>