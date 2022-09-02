<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

	</body>
</html>
<?php
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
    $hora=date('H:i:s');

	$_SESSION['confirmar']=1;
    $id_emple=$_SESSION['ID_EMPLE'];


	$nfactura = $_POST["nfactura"];
//	$clientes = $_POST["clientes"];
  $cedula = $_POST["cedula"];

	if (isset($_POST["servicios"])) {
		   $servicios = $_POST["servicios"];
			 $caso_juri = 0;
	}else {
		$servicios=0;
		$id=$_REQUEST['id'];
		$caso_juri =$id;
	}

  $subtotal = $_POST["subtotal"];

  $iva = $_POST["iva"];
  $totalp = $_POST["totalp"];
  $estado ="1";

	$consulta=mysqli_query($con,"SELECT * from clientes where cedula='$cedula' ");
	  $row=mysqli_fetch_array($consulta);
	  $id_clientes=$row['cedula'];
   
	$ingreso=mysqli_query($con,"INSERT INTO facturas (fecha, hora, num_fact,sub_total, iva, total,servicios, casos_juridicos, id_clientes, id_empleados, id_estado)
   VALUES ('$fecha','$hora','$nfactura','$subtotal','$iva','$totalp','$servicios','$caso_juri','$id_clientes','$id_emple','$estado')") or die ("error 1".mysqli_error());

	 $consulta2=mysqli_query($con,"SELECT * from facturas ORDER BY id_facturas DESC ");
	  $row2=mysqli_fetch_array($consulta2);
	  $id_facturas=$row2['id_facturas'];

if ($servicios=="0") {	 
		$consulta3=mysqli_query($con,"SELECT * from deudas where id_casos_juridicos='$id' ");
		while($row3=mysqli_fetch_array($consulta3)){
			$id_deudas=$row3['id_deudas'];
			$ingreso=mysqli_query($con,"INSERT INTO detalle_factura (id_deudas, id_facturas ) VALUES ('$id_deudas','$id_facturas')") or die ("error 2".mysqli_error());
}
$modificar=mysqli_query($con,"UPDATE casos_juridicos SET id_estado='3' where id_casos_juridicos='$id' ") or die ("error 3".mysqli_error());
mysqli_close($con);

?>

		<script type="text/javascript">
		 var id='<?php echo $id_facturas; ?>';
			window.open('../report/factura.php?id='+id, '_blank');
			window.location.href = "../lista_factura_casos.php";
		</script>


<?php
}else{
mysqli_close($con);
	?>
			<script type="text/javascript">
			 var id='<?php echo $id_facturas; ?>';
				window.open('../report/factura.php?id='+id, '_blank');
				window.location.href = "../ingreso_factura_x_clientes.php";
			</script>

	<?php
}



?>
