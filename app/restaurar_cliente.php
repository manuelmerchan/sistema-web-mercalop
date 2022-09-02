<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['confirmar']=1;
mysqli_query($con,"UPDATE clientes SET id_estado='1' WHERE id_clientes='$id'");
header('Location:../lista_Restaurar_cliente.php');
?>
