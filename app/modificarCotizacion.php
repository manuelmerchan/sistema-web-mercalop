<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
  $hora=date('H:i:s');

	$_SESSION['confirmar']=1;
  	$id = $_REQUEST["id"];

	$nfactura = $_POST["nfactura"];
  $cedula = $_POST["cedula"];
  $servicios = $_POST["servicios"];
  $subtotal = $_POST["subtotal"];
  $descuento = "";
  $iva = $_POST["iva"];
  $totalp = $_POST["totalp"];

	$consulta=mysqli_query($con,"SELECT * from clientes where cedula='$cedula' ");
	  $row=mysqli_fetch_array($consulta);
	  $id_clientes=$row['cedula'];

	$consulta=mysqli_query($con,"UPDATE cotizacion SET id_clientes='$id_clientes', id_servicios='$servicios', sub_total='$subtotal', descuento='$descuento', iva='$iva', total_pagar='$totalp' where id_cotizacion='$id'") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../buscar_cotizacion.php");

?>
