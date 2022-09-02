<?php
	session_start();
	include ("../config/conexion.php");
  $time = time();
  $fecha= date("Y-m-d H:i:s", $time);

	$_SESSION['confirmar']=1;

  $nombre = $_POST["nombre"];
  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      // $key='';
      // $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
      // $max = strlen($pattern)-1;
      // for($i=0;$i < 5;$i++){
      //    $key .= $pattern{mt_rand(0,$max)};
      //  }
      // $doc="doc_digi/".$key.$foto2;

      $doc="doc_digi/".$foto2;
      copy($ruta2,"../".$doc);
  }else {
      $doc="";
  }
	$categoria = $_POST["categoria"];
  $estado = '1';

	$consulta=mysqli_query($con,"INSERT INTO digitalizacion (fecha, nombre,documento,id_categoria,id_estado) VALUES ('$fecha','$nombre','$doc','$categoria','$estado')") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_digitalizar.php");

?>
