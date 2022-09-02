<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
  $hora=date('H:i:s');

	$_SESSION['confirmar']=1;

	$nfactura = $_POST["nfactura"];
	$clientes = $_POST["clientes"];
  $cedula = $_POST["cedula"];
  $servicios = $_POST["servicios"];
  $subtotal = $_POST["subtotal"];
  $descuento ="";
  $iva = $_POST["iva"];
  $totalp = $_POST["totalp"];
  $estado='1';

	$consulta=mysqli_query($con,"SELECT * from clientes where cedula='$cedula' ");
	  $row=mysqli_fetch_array($consulta);
	  $id_clientes=$row['cedula'];



	$consulta=mysqli_query($con,"INSERT INTO cotizacion (fecha, hora, num_cotizacion, id_clientes, id_servicios, sub_total, descuento, iva, total_pagar,id_estado)
   VALUES ('$fecha','$hora','$nfactura','$id_clientes','$servicios','$subtotal','$descuento','$iva','$totalp','$estado')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_cotizacion.php");

?>
