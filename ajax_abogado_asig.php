<?php
include ("config/conexion.php");
$salida="";
if(isset($_POST['consul'])){
  $repartidor=$_POST['consul'];
  $consulta=mysqli_query($con,"SELECT * from  empleados WHERE cedula='$repartidor'");
  $row=mysqli_fetch_array($consulta);
  $num=mysqli_num_rows($consulta);
  if($num!=0){
    $salida.="<center><img src='".$row['foto']."' alt='' width='200' height='200'></center><br>";
  }else{
    $salida.="<center><img src='img_empleados/defoult.jpg' alt='' width='200' height='200'></center><br>";
  }

}else {
  $salida="";
}

echo $salida;
mysqli_close($con);

 ?>
