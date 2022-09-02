<?php


require '../FPDF/fpdf.php';

class PDF extends FPDF
{

  function Header()
  {
   include('../config/conexion.php');
   $idc=$_REQUEST['id'];
   $result= mysqli_query($con,"SELECT * from pago_abono where id_pago_abono='$idc' ");
   $rowc= mysqli_fetch_assoc($result);
   $this->image("buro.png",20,15,25);
   $this->SetFont('arial','B',10);
   // $this->SetXY(140,6);
   // // $this->Cell(50,10,'Fecha: Guayaquil, '.date('d-m-Y').'',0,1,'C');
   $this->SetFont('arial','BU',16);
   $this->SetXY(50,15);
   $this->Cell(80,7,utf8_decode('Buró Jurídico "MERCALOP"'),0,1,'C');
   $this->SetFont('arial','B',14);
   $this->SetX(50);
   $this->Cell(80,7,utf8_decode('Merchan Miñan Pedro Rafael'),0,1,'C');
   $this->SetXY(45,30);
   $this->SetFont('arial','B',9);
   $this->Cell(90,4,utf8_decode('Dir.: Barrio Centenario Mz. l · Sl. 21'),0,1,'C');
   $this->SetX(45);
   $this->Cell(90,4,utf8_decode('Cel.: 0993094874 * Guayaquil - Ecuador'),0,1,'C');
   $this->SetX(45);
   $this->Cell(90,4,utf8_decode('Email: ab.merchan@mercalop.com'),0,1,'C');

   $this->SetXY(140,15);
   $this->SetFillColor(0, 0, 0);
   $this->SetTextColor(255, 255, 255);
   $this->Cell(40,5,utf8_decode('COMPROBANTE'),1,1,'C',true);
   $this->SetXY(140,20);
   $this->SetFillColor(255, 255, 255);
   $this->SetTextColor(237, 39, 39);
   $this->Cell(40,10,utf8_decode('Nº '.$rowc['id_pago_abono']),1,1,'C',true);
   $this->SetTextColor(0, 0, 0);
   $this->SetXY(140,30);
   $this->Cell(13,5,utf8_decode('Día'),1,0,'C');
   $this->Cell(13,5,utf8_decode('Mes'),1,0,'C');
   $this->Cell(14,5,utf8_decode('Año'),1,1,'C');
   $this->SetXY(140,35);
   $this->Cell(13,7,date("d", strtotime($rowc['fecha'])) ,1,0,'C');
   $this->Cell(13,7,date("m", strtotime($rowc['fecha'])),1,0,'C');
   $this->Cell(14,7,date("Y", strtotime($rowc['fecha'])),1,1,'C');







   $this->SetXY(80,50);
   $this->Cell(50,5,utf8_decode(''),0,1,'C');
  }
  function Footer(){
    $this->SetY(-15);
    $this->SetFont('arial','I',8);
    $this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
  }

}

 ?>
