<?php
session_start();
include('../config/conexion.php');
$id=$_REQUEST['id'];

$consCaso=mysqli_query($con,"SELECT * FROM casos_juridicos WHERE id_tipo_caso='$id'");
$numConsCaso=mysqli_num_rows($consCaso);
if ($numConsCaso>0) {
    $_SESSION['confi']=10;
    header('Location:../ingreso_tipo_caso.php');
}else{
    // ELIMINO LOS REGISTROS DE DETALLE_TIPO_CASO QUE PERTENEZCAN A TIPO_CASO
    $consTipoCaso=mysqli_query($con,"SELECT * FROM detalle_tipo_caso WHERE id_tipo_caso='$id'");
    $numConsTipo=mysqli_num_rows($consTipoCaso);
    if ($numConsTipo!=0) {
        mysqli_query($con,"DELETE FROM detalle_tipo_caso WHERE id_tipo_caso='$id'");
    }

    // ELIMINO EL TIPO_CASO
    $consulta=mysqli_query($con,"DELETE FROM tipo_caso WHERE id_tipo_caso='$id'");

    $_SESSION['eliminar']=1;
    header('Location:../ingreso_tipo_caso.php');
}

?>
