<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=2;

	$idperfil = $_REQUEST["id"];
	$perfil = $_POST["perfiln"];

	$consulta=mysqli_query($con,"UPDATE perfil SET perfil_dscrp='$perfil' WHERE perfil_id='$idperfil'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingresar_perfil.php");

?>