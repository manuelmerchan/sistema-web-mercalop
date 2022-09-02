<?php
	session_start();
	include ("../config/conexion.php");
	$fecha=date('Y-m-d');

    $id=$_REQUEST['id']; //id del caso juridico
	$abogado = $_POST["abogado"];

	if($abogado==0){
		$consAntiguo = mysqli_query($con,"SELECT * FROM casos_juridicos WHERE id_casos_juridicos='$id'");
		$rowAntiguo = mysqli_fetch_array($consAntiguo);
		$idAntiguo = $rowAntiguo['id_empleados'];
		$actualizarAbogado = mysqli_query($con,"UPDATE casos_juridicos SET id_abg_ayudante='$idAntiguo' WHERE id_casos_juridicos='$id'");
		$eliminarAbogado=mysqli_query($con,"DELETE FROM asig_caso_abogado WHERE id_casos_juridicos='$id'");
	}else{

		$consulta=mysqli_query($con,"SELECT * FROM asig_caso_abogado WHERE id_casos_juridicos='$id'") or die ("error1".mysqli_error());
		$num=mysqli_num_rows($consulta);
		if($num>0){
			$row=mysqli_fetch_array($consulta);
			$idaca=$row['id_asig_caso_abogado'];
			$ingreso=mysqli_query($con,"UPDATE asig_caso_abogado SET id_empleados='$abogado' where id_asig_caso_abogado='$idaca' ") or die ("error2".mysqli_error());

			$actualizarCaso = mysqli_query($con,"UPDATE casos_juridicos SET id_abg_ayudante='$abogado' WHERE id_casos_juridicos='$id'");
			$_SESSION['confirmar']=2;
		}else{
			$consulta2=mysqli_query($con,"INSERT INTO asig_caso_abogado (fecha, id_empleados,id_casos_juridicos) VALUES ('$fecha','$abogado','$id')") or die ("error3".mysqli_error());

			$actualizarCaso = mysqli_query($con,"UPDATE casos_juridicos SET id_abg_ayudante='$abogado' WHERE id_casos_juridicos='$id'");
			$_SESSION['confirmar']=1;
		}

	}
	
	mysqli_close($con);
	header("Location:../buscar_caso_juridico.php");
?>
