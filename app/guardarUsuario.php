<?php
	session_start();
	include ("../config/conexion.php");

	$id = $_REQUEST["id"];

	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];

	$configuracion= $_POST["configuracion"];
	$registrar= $_POST["registrar"];
	$cotizacion= $_POST["cotizacion"];
	$judiciales= $_POST["judiciales"];
	$cuentas= $_POST["cuentas"];
	$facturas= $_POST["facturas"];
	$reportes= $_POST["reportes"];


	$consulta2="SELECT * FROM usuarios U INNER JOIN empleados E ON U.id_empleados=E.cedula WHERE U.id_empleados='$id'";
  	$ejec2=mysqli_query($con,$consulta2);
  	$nrow2=mysqli_num_rows($ejec2);

  	if ($nrow2>0) {
		$row2=mysqli_fetch_assoc($ejec2);
		$idU=$row2['id_usuarios'];

		$consulta=mysqli_query($con,"UPDATE usuarios SET usuario='$usuario', clave='$clave', configuracion='$configuracion',registrar='$registrar', cotizacion='$cotizacion', caso_juridico='$judiciales', cuentas='$cuentas', facturas='$facturas', reportes='$reportes' WHERE id_usuarios='$idU'") or die ("error".mysqli_error());
		$_SESSION['confirmar']=2;
	}else{
		// $tipo_usuario = 1;
		$consulta=mysqli_query($con,"INSERT INTO usuarios (usuario, clave, configuracion, registrar, cotizacion, caso_juridico, cuentas, facturas, reportes, id_empleados) VALUES ('$usuario', '$clave', '$configuracion', '$registrar', '$cotizacion', '$judiciales', '$cuentas', '$facturas', '$reportes', '$id')") or die ("error".mysqli_error());
		$_SESSION['confirmar']=1;
	}

	// unset($_SESSION['exis']);

	mysqli_close($con);
	header("Location:../buscar_empleados.php");

?>
