<?php
  session_start();
	include ("../config/conexion.php");
	$_SESSION['confirmar']=2;

  $id=$_REQUEST['id'];
  $idcj=$_REQUEST['idcj'];

  $deuda = $_POST["deuda"];
  $descrip = $_POST["descrip"];

  $ingreso3=mysqli_query($con,"UPDATE deudas SET valor_deuda='$deuda',descripcion='$descrip' where id_deudas='$id' ") or die ("error".mysqli_error());

	mysqli_close($con);
	header("Location:../ingreso_deuda_caso_juridico.php?id=$idcj");

?>
