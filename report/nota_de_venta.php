<?php
include('TD_factura.php');
include('../config/conexion.php');
    //
    // $inicio=$_POST['fecha1'];
    // $fin=$_POST['fecha2'];

    $id=$_REQUEST['id'];
    $consulta= mysqli_query($con,"SELECT * from pago_abono PA inner join casos_juridicos CJ on CJ.id_casos_juridicos=PA.id_casos_juridicos inner join clientes CL on CL.cedula=CJ.id_clientes inner join tipo_caso TC on TC.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso where id_pago_abono='$id' ");
    $row= mysqli_fetch_assoc($consulta);


$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$y=$pdf->GetY();
$pdf->SetX(20);
$pdf->Cell(170,10,utf8_decode('Nombre Cliente: '.$row['nombres'].' '.$row['apellidos'] ),1,1,'L');
$pdf->SetX(20);
$pdf->Cell(85,10,utf8_decode('Cedula: '.$row['cedula'] ),1,0,'L');
$pdf->Cell(85,10,utf8_decode('Cel.: '.$row['telefono'] ),1,1,'L');

$y=$pdf->GetY();
$pdf->SetY($y+2);
$pdf->SetX(20);
$pdf->SetFont('arial','B',10);
$pdf->Cell(17,10,utf8_decode('Cantidad'),1,0,'C');
$pdf->Cell(93,10,utf8_decode('Descripción'),1,0,'C');
$pdf->Cell(30,10,utf8_decode('Valor Unit.'),1,0,'C');
$pdf->Cell(30,10,utf8_decode('VALOR TOTAL'),1,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->SetX(20);
$pdf->SetFont('arial','B',10);
$pdf->Cell(17,10,utf8_decode(''),1,0,'C');
$pdf->MultiCell(93,5,utf8_decode($row['descrip_tcj']." - ".$row['descrip_dtc']),0,'C',0);
$pdf->SetXY(130,$y);
$pdf->Cell(30,10,utf8_decode($row['abono']),1,0,'C');
$pdf->Cell(30,10,utf8_decode($row['abono']),1,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->SetX(20);
$pdf->SetFont('arial','B',10);
$pdf->Cell(17,10,utf8_decode(''),1,0,'C');
$pdf->Cell(93,10,utf8_decode(''),1,0,'C');
$pdf->Cell(30,10,utf8_decode(''),1,0,'C');
$pdf->Cell(30,10,utf8_decode(''),1,1,'C');
$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->SetX(20);
$pdf->SetFont('arial','B',10);
$pdf->Cell(140,10,utf8_decode('VALOR TOTAL A PAGAR'),1,0,'C');
$pdf->Cell(30,10,utf8_decode($row['abono']),1,1,'C');



/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
