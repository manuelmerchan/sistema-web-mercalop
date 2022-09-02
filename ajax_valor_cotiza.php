<?php
include('config/conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  	$id_estu=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT * from cotizacion where  id_cotizacion='$id_estu'");
	$rows=mysqli_num_rows($consulta);
	if ($rows>0) {
    $row=mysqli_fetch_array($consulta);
  		$salida=$row['total_pagar'];
	}else {
  		$salida="";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
