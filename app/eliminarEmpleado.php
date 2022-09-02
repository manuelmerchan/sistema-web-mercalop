<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];
$idemple=$_SESSION['ID_EMPLE'];
if ($id==$idemple) {
	$_SESSION['confi']=10;
	header('Location:../buscar_empleados.php');
}else{
	// $consCaso=mysqli_query($con,"SELECT * FROM casos_juridicos WHERE id_empleados='$id' AND id_estado!='2'");
	// $numConsCaso=mysqli_num_rows($consCaso);

	// $consAbgCaso=mysqli_query($con,"SELECT * FROM asig_caso_abogado WHERE id_empleados='$id'");
	// $numAsigCaso=mysqli_num_rows($consAbgCaso);

	// if ($numConsCaso>0 || $numAsigCaso>0) {
	// 	$_SESSION['esta']=11;
	// 	header('Location:../buscar_empleados.php');
	// }else{
		// mysqli_query($con,"UPDATE empleados SET id_estado='2' WHERE cedula='$id'");
		// $_SESSION['eliminar']=1;
		// header('Location:../buscar_empleados.php');
		
	// }
	mysqli_query($con,"UPDATE empleados SET id_estado='2' WHERE cedula='$id'");
		$_SESSION['eliminar']=1;
		header('Location:../buscar_empleados.php');
}
?>