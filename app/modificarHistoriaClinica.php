<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=2;
	$idp = $_REQUEST["idp"];

	$motivo = $_POST['motivo'];
	$enfermedadactual = $_POST['enfermedadactual'];
	$antecedentesp = $_POST['antecedentesp'];
	$antecedentesf = $_POST['antecedentesf'];
	$talla = $_POST['talla'];
	$peso = $_POST['peso'];
	$frecuenciar = $_POST['frecuenciar'];
	$frecuenciac = $_POST['frecuenciac'];
	$te = $_POST['te'];
	$ta = $_POST['ta'];
	$descripcion = $_POST['descripcion'];
	$diagnostico = $_POST['diagnostico'];
	$analisis = $_POST['analisis'];
	$plan = $_POST['plan'];

	$consulta=mysqli_query($con,"UPDATE historia_clinica SET historia_clinica_fecham='$fecha', historia_clinica_motivo='$motivo', historia_clinica_enfermedadact='$enfermedadactual', historia_clinica_antecedentesp='$antecedentesp', historia_clinica_antecedentesf='$antecedentesf', historia_clinica_talla='$talla', historia_clinica_peso='$peso', historia_clinica_frespiratoria='$frecuenciar', historia_clinica_fcardiaca='$frecuenciac', historia_clinica_te='$te', historia_clinica_ta='$ta', historia_clinica_descripcion='$descripcion', historia_clinica_diagnostico='$diagnostico', historia_clinica_analisis='$analisis', historia_clinica_plan='$plan' WHERE paciente_id='$idp'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../buscar_historia.php");

?>