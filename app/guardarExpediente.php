<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
  $hora=date('H:i:s');

	$_SESSION['confirmar']=1;

  $id_cj=$_REQUEST['id'];
	$lugar = $_POST["lugar"];
  $codigo = $_POST["codigo"];
  $nombre_anexo = $_POST["nombre_anexo"];
  $num_anexos = $_POST["num_anexos"];
  $solicitarpago = $_POST["solicitarpago"];
  if ($solicitarpago!=""){
    $solicitarpago = $_POST["solicitarpago"]; 
  }else{
    $solicitarpago = 0;
  }

  if ($_FILES["documento"]["name"]!="") {
      $foto2=$_FILES["documento"]["name"];
      $ruta2=$_FILES["documento"]["tmp_name"];
      $key='';
      $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
      $max = strlen($pattern)-1;
      for($i=0;$i < 5;$i++){
         // $key .= $pattern{mt_rand(0,$max)};
        $key .= $pattern[mt_rand(0,$max)];
       }

      $doc="doc_expe_cj/".$key.$foto2;
      copy($ruta2,"../".$doc);
  }else {
      $doc="";
  }


$estado='1';


$consulta=mysqli_query($con,"INSERT INTO expedientes (fecha, hora, lugares,codigo_exp, nombre_anexo, num_doc_anexados, documento, id_casos_juridicos, solicitud_pago, id_estado) VALUES ('$fecha','$hora','$lugar','$codigo','$nombre_anexo','$num_anexos','$doc','$id_cj','$solicitarpago','$estado')") or die ("error".mysqli_error());

mysqli_close($con);
header("Location:../ingreso_expedientes.php?id=$id_cj");

?>
