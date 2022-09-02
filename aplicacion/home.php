<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="swiper-bundle.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Acme&family=Carter+One&family=Yanone+Kaffeesatz&family=Yusei+Magic&display=swap" rel="stylesheet">
  	<script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.min.js" charset="utf-8"></script>
    <title>Home</title>
  </head>
  <style media="screen">
    body{
      background:#f4f4f4;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    }

      .swiper-container {
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
      }

      .swiper-slide {
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        height: 95vh;
        display: flex;
        align-items: center;
        justify-content: center;

      }
      .conte_info{
        padding: 0px;
        background: rgba(40, 39, 39, 0.51);
        width: 70%;
        height: 70%;
        border-radius: 4px;
        border: 1px solid #a4a4a4;
        -webkit-box-shadow: 0px 0px 9px 2px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 9px 2px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 9px 2px rgba(0,0,0,0.75);
      }
      .conte_info .titulo{
        color: #fff;
        width: 100%;
        height: 50px;
        font-size: 26px;
        font-family: 'Acme', sans-serif;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 40%;
      }
      .conte_info hr{
        margin-top: -10px;
        margin-bottom: 20px;
        height: 1px;
        background: rgb(164, 164, 164);
        width: 70%;
      }

      .conte_info .precio{
        color: #c8c6c6;
        width: 100%;
        height: 50px;
        font-size: 50px;
        font-family: 'Yusei Magic', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .conte_info .detalle{
        padding: 10px;
        margin-top: 20px;
        color: #fff;
        width: calc(100%-20px);
        height: calc(100%-115px);
        font-size: 20px;
        font-family: 'Yanone Kaffeesatz', sans-serif;
        overflow-y: scroll;
        display: flex;
        justify-content: center;
      }

  </style>
  <body>

    <?php
    include('conexion.php');
    //$id=$_REQUEST['id'];
    $id='4';
    $consulta=mysqli_query($con,"SELECT * , E.fecha fechaex  from casos_juridicos CJ inner join tipo_caso TC on TC.id_tipo_caso=CJ.id_tipo_caso inner join expedientes E on E.id_casos_juridicos=CJ.id_casos_juridicos where CJ.id_clientes='$id' ");
    $nrows=mysqli_num_rows($consulta);
    if($nrows>0){
    while($row=mysqli_fetch_array($consulta)){

        $spago = $row['solicitud_pago'];
        $codigo = $row['codigo'];
        $tipocj = $row['descrip_tcj'];
        $fechae = $row['fechaex'];
        if ($spago=='1' && $fechae<date('Y-m-d')) { ?>
<script type="text/javascript">
var codig='<?php echo $codigo; ?>';
var tip_cj='<?php echo $tipocj; ?>';
Swal.fire(
  'Realizar un nuevo Pago!!',
  'Caso #'+codig+' '+tip_cj,
  'info'
)
</script>

          <?php

          }
        }
    }
     ?>


     <!-- Swiper -->
     <div class="swiper-container">
       <div class="swiper-wrapper">

         <div class="swiper-slide" style="background-image:url(img/slider1.jpg)">
           <div class="conte_info">
             <div class="titulo"><?php echo 'MERCALOP';//$row1['titulo']; ?></div>
             <hr>
             <div class="precio"><?php echo 'CONTRATOS';//$row1['precio']; ?></div>
             <div class="detalle"><?php echo 'Elavoración e incumplimiento de contratos empresariales y personales';//$row1['descripcion']; ?></div>
           </div>
         </div>

   <div class="swiper-slide" style="background-image:url(img/slider2.jpg)">
     <div class="conte_info">
       <div class="titulo"><?php echo 'MERCALOP';//$row1['titulo']; ?></div>
       <hr>
       <div class="precio"><?php echo 'JUICIOS';//$row1['precio']; ?></div>
       <div class="detalle"><?php echo 'Penal, Oral, Civil, Contencioso Administrativo, Laboral';//$row1['descripcion']; ?></div>
     </div>
   </div>


       </div>
       <!-- Add Pagination -->



       <div class="swiper-pagination"></div>
     </div>






     <!-- Swiper JS -->
     <script src="swiper-bundle.min.js"></script>

     <!-- Initialize Swiper -->
     <script>
       var swiper = new Swiper('.swiper-container', {
         effect: 'coverflow',
         grabCursor: true,
         centeredSlides: true,
         slidesPerView: 'auto',
         coverflowEffect: {
           rotate: 50,
           stretch: 0,
           depth: 100,
           modifier: 1,
           slideShadows: true,
         },
         pagination: {
           el: '.swiper-pagination',
         },
       });
     </script>
  </body>
</html>
