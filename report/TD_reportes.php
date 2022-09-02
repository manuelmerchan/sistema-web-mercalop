<?php


require '../FPDF/fpdf.php';

class PDF extends FPDF
{

  function Header()
  {
     // include('../config/conexion.php');
   //  $result= mysqli_query($con,"SELECT * from informacion");
   //  $row= mysqli_fetch_assoc($result);
   $this->image("buro.png",20,10,25);
   $this->SetFont('arial','B',10);
   $this->SetXY(140,6);
   $this->Cell(50,10,'Fecha: Guayaquil, '.date('d-m-Y').'',0,1,'C');
   $this->SetFont('arial','B',14);
   $this->SetXY(80,10);
   $this->Cell(50,15,'MERCALOP',0,1,'C');
   $this->SetFont('arial','B',10);
   $this->SetXY(80,22);
   $this->Cell(50,5,'Buro Juridico',0,1,'C');
   $this->SetXY(80,35);
   $this->Cell(50,5,'',0,1,'C');
  }
  function Footer(){
    $this->SetY(-15);
    $this->SetFont('arial','I',8);
    $this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
  }

}

 ?>
