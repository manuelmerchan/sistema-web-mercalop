<?php
include('../config/conexion.php');
	$id=$_REQUEST['id'];
  $consulta=mysqli_query($con,"SELECT * from facturas F inner join clientes C on C.cedula=F.id_clientes where id_facturas='$id' ");
  $row=mysqli_fetch_array($consulta);
  $nfactura=$row['num_fact'];

include("TD_factura_totalRespaldo.php");
$fecha=date('Y-m-d');
setlocale(LC_TIME, 'es_ES.UTF-8');
// En windows
setlocale(LC_TIME, 'spanish');
$pdf=new PDF('L','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$y=$pdf->GetY();
$pdf->SetY($y+5);

// ########### CABECERA 1 ##############
$pdf->SetFont('arial','',10);
$pdf->SetXY(7,$y);
$pdf->Cell(30,5,utf8_decode('Fecha de Emisión: '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(101,5,utf8_decode("Guayaquil, ".strftime("%A %d de %B del %Y", strtotime($row['fecha']))),'B',1,'C');

$pdf->SetX(7);
$pdf->Cell(42,2,utf8_decode(''),0,1,'C');

$pdf->SetFont('arial','',10);
$pdf->SetX(7);
$pdf->Cell(15,5,utf8_decode('Sr. (S).: '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(116,5,utf8_decode($row['nombres']." ".$row['apellidos']),'B',1,'C');

$pdf->SetX(7);
$pdf->Cell(42,2,utf8_decode(''),0,1,'C');

$pdf->SetFont('arial','',10);
$pdf->SetX(7);
$pdf->Cell(20,5,utf8_decode('Dirección: '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(111,5,utf8_decode($row['direccion']),'B',1,'C');

$pdf->SetX(7);
$pdf->Cell(42,2,utf8_decode(''),0,1,'C');

$pdf->SetFont('arial','',10);
$pdf->SetX(7);
$pdf->Cell(20,5,utf8_decode('R.U.C./C.I. : '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(51,5,utf8_decode($row['cedula']),'B',0,'C');

$pdf->SetFont('arial','',10);
$pdf->Cell(20,5,utf8_decode('Teléfono: '),0,0,'C');
$pdf->SetFont('arial','B',12);
$pdf->Cell(41,5,utf8_decode($row['telefono']),'B',1,'C');


// ########### CABECERA 2 ##############

$pdf->SetFont('arial','',10);
$pdf->SetXY(158,$y);
$pdf->Cell(30,5,utf8_decode('Fecha de Emisión: '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(101,5,utf8_decode("Guayaquil, ".strftime("%A %d de %B del %Y", strtotime($row['fecha']))),'B',1,'C');

$pdf->SetX(158);
$pdf->Cell(42,2,utf8_decode(''),0,1,'C');

$pdf->SetFont('arial','',10);
$pdf->SetX(158);
$pdf->Cell(15,5,utf8_decode('Sr. (S).: '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(116,5,utf8_decode($row['nombres']." ".$row['apellidos']),'B',1,'C');

$pdf->SetX(158);
$pdf->Cell(42,2,utf8_decode(''),0,1,'C');

$pdf->SetFont('arial','',10);
$pdf->SetX(158);
$pdf->Cell(20,5,utf8_decode('Dirección: '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(111,5,utf8_decode($row['direccion']),'B',1,'C');

$pdf->SetX(158);
$pdf->Cell(42,2,utf8_decode(''),0,1,'C');

$pdf->SetFont('arial','',10);
$pdf->SetX(158);
$pdf->Cell(20,5,utf8_decode('R.U.C./C.I. : '),0,0,'L');
$pdf->SetFont('arial','B',12);
$pdf->Cell(51,5,utf8_decode($row['cedula']),'B',0,'C');

$pdf->SetFont('arial','',10);
$pdf->Cell(20,5,utf8_decode('Teléfono: '),0,0,'C');
$pdf->SetFont('arial','B',12);
$pdf->Cell(41,5,utf8_decode($row['telefono']),'B',1,'C');

//############### DETALLE FACTURA 1 #############

$y=$pdf->GetY();
$yd=$pdf->GetY();
$pdf->SetXY(10,$y+5);
$pdf->SetFont('arial','B',8);
$pdf->Cell(15,10,utf8_decode("Cantidad"),1,0,'C');
$pdf->Cell(70,10,utf8_decode("Descripción"),1,0,'C');
$pdf->Cell(20,10,utf8_decode("Valor Unit."),1,0,'C');
$pdf->Cell(25,10,utf8_decode("VALOR TOTAL"),1,1,'C');

$cantidad = 0;

if ($row['servicios']=="0") {

$consulta2=mysqli_query($con,"SELECT * from detalle_factura DF inner join deudas D on D.id_deudas=DF.id_deudas where DF.id_facturas='$id' ");
$nrowdf=mysqli_num_rows($consulta2);
while ($row2=mysqli_fetch_array($consulta2)) {

  $cantidad++;

$pdf->SetX(10);
$pdf->SetFont('arial','B',8);
$pdf->Cell(15,10,utf8_decode("1"),1,0,'C');
 $dato= $row2['descripcion'];
$nstr_descrip=strlen($dato);
if ($nstr_descrip>49) {
  if ($nstr_descrip>98) {
    $pdf->SetFont('arial','B',5);
  }
  $y=$pdf->GetY();
  $pdf->MultiCell(70,5,utf8_decode($dato),1,'L',0);
  $pdf->SetXY(95,$y);
}else{
  $pdf->Cell(70,10,utf8_decode($dato),1,0,'L');
}
$pdf->Cell(20,10,utf8_decode($row2['valor_deuda']),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row2['valor_deuda']),1,1,'C');
}

for ($i=0; $i < 5 - $nrowdf ; $i++) {
  $pdf->SetX(10);
  $pdf->SetFont('arial','B',8);
  $pdf->Cell(15,10,utf8_decode(""),1,0,'C');
  $dato= " ";
  $nstr_descrip=strlen($dato);
  if ($nstr_descrip>49) {
    $y=$pdf->GetY();
    $pdf->MultiCell(70,5,utf8_decode($dato),1,'L',0);
    $pdf->SetXY(95,$y);
  }else{
    $pdf->Cell(70,10,utf8_decode($dato),1,0,'L');
  }
  $pdf->Cell(20,10,utf8_decode(""),1,0,'C');
  $pdf->Cell(25,10,utf8_decode(""),1,1,'C');
}
}else{
  $id_servicios=$row['servicios'];
  $consulta3=mysqli_query($con,"SELECT * from servicios where id_servicios='$id_servicios' ");
  $row3=mysqli_fetch_array($consulta3);

  $pdf->SetX(10);
  $pdf->SetFont('arial','B',8);
  $pdf->Cell(15,10,utf8_decode(""),1,0,'C');
   $dato= $row3['descrip_s'];
  $nstr_descrip=strlen($dato);
  if ($nstr_descrip>49) {
    $y=$pdf->GetY();
    $pdf->MultiCell(70,5,utf8_decode($dato),0,'L',0);
    $pdf->SetXY(95,$y);
  }else{
    $pdf->Cell(70,10,utf8_decode($dato),1,0,'L');
  }
  $pdf->Cell(20,10,utf8_decode($row3['valor']),1,0,'C');
  $pdf->Cell(25,10,utf8_decode($row3['valor']),1,1,'C');

  for ($i=0; $i < 4 ; $i++) {
    $pdf->SetX(10);
    $pdf->SetFont('arial','B',8);
    $pdf->Cell(15,10,utf8_decode(""),1,0,'C');
    $y=$pdf->GetY();
    $pdf->SetXY(95,$y);
    $pdf->Cell(20,10,utf8_decode(""),1,0,'C');
    $pdf->Cell(25,10,utf8_decode(""),1,1,'C');
  }
  $pdf->Line(10, $y+10 , 95, $y+10);
}



//############### DETALLE FACTURA 2 #############

$pdf->SetXY(161,$yd+5);
$pdf->SetFont('arial','B',8);
$pdf->Cell(15,10,utf8_decode("Cantidad"),1,0,'C');
$pdf->Cell(70,10,utf8_decode("Descripción"),1,0,'C');
$pdf->Cell(20,10,utf8_decode("Valor Unit."),1,0,'C');
$pdf->Cell(25,10,utf8_decode("VALOR TOTAL"),1,1,'C');

if ($row['servicios']=="0") {

$consulta2=mysqli_query($con,"SELECT * from detalle_factura DF inner join deudas D on D.id_deudas=DF.id_deudas where DF.id_facturas='$id' ");
$nrowdf=mysqli_num_rows($consulta2);
while ($row2=mysqli_fetch_array($consulta2)) {
$pdf->SetX(161);
$pdf->SetFont('arial','B',8);
$pdf->Cell(15,10,utf8_decode("1"),1,0,'C');
$dato= $row2['descripcion'];
$nstr_descrip=strlen($dato);
if ($nstr_descrip>49) {
  if ($nstr_descrip>98) {
    $pdf->SetFont('arial','B',5);
  }
  $yd=$pdf->GetY();
  $pdf->MultiCell(70,5,utf8_decode($dato),1,'L',0);
  $pdf->SetXY(95,$yd);
}else{
  $pdf->Cell(70,10,utf8_decode($dato),1,0,'L');
}
$pdf->SetX(246);
$pdf->Cell(20,10,utf8_decode($row2['valor_deuda']),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row2['valor_deuda']),1,1,'C');
}

for ($i=0; $i < 5 - $nrowdf ; $i++) {
$pdf->SetX(161);
$pdf->SetFont('arial','B',8);
$pdf->Cell(15,10,utf8_decode(""),1,0,'C');
$dato= "";
$nstr_descrip=strlen($dato);
if ($nstr_descrip>49) {
  $yd=$pdf->GetY();
  $pdf->MultiCell(70,5,utf8_decode($dato),1,'L',0);
  $pdf->SetXY(95,$yd);
}else{
  $pdf->Cell(70,10,utf8_decode($dato),1,0,'L');
}
$pdf->SetX(246);
$pdf->Cell(20,10,utf8_decode(""),1,0,'C');
$pdf->Cell(25,10,utf8_decode(""),1,1,'C');
}
}else{
  $id_servicios=$row['servicios'];
  $consulta3=mysqli_query($con,"SELECT * from servicios where id_servicios='$id_servicios' ");
  $row3=mysqli_fetch_array($consulta3);

$pdf->SetX(161);
$pdf->SetFont('arial','B',8);
$pdf->Cell(15,10,utf8_decode(""),1,0,'C');
$dato= $row3['descrip_s'];
$nstr_descrip=strlen($dato);
if ($nstr_descrip>49) {
  $yd=$pdf->GetY();
  $pdf->MultiCell(70,5,utf8_decode($dato),0,'L',0);
  $pdf->SetXY(95,$yd);
}else{
  $pdf->Cell(70,10,utf8_decode($dato),1,0,'L');
}
$pdf->SetX(246);
$pdf->Cell(20,10,utf8_decode($row3['valor']),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row3['valor']),1,1,'C');

for ($i=0; $i < 4 ; $i++) {
  $pdf->SetX(161);
  $pdf->SetFont('arial','B',8);
  $pdf->Cell(15,10,utf8_decode(""),1,0,'C');
  $yd=$pdf->GetY();
  $pdf->SetX(246);
  $pdf->Cell(20,10,utf8_decode(""),1,0,'C');
  $pdf->Cell(25,10,utf8_decode(""),1,1,'C');
}
$pdf->Line(176, $yd+10 , 246, $yd+10);
}



//############ FOOTER #############
$valorEnNumero=$row['total'];
$partes=explode(".", $valorEnNumero);
$formatterES = new NumberFormatter("es-ES", NumberFormatter::SPELLOUT);
$izquierda = $partes['0'];
$izquierda = $formatterES->format($izquierda);
$derecha = $partes['1'];
$derecha = $formatterES->format($derecha);
$valorEnLetras = $izquierda." con ".$derecha;
$y=$pdf->GetY();
$yd=$pdf->GetY();
$pdf->Cell(10,5,utf8_decode("Son:"),'L',0,'C');
$pdf->MultiCell(70,5,utf8_decode($valorEnLetras),0,'L',0);
// $pdf->Cell(70,5,utf8_decode($valorEnLetras),'B',1,'C');
// $pdf->Cell(70,5,utf8_decode(""),0,1,'C');
$pdf->SetX(15);
$pdf->Cell(60,4,utf8_decode(""),'B',0,'C');
$pdf->Cell(15,4,utf8_decode("DOLARES."),0,1,'C');

$pdf->Line(10, 151 , 10, 186);
$pdf->Line(10, 186 , 95, 186);

$pdf->SetFont('arial','',6);
$pdf->TextWithDirection(14,184,utf8_decode('FORMA DE PAGO'),'U');
$pdf->SetFont('arial','',6);
$pdf->TextWithDirection(9,186,utf8_decode('ORIGINAL: ADQUIRIENTE · COPIA:EMISOR'),'U');

$y3=$pdf->GetY();
$pdf->SetFont('arial','',5);
$pdf->SetXY(15,$y3+5);
$pdf->Cell(15,5,utf8_decode("EFECTIVO"),1,0,'C');
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');
$pdf->SetX(15);
$y2=$pdf->GetY();
$pdf->MultiCell(15,2.5,utf8_decode('DINERO ELECTRONICO'),1,'C',0);$pdf->SetXY(30,$y2);
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');
$pdf->SetX(15);
$y2=$pdf->GetY();
$pdf->MultiCell(15,2.5,utf8_decode('TARJETA DE Crédito / Debito'),1,'C',0);$pdf->SetXY(30,$y2);
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');
$pdf->SetX(15);
$pdf->Cell(15,5,utf8_decode("OTROS "),1,0,'C');
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');

$pdf->SetFont('arial','B',6);
$pdf->SetXY(60,178);
$pdf->Cell(30,5,utf8_decode("Recibí Conforme "),'T',1,'C');


$pdf->SetFont('arial','B',8);
$pdf->SetXY(95,$y);
$pdf->Cell(20,10,utf8_decode("Sub-Total"),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row['sub_total']),1,1,'C');
$pdf->SetX(95);
$pdf->Cell(20,10,utf8_decode("I.V.A. 0%"),1,0,'C');
$pdf->Cell(25,10,utf8_decode(""),1,1,'C');
$pdf->SetX(95);
$pdf->Cell(20,10,utf8_decode("I.V.A. 12%"),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row['iva']),1,1,'C');
$pdf->SetX(95);
$pdf->Cell(20,10,utf8_decode("TOTAL $ "),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row['total']),1,1,'C');


//############ FOOTER 2 #############

$pdf->SetXY(161,$yd);
$pdf->Cell(10,5,utf8_decode("Son:"),'L',0,'C');
$pdf->MultiCell(70,5,utf8_decode($valorEnLetras),0,'L',0);
// $pdf->Cell(70,5,utf8_decode(""),'B',1,'C');
// $pdf->Cell(70,5,utf8_decode(""),0,1,'C');
$pdf->SetX(166);
$pdf->Cell(60,4,utf8_decode(""),'B',0,'C');
$pdf->Cell(15,4,utf8_decode("DOLARES."),0,1,'C');

$pdf->Line(161, 151 , 161, 186);
$pdf->Line(161, 186 , 246, 186);

$pdf->SetFont('arial','',6);
$pdf->TextWithDirection(165,184,utf8_decode('FORMA DE PAGO'),'U');
$pdf->SetFont('arial','',6);
$pdf->TextWithDirection(160,186,utf8_decode('ORIGINAL: ADQUIRIENTE · COPIA:EMISOR'),'U');

$yd3=$pdf->GetY();
$pdf->SetFont('arial','',5);
$pdf->SetXY(166,$yd3+5);
$pdf->Cell(15,5,utf8_decode("EFECTIVO"),1,0,'C');
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');
$pdf->SetX(166);
$yd2=$pdf->GetY();
$pdf->MultiCell(15,2.5,utf8_decode('DINERO ELECTRONICO'),1,'C',0);$pdf->SetXY(30,$yd2);
$pdf->SetX(181);
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');
$pdf->SetX(166);
$yd2=$pdf->GetY();
$pdf->MultiCell(15,2.5,utf8_decode('TARJETA DE Crédito / Debito'),1,'C',0);$pdf->SetXY(30,$yd2);
$pdf->SetX(181);
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');
$pdf->SetX(166);
$pdf->Cell(15,5,utf8_decode("OTROS "),1,0,'C');
$pdf->Cell(25,5,utf8_decode(""),1,1,'C');

$pdf->SetFont('arial','B',6);
$pdf->SetXY(211,178);
$pdf->Cell(30,5,utf8_decode("Recibí Conforme "),'T',1,'C');


$pdf->SetFont('arial','B',8);
$pdf->SetXY(246,$yd);
$pdf->Cell(20,10,utf8_decode("Sub-Total"),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row['sub_total']),1,1,'C');
$pdf->SetX(246);
$pdf->Cell(20,10,utf8_decode("I.V.A. 0%"),1,0,'C');
$pdf->Cell(25,10,utf8_decode(""),1,1,'C');
$pdf->SetX(246);
$pdf->Cell(20,10,utf8_decode("I.V.A. 12%"),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row['iva']),1,1,'C');
$pdf->SetX(246);
$pdf->Cell(20,10,utf8_decode("TOTAL $ "),1,0,'C');
$pdf->Cell(25,10,utf8_decode($row['total']),1,1,'C');


$pdf->Output();
?>
