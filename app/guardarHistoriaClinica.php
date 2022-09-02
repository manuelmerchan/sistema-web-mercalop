<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=3;

	$idemp=$_SESSION['empid'];

	$id = $_POST['idp'];
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
	$codigo = $_POST['codigo'];

	$consulta=mysqli_query($con,"INSERT INTO historia_clinica (historia_clinica_fechai, historia_clinica_fecham, historia_clinica_codigo, historia_clinica_motivo, historia_clinica_enfermedadact, historia_clinica_antecedentesp, historia_clinica_antecedentesf, historia_clinica_talla, historia_clinica_peso, historia_clinica_frespiratoria, historia_clinica_fcardiaca, historia_clinica_te, historia_clinica_ta, historia_clinica_descripcion, historia_clinica_diagnostico, historia_clinica_analisis, historia_clinica_plan, paciente_id, empleado_id) VALUES ('$fecha', '$fecha', '$codigo', '$motivo', '$enfermedadactual', '$antecedentesp', '$antecedentesf', '$talla', '$peso', '$frecuenciar', '$frecuenciac', '$te', '$ta', '$descripcion', '$diagnostico', '$analisis', '$plan', '$id', '$idemp')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_historia_clinica.php");

?>