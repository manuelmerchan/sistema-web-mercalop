<?php
session_start();
include('../config/conexion.php');
//$id=$_REQUEST['id'];
$iva=$_POST["iva"];

if (filter_var($iva+0, FILTER_VALIDATE_INT)) {
    $descrip_iva=intval($iva)."%";
} else {
    $descrip_iva=$iva."%";
}

$_SESSION['confirmar']=1;
//mysqli_query($con,"UPDATE iva SET valor_iva='$iva',descrip_iva='$descrip_iva' WHERE id_iva='1'");

$consulta=mysqli_query($con,"INSERT INTO iva (descrip_iva,valor_iva,id_estado) VALUES ('$descrip_iva','$iva','2')") or die ("error".mysqli_error());

header('Location:../ingreso_iva.php');
?>
