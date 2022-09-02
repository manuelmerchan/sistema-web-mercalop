<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];
$idcj=$_REQUEST['idcsj'];


$_SESSION['eliminar']=1;
mysqli_query($con,"DELETE FROM pago_abono WHERE id_pago_abono='$id'");
header("Location:../ingreso_pago_caso_juridico.php?id=$idcj");
?>
