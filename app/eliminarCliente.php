<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$_SESSION['eliminar']=1;
mysqli_query($con,"UPDATE clientes SET id_estado='2' WHERE id_clientes='$id'");
header('Location:../buscar_clientes.php');
?>
