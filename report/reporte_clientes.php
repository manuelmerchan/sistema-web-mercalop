<?php
include('TD_reportes.php');
include('../config/conexion.php');
//
$inicio=$_POST['fecha_ini'];
$fin=$_POST['fecha_fin'];
$estado=$_POST['estado'];

if($estado=="todos"){
    $consulta=mysqli_query($con,"SELECT * FROM clientes C INNER JOIN estado ES ON ES.id_estado=C.id_estado WHERE  fecha BETWEEN '$inicio' and '$fin' ORDER BY id_clientes DESC");  //C.id_clientes!='1' and 
}elseif ($estado=="activos") {
    $consulta=mysqli_query($con,"SELECT * FROM clientes C INNER JOIN estado ES ON ES.id_estado=C.id_estado WHERE  fecha BETWEEN '$inicio' and '$fin' AND C.id_estado=1 ORDER BY id_clientes DESC");
}else{
    $consulta=mysqli_query($con,"SELECT * FROM clientes C INNER JOIN estado ES ON ES.id_estado=C.id_estado WHERE  fecha BETWEEN '$inicio' and '$fin' AND C.id_estado=2 ORDER BY id_clientes DESC");
}

//$consulta=mysqli_query($con,"SELECT * from tareas T INNER JOIN empleados E on T.id_empleado=E.id_empleado INNER JOIN actividades A on A.id_actividad=T.id_actividad INNER JOIN parcelas P on P.id_parcela=T.id_parcela where T.fecha BETWEEN '$desde' and '$hasta' ORDER BY T.fecha ASC");

$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->Cell(190,10,'REPORTE DE CLIENTES',0,1,'C');#(ancho,alto,texto,borde,salto linea,alineacion L C R)
$pdf->SetFont('arial','',10);
// $pdf->Cell(100,10,$fechas ,0,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y+5);
$pdf->SetFont('arial','B',8);
$pdf->SetFillColor(255, 189, 40);
 $pdf->SetTextColor(255, 255, 255);
 $pdf->Cell(17,10,utf8_decode('Fecha'),1,0,'C',true);
$pdf->Cell(60,10,utf8_decode('Nombres'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Cedula'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Telefono'),1,0,'C',true);
$pdf->Cell(50,10,utf8_decode('Correo'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Estado'),1,1,'C',true);

$pdf->SetFont('arial','B',8);
 $pdf->SetTextColor(0, 0, 0);
while($row5=mysqli_fetch_array($consulta)){

$pdf->Cell(17,10,utf8_decode($row5['fecha']),1,0,'C');
$pdf->Cell(60,10,utf8_decode($row5['nombres']." ".$row5['apellidos']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row5['cedula']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row5['telefono']),1,0,'C');
$pdf->Cell(50,10,utf8_decode($row5['correo']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row5['descrip']),1,1,'C');
}
/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();
 ?>
