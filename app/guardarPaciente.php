<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

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
	
	$estado = "1";

	// CLAVE ALEATORIA
	$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$cad = "";
	for($p=0;$p<10;$p++){
		$cad .= substr($charset, rand(0, 62), 1);
	}
	$clave = $cad;
	// FIN CLAVE ALEATORIA

	include('../ENVIAR_CORREOS/envClavePaciente.php');
	
	$guardar=mysqli_query($con,"INSERT INTO paciente (paciente_fechai, paciente_fecham, paciente_nombres, paciente_apellidos, paciente_identificacion, paciente_fechan, paciente_edad, paciente_celular, paciente_telefono, paciente_correo, paciente_direccion, paciente_ocupacion, identificacion_id, estado_civil_id, genero_id, estado_id) VALUES ('$fecha', '$fecha', '$nombres', '$apellidos', '$identificacion', '$fechan', '$edad', '$celular', '$telefono', '$correo', '$direccion', '$ocupacion', '$tipo', '$estadoc', '$genero', '$estado')") or die ("error".mysqli_error());

	$consulta=mysqli_query($con,"SELECT * FROM paciente ORDER BY paciente_id DESC") or die ("error".mysqli_error());

	if ($consulta) {
		$row = mysqli_fetch_assoc($consulta);
		$id = $row['paciente_id'];
	}

	$tipo_usuario = 2;

	$guardar2=mysqli_query($con,"INSERT INTO usuario (usuario_nombre, usuario_clave, user_id, tipo_usuario) VALUES ('$identificacion', '$clave', '$id', '$tipo_usuario')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_paciente.php");

?>