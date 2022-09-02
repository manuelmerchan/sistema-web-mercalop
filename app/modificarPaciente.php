<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=2;
	$idp = $_REQUEST["idp"];

	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$identificacion = $_POST["identificacion"];
	$fechan = $_POST["fnaci"];
	$edad = $_POST["edad"];
	$celular = $_POST["celular"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$direccion = $_POST["direccion"];
	$ocupacion = $_POST["ocupacion"];
	$tipo = $_POST["tipo"];
	$genero = $_POST["genero"];
	$estadoc = $_POST["estadoc"];
	
	$consulta=mysqli_query($con,"UPDATE paciente SET paciente_fecham='$fecha', paciente_nombres='$nombres', paciente_apellidos='$apellidos', paciente_identificacion='$identificacion', paciente_fechan='$fechan', paciente_edad='$edad', paciente_celular='$celular', paciente_telefono='$telefono', paciente_correo='$correo', paciente_direccion='$direccion', paciente_ocupacion='$ocupacion', identificacion_id='$tipo', estado_civil_id='$estadoc', genero_id='$genero' WHERE paciente_id='$idp'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_paciente.php");

?>