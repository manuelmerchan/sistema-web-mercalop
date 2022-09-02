<?php

include('conexionodbc.php');
session_start();
	$id=$_REQUEST['id'];

	$est=$_POST['comboe'];
	$nomp=$_POST['nomp'];
	$apep=$_POST['apep'];
	$ced=$_POST['cedp'];
	$pasa=$_POST['pasap'];
	$fechnacp=$_POST['fechnac'];
	$ano=$_POST['anos'];
	$mes=$_POST['meses'];
	$dia=$_POST['dias'];
	$gen=$_POST['combo'];
	$direccion=$_POST['dirp'];
	$telefono=$_POST['telefp'];
	$celular=$_POST['celp'];
	$email=$_POST['correop'];

	$nomref=$_POST['nomref'];
	$aperef=$_POST['aperef'];
	$par=$_POST['combop'];
	$telref=$_POST['telref'];

$asd=odbc_exec($conn,"UPDATE dbo.paciente SET pac_nom='$nomp', pac_ape='$apep', pac_fechnac='$fechnacp', pac_anos='$ano', pac_meses='$mes', pac_dias='$dia', pac_cedula='$ced', pac_pasaporte='$pasa', pac_direccion='$direccion', pac_telefono='$telefono', pac_celular='$celular', pac_email= '$email', gen_id='$gen', est_id='$est', par_id='$par', pac_par_nom='$nomref', pac_par_ape='$aperef', pac_par_telef='$telref' WHERE pac_id=$id");
$_SESSION['editap']=1;

odbc_close($conn);
header('Location:reg_paciente.php');
?>


