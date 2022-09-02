<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

	$idpac = $_REQUEST["id"];

	$fechac = $_POST["fecha"];
	// $fechac = date("Y/m/d", strtotime($originalDate));

	$hora = $_POST["hora"];
	$consultorio = $_POST["consultorio"];
	$doctor = $_POST["doctor"];

	if (isset($_POST["mensaje"])) {
		$mensaje = $_POST["mensaje"];
	}else{
		$mensaje="";
	}
	
	$estado = 1;

	// PARA CORREO
	$consulpaciente = mysqli_query($con,"SELECT * FROM paciente WHERE paciente_id='$idpac'");
	$rowdp = mysqli_fetch_array($consulpaciente);
	$correo = $rowdp['paciente_correo'];
	$nombres = $rowdp['paciente_nombres'];
	$apellidos = $rowdp['paciente_apellidos'];
	$consulhora = mysqli_query($con,"SELECT * FROM horarios WHERE horarios_id='$hora'");
	$rowh = mysqli_fetch_array($consulhora);
	$horacorreo = $rowh['horarios_dscrp'];
	$consulpaciente = mysqli_query($con,"SELECT * FROM empleado WHERE empleado_id='$doctor'");
	$rowme = mysqli_fetch_array($consulpaciente);
	$nombrese = $rowme['empleado_nombres'];
	$apellidose = $rowme['empleado_apellidos'];

	include('../ENVIAR_CORREOS/envConfirmCita.php');
	// FIN PARA CORREO
	

	$consulta = mysqli_query($con,"SELECT * FROM cita WHERE cita_fecha='$fechac' AND empleado_id='$doctor' ORDER BY cita_fecha DESC");
	$nrow = mysqli_num_rows($consulta);

	if($nrow>0){
		$row=mysqli_fetch_array($consulta);		
		$turno=$row['cita_turno'];
		$turno2=$turno+1;		
	}else{
		$turno2 = 1;
	}

	$guardar=mysqli_query($con,"INSERT INTO cita (cita_fechai, cita_fecha, cita_mensaje, cita_turno, horarios_id, consultorio_id, paciente_id, empleado_id, estado_cita_id) VALUES ('$fecha', '$fechac', '$mensaje', '$turno2', '$hora', '$consultorio', '$idpac', '$doctor', '$estado')") or die ("error".mysqli_error());



	mysqli_close($con);
	header("Location:../agendar_cita.php");

?>