<?php
include('conexion.php');
$salida='';
if(isset($_POST['consulta'])){
  	$id_cj=$_POST['consulta'];
	$consulta=mysqli_query($con,"SELECT *,PA.fecha fechaex,CJ.id_estado estcj from pago_abono PA inner join casos_juridicos CJ on PA.id_casos_juridicos=CJ.id_casos_juridicos where  PA.id_casos_juridicos='$id_cj'");
	$rows=mysqli_num_rows($consulta);
  $totalp=0;
	if ($rows>0) {
    $salida.='<table class="tabla3"><thead><tr><th>Fecha</th><th>Valor</th><th>Descargar</th></tr></thead>';
    while ($row=mysqli_fetch_array($consulta)) {
        $fechap=$row['fechaex'];
        $pago=$row['abono'];
        $totalp+=$row['abono'];
        $documento=$row['id_pago_abono'];
        $consul1=mysqli_query($con,"SELECT SUM(D.valor_deuda)totald from deudas D inner join casos_juridicos CJ on D.id_casos_juridicos=CJ.id_casos_juridicos where D.id_casos_juridicos='$id_cj'");
      	$row1=mysqli_fetch_array($consul1);
        $deudap=$row1['totald'];
            $salida.='<tr><td>'.date('d/m/Y', strtotime($fechap)).'</td> <td>'.$pago.'</td><td><a href="../report/nota_de_venta.php?id='.$documento.'" target="_blank" disabled><button type="button" class="boton_carrito" title="Imprimir"  name="button"> <i class="fas fa-print"></i></button></a></td>
          </tr>';
    }
    $salida.='  <tfoot><tr> <td>Deuda: $'.$deudap.'</td> <td>Total: $'.$totalp.'</td><td>Deuda pendiente: $'.number_format($deudap-$totalp, 2).'</td></tr></tfoot></table>';

	}else {
  		$salida="No hay Pagos realizados";
	}
}else{
	$salida="";
}
echo $salida;
mysqli_close($con);

 ?>
