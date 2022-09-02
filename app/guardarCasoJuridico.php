<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
  $hora=date('H:i:s');

  $id_emple=$_SESSION['ID_EMPLE'];
	$_SESSION['confirmar']=1;

$provincia=$_POST["provincias"];
$ciudad=$_POST["ciudades"];
	$codigo = $_POST["codigo"];
	$tipo_caso = $_POST["tipo_caso"];
  $detalle_tipo_caso = $_POST["detalletc"];
  $cotizacion = $_POST["cotizacion"];
  $pago_ini = $_POST["pago_ini"];
  $descripcion = $_POST["descripcion"];

  $consulta=mysqli_query($con,"SELECT * from cotizacion C inner join clientes CL on CL.cedula=C.id_clientes where id_cotizacion='$cotizacion'");
  $row=mysqli_fetch_array($consulta);
  $idCli=$row['cedula'];
	$tp_coti=$row['total_pagar'];

$id_ayu=$id_emple;
$estado=1;
$estado_cotiza=4;

$modificar=mysqli_query($con,"UPDATE cotizacion SET id_estado='$estado_cotiza'  where id_cotizacion='$cotizacion' ") or die ("error 1".mysqli_error());


	$ingreso=mysqli_query($con,"INSERT INTO casos_juridicos (fecha, hora, codigo,provincia,ciudad, id_tipo_caso,detalle_tipo_caso, valor_pago_inicial,descripcion, id_clientes, id_cotizacion, id_abg_ayudante, id_empleados,id_estado)
   VALUES ('$fecha','$hora','$codigo','$provincia','$ciudad','$tipo_caso', '$detalle_tipo_caso','$pago_ini','$descripcion','$idCli','$cotizacion','$id_ayu','$id_emple','$estado')") or die ("error 2".mysqli_error());

	 $consulta2=mysqli_query($con,"SELECT * from casos_juridicos order by id_casos_juridicos DESC ");
	 $row2=mysqli_fetch_array($consulta2);
	 $idCj=$row2['id_casos_juridicos'];

	 	$ingreso2=mysqli_query($con,"INSERT INTO pago_abono (fecha, hora, abono, id_empleados, id_casos_juridicos) VALUES ('$fecha','$hora','$pago_ini','$id_emple','$idCj')") or die ("error 3".mysqli_error());

		$decripc='Valor del Caso';
		$ingreso3=mysqli_query($con,"INSERT INTO deudas (fecha, valor_deuda, descripcion, id_casos_juridicos) VALUES ('$fecha','$tp_coti','$decripc','$idCj')") or die ("error 4".mysqli_error());



	mysqli_close($con);
	header("Location:../ingreso_caso_juridico.php");

?>
