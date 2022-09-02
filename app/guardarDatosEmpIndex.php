<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;

	if ($_FILES["foto"]["name"]!="") {
   		$foto=$_FILES["foto"]["name"];
   		$ruta=$_FILES["foto"]["tmp_name"];
   		$logo="img_empleados/".$foto;
   		copy($ruta,"../".$logo);
 	}else {
   		$logo=$_POST["fotoguardada"];
	}
	$correo = $_POST["correo"];
	$telefono = $_POST["telefono"];
	$direccion = $_POST["direccion"];
	$clave = $_POST["clave"];
	$ide = $_POST["idemp"];

	$consulta=mysqli_query($con,"UPDATE empleados SET foto='$logo', correo='$correo', telefono='$telefono', direccion='$direccion' WHERE id_empleados='$ide'") or die ("error".mysqli_error());

	$consulta2=mysqli_query($con,"UPDATE usuarios SET clave='$clave' WHERE id_empleados='$ide'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../inicio.php");

?>
