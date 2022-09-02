<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=2;


  $id=$_REQUEST['id'];

$provincia=$_POST["provincias"];
$ciudad=$_POST["ciudades"];

$codigo=$_POST["codigo"];

	$tipo_caso = $_POST["tipo_caso"];
  $detalle_tipo_caso = $_POST["detalletc"];
  $cotizacion = $_POST["cotizacion"];
  $pago_ini = $_POST["pago_ini"];
  $descripcion = $_POST["descripcion"];

	$estado_cotiza1='1';
	$estado_cotiza2='4';


	$consultac=mysqli_query($con,"SELECT * from casos_juridicos where  id_casos_juridicos='$id'");
	$rowc=mysqli_fetch_array($consultac);
	$idcoti=$rowc['id_cotizacion'];
	$modificarc=mysqli_query($con,"UPDATE cotizacion SET id_estado='$estado_cotiza1'  where id_cotizacion='$idcoti' ") or die ("error".mysqli_error());
$modificar=mysqli_query($con,"UPDATE cotizacion SET id_estado='$estado_cotiza2'  where id_cotizacion='$cotizacion' ") or die ("error".mysqli_error());


	$ingreso=mysqli_query($con,"UPDATE casos_juridicos SET  provincia='$provincia',ciudad='$ciudad', codigo='$codigo', id_tipo_caso='$tipo_caso',detalle_tipo_caso='$detalle_tipo_caso', valor_pago_inicial='$pago_ini',descripcion='$descripcion',id_cotizacion='$cotizacion' where id_casos_juridicos='$id' ") or die ("error".mysqli_error());

  $consulta=mysqli_query($con,"SELECT * from pago_abono where id_casos_juridicos='$id' order by id_pago_abono ASC ");
  $row=mysqli_fetch_array($consulta);
  $idpa=$row['id_pago_abono'];

	$ingreso2=mysqli_query($con,"UPDATE pago_abono SET  abono='$pago_ini' where id_pago_abono='$idpa' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../buscar_caso_juridico.php");

?>
