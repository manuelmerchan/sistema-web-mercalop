<?php
require '../FPDF/fpdf.php';
class PDF extends FPDF
{

  function Header()
  {
    include('config/config.php');
   //  $result= mysqli_query($con,"SELECT * from informacion");
   //  $row= mysqli_fetch_assoc($result);
   //$this->image("../images/labo.png",20,10,40);
   $this->SetFont('arial','B',10);
   $this->SetXY(235,6);
   $this->Cell(50,10,'Fecha: Guayaquil, '.date('d-m-y').'',0,1,'C');
   $this->SetFont('arial','B',14);
   $this->SetXY(125,10);
   $this->Cell(50,10,'LABORATORIO LOLY',0,1,'C');
  }
  function Footer(){
    $this->SetY(-15);
    $this->SetFont('arial','I',8);
    $this->Cell(0,10,'pagina'.$this->PageNo().'/{nb}',0,0,'C');
  }

}

 ?>
