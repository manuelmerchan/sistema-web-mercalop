<?php
session_start();
include('../config/conexion.php');

$data = false;
$usuario=$_POST['usuario'];
$clave=$_POST['password'];

$usuario2=mysqli_real_escape_string($con,$usuario);
$clave2=mysqli_real_escape_string($con,$clave);

$consulta="SELECT * FROM usuarios U inner join empleados E on E.cedula=U.id_empleados  WHERE U.usuario='$usuario2' AND U.clave='$clave2' AND E.id_estado='1'";
$resultado=mysqli_query($con, $consulta);
$num=mysqli_num_rows($resultado);

if ($num > 0) {
	$row = mysqli_fetch_array($resultado);
  	$_SESSION['ID_EMPLE'] = $row['cedula'];
  	$_SESSION['NOM_EMPLE'] = $row['nombres']." ".$row['apellidos'];
		$_SESSION['TIPO_EMPLE'] = $row['id_tipo_empleado'];

		$_SESSION['CONF']= $row["configuracion"];
		$_SESSION['REG']= $row["registrar"];
		$_SESSION['COT']= $row["cotizacion"];
		$_SESSION['CJ']= $row["caso_juridico"];
		$_SESSION['CUEN']= $row["cuentas"];
		$_SESSION['FACT']= $row["facturas"];
		$_SESSION['REPO']= $row["reportes"];

	$data= "entro";
// 	header("Location:../inicio.php");
}else{
    $_SESSION["permisos"] = "";
    $data = null;
}
print json_encode($data);
mysqli_close($con);
?>
