<?php

require '../FPDF/fpdf.php';


class PDF extends FPDF
{




  function TextWithDirection($x, $y, $txt, $direction='R')
  {
      if ($direction=='R')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      elseif ($direction=='L')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      elseif ($direction=='U')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      elseif ($direction=='D')
          $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      else
          $s=sprintf('BT %.2F %.2F Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      if ($this->ColorFlag)
          $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
  }

  function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
  {
      $font_angle+=90+$txt_angle;
      $txt_angle*=M_PI/180;
      $font_angle*=M_PI/180;

      $txt_dx=cos($txt_angle);
      $txt_dy=sin($txt_angle);
      $font_dx=cos($font_angle);
      $font_dy=sin($font_angle);

      $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
      if ($this->ColorFlag)
          $s='q '.$this->TextColor.' '.$s.' Q';
      $this->_out($s);
  }


  function Header()
  {
    include('../config/conexion.php');
    $id=$_REQUEST['id'];
    $consulta=mysqli_query($con,"SELECT * from facturas where id_facturas='$id' ");
    $row=mysqli_fetch_array($consulta);

   // $this->SetXY(140,6);
   // // $this->Cell(50,10,'Fecha: Guayaquil, '.date('d-m-Y').'',0,1,'C');

   // ########### CABECERA 1 ##############
   $this->SetFont('arial','BU',16);
   $this->SetXY(10,15);
//    $this->Cell(80,7,utf8_decode('Merchan Miñan Pedro Rafael'),0,1,'C');
   $this->Cell(80,7,utf8_decode(''),0,1,'C');
   $this->SetFont('arial','B',14);
   $this->SetX(10);
//    $this->Cell(80,7,utf8_decode('BURÓ JURÍDICO MERCALOP & MLP'),0,1,'C');
$this->Cell(80,7,utf8_decode(''),0,1,'C');
   $this->SetX(5);
   $this->SetFont('arial','B',5);
//    $this->MultiCell(90,2,utf8_decode('Prestación de Servicios Profecionales. Educación De Tercer Nivel, Destinado a la Formación Básica en una Disciplina o a la Capacitación para el Ejercicio de una Profesión. Corresponden a este Nivel de Grado de Licenciado y los Títulos Profesionales Universitarios o Politécnicas, que son Equivalentes'),0,'C',0);
   $this->MultiCell(90,2,utf8_decode(''),0,'C',0);
   $this->SetXY(5,37);
   $this->SetFont('arial','',9);
//    $this->Cell(90,4,utf8_decode('Dir.: Barrio Centenario Mz. l · Sl. 21'),0,1,'C');
$this->Cell(90,4,utf8_decode(''),0,1,'C');
   $this->SetX(5);
//    $this->Cell(90,4,utf8_decode('Cel.: 0993094874 * Guayaquil - Ecuador'),0,1,'C');
$this->Cell(90,4,utf8_decode(''),0,1,'C');
   $this->SetX(5);
//    $this->Cell(90,4,utf8_decode('Email: ab.merchan@mercalop.com'),0,1,'C');
   $this->Cell(90,4,utf8_decode(''),0,1,'C');

   $this->SetXY(96,16);
//    $this->Cell(42,5,utf8_decode('R.U.C. 0910281351001'),1,1,'C');
   $this->Cell(42,5,utf8_decode(''),0,1,'C');
   $this->SetXY(96,21);
   $this->Cell(42,1,utf8_decode(''),0,1,'C');
   $this->SetXY(96,22);
   $this->SetFont('arial','B',12);
//    $this->Cell(24,6,utf8_decode('FACTURA '),'TLB',0,'C');
   $this->Cell(24,6,utf8_decode(''),0,0,'C');
   $this->SetFont('arial','',7);
//    $this->Cell(18,6,utf8_decode('serie 001-001-'),'TBR',1,'C');
$this->Cell(18,6,utf8_decode(''),0,1,'C');
   $this->SetXY(96,28);
   $this->Cell(42,1,utf8_decode(''),0,1,'C');
   $this->SetXY(96,29);
   $this->SetFont('arial','',18);
   $this->Cell(42,10,utf8_decode(''),0,1,'C');
   $this->SetXY(96,39);
   $this->Cell(42,1,utf8_decode(''),0,1,'C');
   $this->SetXY(96,40);
   $this->SetFont('arial','',10);
//    $this->Cell(42,5,utf8_decode('AUT. SRI. 1124016081'),1,1,'C');
   $this->Cell(42,5,utf8_decode(''),0,1,'C');
   $this->SetXY(96,45);
   $this->SetFont('arial','B',6);
//    $this->Cell(42,3,utf8_decode('Documento Categorizado: NO'),0,1,'C');
   $this->Cell(42,3,utf8_decode(''),0,1,'C');
   $this->SetXY(80,50);
   $this->Cell(50,5,utf8_decode(''),0,1,'C');


// ########### CABECERA 2 ##############
   $this->SetFont('arial','BU',16);
   $this->SetXY(158,15);
   $this->Cell(80,7,utf8_decode(''),0,1,'C');
   $this->SetFont('arial','B',14);
   $this->SetX(158);
   $this->Cell(80,7,utf8_decode(''),0,1,'C');
   $this->SetX(153);
   $this->SetFont('arial','B',5);
   $this->MultiCell(90,2,utf8_decode(''),0,'C',0);
   $this->SetXY(153,37);
   $this->SetFont('arial','',9);
   $this->Cell(90,4,utf8_decode(''),0,1,'C');
   $this->SetX(153);
   $this->Cell(90,4,utf8_decode(''),0,1,'C');
   $this->SetX(153);
   $this->Cell(90,4,utf8_decode(''),0,1,'C');

   $this->SetXY(245,16);
   $this->Cell(42,5,utf8_decode(''),0,1,'C');
   $this->SetXY(245,21);
   $this->Cell(42,1,utf8_decode(''),0,1,'C');
   $this->SetXY(245,22);
   $this->SetFont('arial','B',12);
   $this->Cell(24,6,utf8_decode(''),0,0,'C');
   $this->SetFont('arial','',7);
   $this->Cell(18,6,utf8_decode(''),0,1,'C');
   $this->SetXY(245,28);
   $this->Cell(42,1,utf8_decode(''),0,1,'C');
   $this->SetXY(245,29);
   $this->SetFont('arial','',18);
   $this->Cell(42,10,utf8_decode(''),0,1,'C');
   $this->SetXY(245,39);
   $this->Cell(42,1,utf8_decode(''),0,1,'C');
   $this->SetXY(245,40);
   $this->SetFont('arial','',10);
   $this->Cell(42,5,utf8_decode(''),0,1,'C');
   $this->SetXY(245,45);
   $this->SetFont('arial','B',6);
   $this->Cell(42,3,utf8_decode(''),0,1,'C');
   $this->SetXY(80,50);
   $this->Cell(50,5,utf8_decode(''),0,1,'C');
  }
  function Footer(){
    // $this->SetY(-15);
    // $this->image("icono_footer_factura.png",13,187,15,6);
    $this->SetXY(30,-23);
    $this->SetFont('arial','',6.5);
    $this->Cell(105,3,utf8_decode(''),0,1,'L');
    $this->SetX(30);
    $this->Cell(105,3,utf8_decode(''),0,1,'L');


    // $this->image("icono_footer_factura.png",164,187,15,6);
    $this->SetXY(181,-23);
    $this->SetFont('arial','',6.5);
    $this->Cell(105,3,utf8_decode(''),0,1,'L');
    $this->SetX(181);
    $this->Cell(105,3,utf8_decode(''),0,1,'L');

    // $this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
  }

}

 ?>
