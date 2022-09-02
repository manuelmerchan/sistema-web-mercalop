<?php
include('config/conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  	$id_estu=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT * from servicios where id_servicios='$id_estu'");
	$nrows=mysqli_num_rows($consulta);
	if ($nrows>0) {
    $row=mysqli_fetch_assoc($consulta);

  		$salida=$row['valor'];
	}else {
  		$salida="";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
