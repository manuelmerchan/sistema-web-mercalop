<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_empleados/".$foto;
   		copy($ruta,"../".$logo);
 	}else {
   		$logo="img_empleados/defoult.jpg";
	}
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$cedula = $_POST["cedula"];
	$genero = $_POST["genero"];
	$correo = $_POST["correo"];
	$telefono = $_POST["telefono"];
	$direccion = $_POST["direccion"];
	$estado_civil = $_POST["estado_civil"];
	$tipo_emple = $_POST["tipo_emple"];


	$estado = "1";

	$consulta=mysqli_query($con,"INSERT INTO empleados (fecha, foto, cedula, nombres, apellidos, id_genero, id_estado_civil, correo, telefono, direccion, id_estado, id_tipo_empleado) VALUES
	('$fecha', '$logo', '$cedula', '$nombres', '$apellidos', '$genero', '$estado_civil', '$correo', '$telefono', '$direccion', '$estado', '$tipo_emple')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_empleados.php");

?>
