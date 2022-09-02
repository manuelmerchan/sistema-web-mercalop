<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consFactura=mysqli_query($con,"SELECT * FROM facturas WHERE id_clientes='$id'");
$numConsFactura=mysqli_num_rows($consFactura);

$consCotizacion=mysqli_query($con,"SELECT * FROM cotizacion WHERE id_clientes='$id'");
$numConsCotiza=mysqli_num_rows($consCotizacion);
if ($numConsCotiza>0) {
	$rowConsCotizacion=mysqli_fetch_array($consCotizacion);
	$id_cotizacion=$rowConsCotizacion['id_cotizacion'];

	$consCaso=mysqli_query($con,"SELECT * FROM casos_juridicos WHERE id_cotizacion='$id_cotizacion'");
	$numConsCaso=mysqli_num_rows($consCaso);
}else{
	$numConsCaso=0;
}

if ($numConsFactura>0 || $numConsCotiza>0 || $numConsCaso>0) {
	$_SESSION['esta']=11;
	header('Location:../lista_Restaurar_cliente.php');
}else{
	mysqli_query($con,"DELETE FROM clientes WHERE cedula='$id'");
	$_SESSION['eliminar']=1;
	header('Location:../lista_Restaurar_cliente.php');
}

?>