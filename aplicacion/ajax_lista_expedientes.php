<?php
include('conexion.php');
$salida='';
if(isset($_POST['consulta'])){
  	$id_cj=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT *,EX.fecha fechaex,CJ.id_estado estcj from expedientes EX inner join casos_juridicos CJ on EX.id_casos_juridicos=CJ.id_casos_juridicos where  EX.id_casos_juridicos='$id_cj'");
	$rows=mysqli_num_rows($consulta);
	if ($rows>0) {
    while ($row=mysqli_fetch_array($consulta)) {
        $fechaex=$row['fechaex'];
        $nombre=$row['nombre_anexo'];
        $documento=$row['documento'];

      	$salida.='<div class="conten_lis_modal"><div class="item-contenido_modal"><div class="conten_info_modal">';
        $salida.='<div class="fecha_modal"><label class=""><b>'.date('d/m/Y', strtotime($fechaex)).'</b></label></div>';
        $salida.='<label class="descrip_modal">'.utf8_decode($nombre).'</label>';
        if ($row['estcj']=='3') {
          $salida.='<a href="../'.$documento.'" target="_blank" disabled><button type="button" class="boton_carrito" title="Imprimir"  name="button"> <i class="fas fa-print"></i></button></a>';
        }else{
          $salida.='<button type="button" class="boton_carrito no_impri" style="background:#86806a;" title="Imprimir"  name="button"> <i class="fas fa-print"></i></button>';
        }

        $salida.='</div></div></div>';
    }
    $salida.='<script type="text/javascript"> $(".no_impri").click(function(){ Swal.fire( "Descarga no Disponible!", "","error"  ) });</script>';

	}else {
  		$salida="No hay Expedientes";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
