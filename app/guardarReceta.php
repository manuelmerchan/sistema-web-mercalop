<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

	$_SESSION['confirmar']=1;

	if (isset($_SESSION['empid'])) {
		$idemp=$_SESSION['empid'];
	}else{
		$idemp=1;
	}

	$idpac = $_POST["idpac"];
	$nombres = $_POST["nombres"];
	$celular = $_POST["celular"];
	$correo = $_POST["correo"];

	$medicamento = $_POST["medicamento"];
	$presentacion = $_POST["presentacion"];
	$dosis = $_POST["dosis"];
	$duracion = $_POST["duracion"];
	$cantidad = $_POST["cantidad"];

	// GUARDADO DE CABECERA
	$guardar_cabecera=mysqli_query($con,"INSERT INTO receta_cabecera (receta_fechai, receta_fecham, paciente_id, empleado_id) VALUES ('$fecha', '$fecha', '$idpac', '$idemp')") or die ("error".mysqli_error());
	
	// OBTENEMOS EL ID DE LA CABECERA GUARDADA
	$obtener = mysqli_query($con,"SELECT * FROM receta_cabecera ORDER BY receta_cabecera_id DESC") or die ("erro".mysqli_error());
	$row=mysqli_fetch_array($obtener);
	$idcab = $row['receta_cabecera_id'];

	// GUARDAMOS LOS DATOS EN EL DETALLE
	$guardar_cuerpo = mysqli_query($con,"INSERT INTO receta_cuerpo (receta_medicamento, receta_presentacion, receta_dosis, receta_duracion, receta_cantidad, receta_cabecera_id) VALUES ('$medicamento', '$presentacion', '$dosis', '$duracion', '$cantidad', '$idcab')");

	// GUARDAMOS AÑADIDOS
	if (isset($_POST['opcion'])) {

		$arreglotipe = $_POST['opcion'];
		$num = count($arreglotipe);
		$conta = 0;
		$contenido = '';
		for ($d=0; $d < $num; $d++) {
			$conta++;
			if ($conta<6) {
				$contenido.="*".$arreglotipe[$d];
				
				if ($conta==5) {
					//insert
					$ver = explode('*', $contenido);
					$medicamenton = $ver[1];
					$presentacionn = $ver[2];
					$dosisn = $ver[3];
					$duracionn = $ver[4];
					$cantidadn = $ver[5];
					$cadena = "INSERT INTO receta_cuerpo SET receta_medicamento='$medicamenton', receta_presentacion='$presentacionn', receta_dosis='$dosisn', receta_duracion='$duracionn', receta_cantidad='$cantidadn', receta_cabecera_id='$idcab'";
					mysqli_query($con,$cadena);
					$conta=0;
					$contenido = '';
				}
			}
		}
	}

	// $recuperaIdCita = mysqli_query($con,"SELECT * FROM seguimiento S INNER JOIN cita C ON S.cita_id=C.cita_id WHERE seguimiento_id='$idseguimiento'");
	// $recupera = mysqli_fetch_array($recuperaIdCita);
	// $idcita = $recupera['cita_id'];

	mysqli_close($con);
	header("Location:../nueva_receta.php");

?>