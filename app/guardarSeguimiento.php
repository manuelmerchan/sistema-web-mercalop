<?php
	session_start();
	include ("../config/conexion.php");
	
	// datos seguimiento
	$fecha=date('Y-m-d');
	$presion = $_POST["presion"];
	$temperatura = $_POST["temperatura"];
	$frecuenciar = $_POST["frecuenciar"];
	$frecuenciac = $_POST["frecuenciac"];
	$saturacion = $_POST["saturacion"];
	$peso = $_POST["peso"];
	$talla = $_POST["talla"];
	$imc = $_POST["imc"];
	$motivo = $_POST["motivo"];
	$diagnostico = $_POST["diagnostico"];
	$tratamiento = $_POST["tratamiento"];
	//id relacionado
	$idcita = $_REQUEST["idc"];

	// datos proxima cita
	$originalDate = $_POST["proxcita"];
	$proxcita = date("Y/m/d", strtotime($originalDate));

	// guardamos el seguimiento
	$guardar_seguimiento = mysqli_query($con,"INSERT INTO seguimiento (seguimiento_fechai, seguimiento_presion, seguimiento_temperatura, seguimiento_frespiratoria, seguimiento_fcardiaca, seguimiento_saturacion, seguimiento_peso, seguimiento_talla, seguimiento_imc, seguimiento_motivo, seguimiento_diagnostico, seguimiento_tratamiento, cita_id) VALUES ('$fecha', '$presion', '$temperatura', '$frecuenciar', '$frecuenciac', '$saturacion', '$peso', '$talla', '$imc', '$motivo', '$diagnostico', '$tratamiento', '$idcita')") or die ("error".mysqli_error());

	// obtener datos de la cita del seguimiento
	$consultaDatosCita = mysqli_query($con,"SELECT * FROM cita WHERE cita_id='$idcita'") or die ("error".mysqli_error());
	$datosc = mysqli_fetch_array($consultaDatosCita);
	$consultorio = $datosc["consultorio_id"];
	$doctor = $datosc["empleado_id"];
	$paciente = $datosc["paciente_id"];
	if (isset($_POST["mensaje"])) {
		$mensaje = $_POST["mensaje"];
	}else{
		$mensaje="";
	}
	$estado_cita=1;

	// asignamos turno y guardamos la nueva cita
	$consulta = mysqli_query($con,"SELECT * FROM cita WHERE cita_fecha='$proxcita' AND empleado_id='$doctor' ORDER BY cita_fecha DESC") or die ("error".mysqli_error());
	$nrow = mysqli_num_rows($consulta);

	if($nrow>0){
		$row=mysqli_fetch_array($consulta);		
		$turno=$row['cita_turno'];
		$turno2=$turno+1;		
	}else{
		$turno2 = 1;
	}

	$guardar_proxcita=mysqli_query($con,"INSERT INTO cita (cita_fechai, cita_fecha, cita_mensaje, cita_turno, consultorio_id, paciente_id, empleado_id, estado_cita_id) VALUES ('$fecha', '$proxcita', '$mensaje', '$turno2', '$consultorio', '$paciente', '$doctor', '$estado_cita')") or die ("error".mysqli_error());
	

	// actualizamos el estado de la cita actual ligada al seguimiento
	$actualizar_cita = mysqli_query($con,"UPDATE cita SET estado_cita_id='2' WHERE cita_id='$idcita'") or die ("error".mysqli_error());

	$_SESSION['confirmar']=1;

	mysqli_close($con);
	header("Location:../seguimiento.php?idc=$idcita");

?>