<?php
	session_start();
	include ("../config/conexion.php");

	$_SESSION['confirmar']=1;
    $id=$_REQUEST['id'];

	$cedulap = $_POST["cedulap"];
  $nombrep= $_POST["nombrep"];
  $abogado = $_POST["abogado"];

  $consulta=mysqli_query($con,"SELECT * from oponente where id_casos_juridicos='$id'");
  $nrow=mysqli_num_rows($consulta);
  if ($nrow>0) {
    $row=mysqli_fetch_array($consulta);
    $idopo=$row['id_oponente'];
    $nodifica=mysqli_query($con,"UPDATE oponente SET nombres_abogado='$abogado',cedula_persona='$cedulap',nombres_persona='$nombrep' where id_oponente='$idopo' ") or die ("error".mysqli_error());
  }else{
    	$ingresa=mysqli_query($con,"INSERT INTO oponente (nombres_abogado,cedula_persona,nombres_persona,id_casos_juridicos) VALUES ('$abogado','$cedulap','$nombrep','$id')") or die ("error".mysqli_error());
  }




	mysqli_close($con);
	header("Location:../buscar_caso_juridico.php");

?>
