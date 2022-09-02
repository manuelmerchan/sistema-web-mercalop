<?php
session_start();
include('../config/conexion.php');


$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

$consulta="SELECT * FROM usuario WHERE usuario_nombre='$usuario' AND usuario_clave='$clave'";
$resultado=mysqli_query($con, $consulta);
$num=mysqli_num_rows($resultado);

$row = mysqli_fetch_assoc($resultado);
$id = $row['user_id']; // id del que ingresa
$idu = $row['usuario_id']; // id de la tabla usuario
$tipid = $row['tipo_usuario'];	//	tipo del que ingresa

if ($num == 0) {
	$_SESSION['cont_nologin']+=+1;
	if($_SESSION['cont_nologin'] >=3 ){
		sleep(2);
		header("Location:comprobacionclave.php");
	}else{
		$_SESSION['error_datos']=1;
		header("Location:../ingresar.php");
	}
}else{
	// VERIFICO SI ES EMPLEADO O PACIENTE
	if ($tipid==1) {
		$consulta2=mysqli_query($con,"SELECT * FROM empleado WHERE empleado_id='$id'") or die ("error".mysqli_error());
		$num2=mysqli_num_rows($consulta2);
		if ($num2>0) {
			$verif = 1;			
		}
	}
	if ($tipid==2) {
		$consulta3=mysqli_query($con,"SELECT * FROM paciente WHERE paciente_id='$id'") or die ("error".mysqli_error());
		$num3=mysqli_num_rows($consulta3);
		if ($num3>0) {
			$verif = 2;
		}
	}

	// DEFINO PROCESOS PARA QUIEN INGRESA (SI ESTA ACTIVO ETC)
	// 1. PROCESOS PARA EMPLEADOS
	if ($verif==1) {
		$consulta4="SELECT * FROM empleado E INNER JOIN usuario U ON E.empleado_id=U.user_id WHERE E.empleado_id='$id'";
		$resultado4=mysqli_query($con, $consulta4);
		$row4 = mysqli_fetch_array($resultado4);
		if($row4['estado_id']==1) {
			$_SESSION['empid'] = $row4['empleado_id'];

			$nombre_empleado = $row4['empleado_nombres'];
			$parte1 = explode(" ", $nombre_empleado);
			$_SESSION['nombreu'] = $parte1[0];

			$apellido_empleado=$row4['empleado_apellidos'];
			$parte2 = explode(" ", $apellido_empleado);
			$_SESSION['apellidou'] = $parte2[0];

			$_SESSION['estado']=$row4['estado_id'];
			$_SESSION['cargo']=$row4['cargo_id'];
			$_SESSION['perfil']=$row4['perfil_id'];

			$_SESSION['confirm']=1;
			$_SESSION['mnsj_ingreso']=1;
			
			$_SESSION['cont_nologin']=0;
			header("Location:../index.php");
		}else{
			$_SESSION['sms_noactivo']=1;
			header("Location:../ingresar.php");
		}
	}

	// 2. PROCESOS PARA PACIENTES
	if ($verif==2) {
		$consulta5="SELECT * FROM paciente P INNER JOIN usuario U ON P.paciente_id=U.user_id WHERE P.paciente_id='$id'";
		$resultado5=mysqli_query($con, $consulta5);
		$row5 = mysqli_fetch_array($resultado5);
		if($row5['estado_id']==1) {
			$_SESSION['id_paciente'] = $row5['paciente_id'];

			$nombre_paciente = $row5['paciente_nombres'];
			$parteu = explode(" ", $nombre_paciente);
			$_SESSION['nombrep1'] = $parteu[0];

			$apellido_paciente = $row5['paciente_apellidos'];
			$parte2 = explode(" ", $apellido_paciente);
			$_SESSION['apellidop1'] = $parte2[0];

			$_SESSION['estadop1']=$row5['estado_id'];

			$_SESSION['confirm1']=1;
			$_SESSION['mnsj_ingreso1']=1;

			$_SESSION['cont_nologin']=0;
			header("Location:../../index.php");
		}else{
			$_SESSION['sms_noactivo']=1;
			header("Location:../ingresar.php");
		}
	}

}
mysqli_close($con);
?>