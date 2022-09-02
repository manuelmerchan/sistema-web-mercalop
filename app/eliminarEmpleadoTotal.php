<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];
$idemple=$_SESSION['ID_EMPLE'];

$consCaso=mysqli_query($con,"SELECT * FROM casos_juridicos WHERE id_empleados='$id' AND id_estado!='2'");
$numConsCaso=mysqli_num_rows($consCaso);

$consAbgCaso=mysqli_query($con,"SELECT * FROM asig_caso_abogado WHERE id_empleados='$id'");
$numAsigCaso=mysqli_num_rows($consAbgCaso);

if ($numConsCaso>0 || $numAsigCaso>0) {
	$_SESSION['esta']=11;
	header('Location:../lista_Restaurar_empleado.php');
}else{
	$consUsuario=mysqli_query($con,"SELECT * FROM usuarios WHERE id_empleados='$id'");
	$numConsUsuario=mysqli_num_rows($consUsuario);
	if ($numConsUsuario>0) {
		mysqli_query($con,"DELETE FROM usuarios WHERE id_empleados='$id'");
	}	
	mysqli_query($con,"DELETE FROM empleados WHERE cedula='$id'");
	$_SESSION['eliminar']=1;
	header('Location:../lista_Restaurar_empleado.php');
}

?>