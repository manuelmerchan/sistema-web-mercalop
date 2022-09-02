<?php
	session_start();
	include ("conexion.php");
	$fecha=date('Y-m-d H:i:s');
  $id = $_REQUEST["id"];
	$pass1 = $_POST["clave"];
	$pass2 = $_POST["clave2"];

  if ($pass1!="" && $pass2!="") {
    	if ($pass1==$pass2) {
        $consulta=mysqli_query($con,"UPDATE clientes SET clave='$pass1' WHERE id_clientes='$id'") or die ("error".mysqli_error());
        $_SESSION['confirmar']=1;
      }
  }

	mysqli_close($con);
	header("Location:perfil.php?id=$id");

?>
