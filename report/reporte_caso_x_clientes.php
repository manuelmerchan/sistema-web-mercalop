<?php
include('TD_reportes.php');
include('../config/conexion.php');

$inicio=$_POST['fecha_ini'];
$fin=$_POST['fecha_fin'];
$clientes=$_POST['clientes'];

$consultaCliente=mysqli_query($con,"SELECT * FROM clientes WHERE cedula='$clientes'");
$rowCli=mysqli_fetch_array($consultaCliente);

$consulta=mysqli_query($con,"SELECT * FROM casos_juridicos CJ INNER JOIN estado ES ON ES.id_estado=CJ.id_estado INNER JOIN tipo_caso TC ON CJ.id_tipo_caso=TC.id_tipo_caso WHERE CJ.id_clientes='$clientes' and CJ.fecha BETWEEN '$inicio' and '$fin' ORDER BY id_casos_juridicos DESC");
$numCasos=mysqli_num_rows($consulta);

//$consulta=mysqli_query($con,"SELECT * from tareas T INNER JOIN empleados E on T.id_empleado=E.id_empleado INNER JOIN actividades A on A.id_actividad=T.id_actividad INNER JOIN parcelas P on P.id_parcela=T.id_parcela where T.fecha BETWEEN '$desde' and '$hasta' ORDER BY T.fecha ASC");

$pdf=new PDF('P','mm','A4');#(orizontal L o vertical P,medida cm mm, A3-A4)
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('arial','B',12);
$y=$pdf->GetY();
$pdf->SetY($y);
$pdf->Cell(190,10,'REPORTE DE CASOS POR CLIENTES',0,1,'C');#(ancho,alto,texto,borde,salto linea,alineacion L C R)
$pdf->SetFont('arial','',10);
// $pdf->Cell(100,10,$fechas ,0,1,'C');

$y=$pdf->GetY();
$pdf->SetY($y+5);
$pdf->SetFont('arial','B',8);
$pdf->Cell(140,6,utf8_decode('Nombres: '.$rowCli['nombres'].' '.$rowCli['apellidos']),0,0,'L');
$pdf->Cell(70,6,utf8_decode('Cédula: '.$rowCli['cedula']),0,1,'L');

$pdf->Cell(140,6,utf8_decode('Dirección: '.$rowCli['direccion']),0,0,'L');
$pdf->Cell(70,6,utf8_decode('Teléfono: '.$rowCli['telefono']),0,1,'L');

$pdf->Cell(140,6,utf8_decode('Correo: '.$rowCli['correo']),0,0,'L');
//$pdf->Cell(45,6,utf8_decode(),0,0,'C');
$pdf->Cell(40,6,utf8_decode('Casos Juridicos: '.$numCasos),0,0,'L');
//$pdf->Cell(10,6,utf8_decode($numCasos),1,1,'C');

$y=$pdf->GetY();
// $pdf->SetY($y+10);
$pdf->SetXY(3,$y+10);
$pdf->SetFillColor(255, 189, 40);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(15,10,utf8_decode('Fecha'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Código Caso'),1,0,'C',true);
$pdf->Cell(30,10,utf8_decode('Tipo de Caso'),1,0,'C',true);
$pdf->Cell(50,10,utf8_decode('Abogado'),1,0,'C',true);
$pdf->Cell(50,10,utf8_decode('Oponente'),1,0,'C',true);
$pdf->Cell(20,10,utf8_decode('Estado'),1,0,'C',true);
$pdf->Cell(19,10,utf8_decode('Proceso'),1,1,'C',true);

$pdf->SetFont('arial','B',6.5);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(3,$y+20);
while($row5=mysqli_fetch_array($consulta)){
    $idcaso=$row5['id_casos_juridicos'];

    //BUSCA ABOGADO DEL CASO
    $idAbogado=$row5['id_abg_ayudante'];
    $consAbogado=mysqli_query($con,"SELECT * FROM empleados WHERE cedula='$idAbogado'");
    $rowAbogado=mysqli_fetch_array($consAbogado);
    $nombreAbogado=$rowAbogado['nombres']." ".$rowAbogado['apellidos'];

    //BUSCA OPONENTE     
    $consOponente=mysqli_query($con,"SELECT * FROM oponente WHERE id_casos_juridicos='$idcaso'");
    $numconsOponente=mysqli_num_rows($consOponente);
    if ($numconsOponente!=0 OR $numconsOponente!="") {
        $rowOponente=mysqli_fetch_array($consOponente);
        $oponente=$rowOponente['nombres_persona'];
    }else{
        $oponente="SIN DATOS";
    }

    //BUSCA PROCESO
    $idProceso=$row5['proceso'];
    $consEstadoProceso = mysqli_query($con,"SELECT * FROM estado WHERE id_estado='$idProceso'");
    $rowEstadoProceso=mysqli_fetch_array($consEstadoProceso);
    $estadoProceso=$rowEstadoProceso['descrip'];
    
$y=$pdf->GetY();
$pdf->SetXY(3,$y);
$pdf->Cell(15,10,utf8_decode($row5['fecha']),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row5['codigo']),1,0,'C');
$pdf->Cell(30,10,utf8_decode($row5['descrip_tcj']),1,0,'C');
$pdf->Cell(50,10,utf8_decode($nombreAbogado),1,0,'C');
$pdf->Cell(50,10,utf8_decode($oponente),1,0,'C');
$pdf->Cell(20,10,utf8_decode($row5['descrip']),1,0,'C');
$pdf->Cell(19,10,utf8_decode($estadoProceso),1,1,'C');
}
/*
$pdf->SetFont('arial','B',15);
$pdf->SetXY(10,70);
$pdf->MultiCell(60,5,'hola mundo como estan todo aqui',1,'C',0);
$pdf->MultiCell(100,5,'hola mundo como estan todo aqui',1,'C',0);
*/
$pdf->Output();

?>
