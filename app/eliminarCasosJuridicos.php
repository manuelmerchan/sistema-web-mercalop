<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consPago=mysqli_query($con,"SELECT * FROM pago_abono WHERE id_casos_juridicos='$id' ");
$numPago = mysqli_num_rows($consPago);
if ($numPago>0) {
	mysqli_query($con,"DELETE FROM pago_abono WHERE id_casos_juridicos='$id'");
}

$consDeuda=mysqli_query($con,"SELECT * FROM deudas WHERE id_casos_juridicos='$id' ");
$numDeuda = mysqli_num_rows($consDeuda);
if ($numDeuda>0) {
	mysqli_query($con,"DELETE FROM deudas WHERE id_casos_juridicos='$id'");
}

$consAbgCaso=mysqli_query($con,"SELECT *  FROM asig_caso_abogado WHERE id_casos_juridicos='$id' ");
$numAbgCaso = mysqli_num_rows($consAbgCaso);
if ($numAbgCaso>0) {
	mysqli_query($con,"DELETE FROM asig_caso_abogado WHERE id_casos_juridicos='$id'");
}

$consExpediente=mysqli_query($con,"SELECT * from expedientes where id_casos_juridicos='$id' ");
$numExpediente = mysqli_num_rows($consExpediente);
if ($numExpediente>0) {
	mysqli_query($con,"DELETE FROM expedientes WHERE id_casos_juridicos='$id'");
}

$consOponente=mysqli_query($con,"SELECT * from oponente where id_casos_juridicos='$id' ");
$numOponente = mysqli_num_rows($consOponente);
if ($numOponente>0) {
	mysqli_query($con,"DELETE FROM oponente WHERE id_casos_juridicos='$id'");
}

$consFactura=mysqli_query($con,"SELECT * from facturas where casos_juridicos='$id' ");
$numFactura = mysqli_num_rows($consFactura);
if ($numFactura>0) {
	$rowFactura=mysqli_fetch_array($consFactura);
	$faturaid=$rowFactura['id_facturas'];
	mysqli_query($con,"DELETE FROM detalle_factura WHERE id_facturas='$faturaid'");
	mysqli_query($con,"DELETE FROM expedientes WHERE casos_juridicos='$id'");
}


//########## REGRESAR ACTIVA LA COTIZACION
$consulta3=mysqli_query($con,"SELECT * from casos_juridicos where id_casos_juridicos='$id' ");
$row3=mysqli_fetch_array($consulta3);
$id_cotizacion=$row3['id_cotizacion'];
$modificar=mysqli_query($con,"UPDATE cotizacion SET id_estado='1'  where id_cotizacion='$id_cotizacion' ") or die ("error".mysqli_error());


//########## ELIMINO EL CASO JURIDICO
// mysqli_query($con,"UPDATE casos_juridicos SET id_estado='2' WHERE id_casos_juridicos='$id'");
mysqli_query($con,"DELETE FROM casos_juridicos WHERE id_casos_juridicos='$id'");
$_SESSION['eliminar']=1;

header('Location:../buscar_caso_juridico.php');
?>
