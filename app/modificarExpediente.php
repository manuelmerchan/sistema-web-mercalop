<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');
  $hora=date('H:i:s');

	$_SESSION['confirmar']=1;

  $id=$_REQUEST['id'];
  $idcsj=$_REQUEST['idcsj'];

	$lugar = $_POST["lugar"];
  $codigo = $_POST["codigo"];
  $nombre_anexo = $_POST["nombre_anexo"];
  $num_anexos = $_POST["num_anexos"];
  $solicitarpago = $_POST["solicitarpago"];

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
    $result2= mysqli_query($con,"SELECT * from expedientes where id_expedientes='$id'");
    $row2= mysqli_fetch_assoc($result2);
    $doc=$row2['documento'];

  }

	$consulta=mysqli_query($con,"UPDATE expedientes SET  lugares='$lugar',codigo_exp='$codigo', nombre_anexo='$nombre_anexo', num_doc_anexados='$num_anexos', documento='$doc', solicitud_pago='$solicitarpago' where id_expedientes='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_expedientes.php?id=$idcsj");

?>
