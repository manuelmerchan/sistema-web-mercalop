<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
	$id = $_REQUEST["id"];

	$_SESSION['confirmar']=2;


		if ($_FILES["foto"]["name"]!="") {
	   		$foto=$_FILES["foto"]["name"];
	   		$ruta=$_FILES["foto"]["tmp_name"];
	   		$logo="img_empleados/".$foto;
	   		copy($ruta,"../".$logo);
	 	}else {
			$result2= mysqli_query($con,"SELECT * from empleados where id_empleados='$id'");
			$row2= mysqli_fetch_assoc($result2);
			$logo=$row2['foto'];
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



	$consulta=mysqli_query($con,"UPDATE empleados SET foto='$logo', cedula='$cedula', nombres='$nombres', apellidos='$apellidos', id_genero='$genero',
		 id_estado_civil='$estado_civil', correo='$correo', telefono='$telefono', direccion='$direccion', id_tipo_empleado='$tipo_emple' WHERE id_empleados='$id'") or die ("error".mysqli_error());


	// header("Location:../editar_empleado.php?ide=$ide");
	header("Location:../buscar_empleados.php");
	mysqli_close($con);
?>
