<?php
	session_start();
	include ("../config/conexion.php");
  $time = time();
  $fecha= date("Y-m-d H:i:s", $time);
    $id=$_REQUEST['id'];
	$_SESSION['confirmar']=2;

  $nombre = $_POST["nombre"];
  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      $key='';
      $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
      $max = strlen($pattern)-1;
      for($i=0;$i < 5;$i++){
         $key .= $pattern{mt_rand(0,$max)};
       }

      $doc="doc_digi/".$key.$foto2;
      copy($ruta2,"../".$doc);
  }else {
    $result2= mysqli_query($con,"SELECT * from digitalizacion where id_digitalizacion='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $doc=$row2['documento'];

  }
	$categoria = $_POST["categoria"];
  $estado = '1';

	$consulta=mysqli_query($con,"UPDATE digitalizacion SET   nombre='$nombre',documento='$doc',id_categoria='$categoria' where id_digitalizacion='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_digitalizar.php");

?>
