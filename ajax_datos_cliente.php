<?php
include('config/conexion.php');
$salida="";
if(isset($_POST['consulta'])){
  	$id_estu=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT * from clientes where id_clientes='$id_estu'");
	$nrows=mysqli_num_rows($consulta);
	if ($nrows>0) {
    $row=mysqli_fetch_assoc($consulta);

  		$salida=$row['cedula']."**".$row['nombres']." ".$row['apellidos']."**".$row['telefono']."**".$row['correo']."**".$row['direccion'];
	}else {
  		$salida="";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
