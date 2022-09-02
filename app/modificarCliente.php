<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
	$id = $_REQUEST["id"];

	$_SESSION['confirmar']=2;


		$nombres = $_POST["nombres"];
		$apellidos = $_POST["apellidos"];
		$cedula = $_POST["cedula"];
		$genero = $_POST["genero"];
		$correo = $_POST["correo"];
		$telefono = $_POST["telefono"];
		$direccion = $_POST["direccion"];
		$estado_civil = $_POST["estado_civil"];
		$tipo_cliente= $_POST["tipo_cliente"];



	$consulta=mysqli_query($con,"UPDATE clientes SET  cedula='$cedula', nombres='$nombres', apellidos='$apellidos', id_genero='$genero',
		 id_estado_civil='$estado_civil', correo='$correo', telefono='$telefono', direccion='$direccion', id_tipo_cliente='$tipo_cliente' WHERE id_clientes='$id'") or die ("error".mysqli_error());


	// header("Location:../editar_empleado.php?ide=$ide");
	header("Location:../buscar_clientes.php");
	mysqli_close($con);
?>
