<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilos_app.css">
    <script src="jquery.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
  	<script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.min.js" charset="utf-8"></script>
    <style media="screen" type="text/css">
      /* body{
        background: #ebe9e9;
          background-image: url(images/fond_todo.jpg);
          background-size: cover;
          background-position: 0px 0px;
          background-repeat: no-repeat;
      } */
    </style>
    <title></title>
  </head>
  <body>
<?php
include('conexion.php');
// $id=$_REQUEST['id'];
 $id='4';
 ?>
    <form action="" class="cont_barr_busque">
  		<input type="text" class="barra-busqueda" id="barra-busqueda" placeholder="&#128269; Buscar">
  	</form>
  	<div class="contenedor">

  		<header>
  			<!-- <div class="logo">
  				<h1>Carlos Arturo</h1>
  				<p>Desarrollador Web</p>
  			</div> -->

  			<div class="categorias" id="categorias">
  				<a href="#" class="activo">Todos</a>
  			</div>
  		</header>

  		<section class="grid" id="grid">

        <?php
            // $fecha_actual = date("d-m-Y");
            // $fecha_dat=date("d-m-Y",strtotime($fecha_actual."- 3 month"));
            $consulta1=mysqli_query($con,"SELECT * , CJ.fecha fechacj from casos_juridicos CJ inner join estado E on E.id_estado=CJ.id_estado inner join tipo_caso TCJ on TCJ.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso inner join clientes CL on CL.id_clientes=CJ.id_clientes where CJ.id_clientes='$id' and CJ.id_estado!='2' ");
            while($row1=mysqli_fetch_array($consulta1)){
                $fechacj = $row1['fechacj'];
                $codigo = $row1['codigo'];
                $caso_juridico = $row1['descrip_tcj'];
                $detalle_caso_juridico = $row1['descrip_dtc'];

        ?>
  			<div class="item"
  				 data-categoria="Todos"
  				 data-etiquetas="<?php echo $codigo." ".$fechacj." ".$caso_juridico." ".$detalle_caso_juridico; ?>"
  				 data-descripcion="<?php echo $caso_juridico." ".$detalle_caso_juridico; ?>"
  			>
                <div class="item-contenido">
                    <div class="conten_info">
            <!-- <?php
                // $datp="";
                // if ($row1['privacidad']=='2') {
                //   $datp='<br><b style="color:#D67610;">Confidencial, acerquese al laboratorio.</b>';
                //     }
            ?> -->

                    <div class="fecha">
                      <label class=""><?php echo "<b>Caso Nº: ".$codigo."</b>"; ?></label>
                      <label class=""><?php echo "<b>".date("d/m/Y", strtotime($fechacj))."</b>"; ?></label>

                    </div>
                    <label class="descrip"><?php echo utf8_decode($caso_juridico.": ".$detalle_caso_juridico);  ?></label>

                <button type="button" class="boton_carrito" title="Ver Expedientes" data-ids="<?php echo $row1['id_casos_juridicos']; ?>"  name="button">
                 <i class="fas fa-hand-holding-usd fa-2x"></i> <!--<i class="fas fa-list fa-2x"></i> --></button>

					</div>
				</div>
            </div>
            <?php  } ?>

  		</section>

</div>

<style media="screen">

  .tabla3{
    background: rgba(245, 241, 241, 0.68);
    width: 100%;
    align-items: center;
    border: 1px solid #4a4a4a;
   border-collapse: collapse;
   margin-top: 20px;

  }
    .tabla3 thead{
      height: 50px;
      background: rgba(230, 230, 230, 0.68);
    }
  .tabla3 th{
    padding: 0 5px;
    text-align: center;
    border: 1px solid #4a4a4a;
   border-collapse: collapse;
  }
  .tabla3 td{
    height: 40px;
    text-align: center;
    padding: 0 5px;
    color: #000;
    border: 1px solid #4a4a4a;
   border-collapse: collapse;
  }
  tr:hover td{
    background: rgba(221, 221, 221, 0.68);
    color: #000;
  }
  .tabla3 tfoot{
    height: 50px;
    background: rgba(230, 230, 230, 0.68);
  }
</style>

<div id="miModal" class="modal">
  <div class="flex" id="flex">
    <div class="contenido-modal">
      <div class="modal-header">
        <span class="close" id="close"><i class="fas fa-arrow-left"></i></span>
        <h2 class="titulom">Pagos Realizados</h2>
      </div>
      <div class="modal-body" id="cont_body">


      </div>
      <div class="footer">
        <h3></h3>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
<script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
  <script src="main_list.js"></script>
<script type="text/javascript">
function buscar_expe(consulta){

  $.ajax({
    url: 'ajax_lista_pagos.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta!=''){
      $('#cont_body').html(respuesta);
      document.getElementById('miModal').style.display = 'block';
    }
  })
  .fail(function(){
    console.log("error")
  })
}
</script>


  <script>

// abrir.addEventListener('click', function(){
//   modal.style.display = 'block';
// });

$('.boton_carrito').click(function(e){
  var id=this.dataset.ids;
  if (id!="") {
    buscar_expe(id);

  }


});

  var modal = document.getElementById('miModal');
  var flex = document.getElementById('flex');
  // let abrir = document.getElementById('abrir');
  var cerrar = document.getElementById('close');


cerrar.addEventListener('click', function(){
  modal.style.display = 'none';
});

window.addEventListener('click', function(e){
  console.log(e.target);
  if(e.target == flex){
      modal.style.display = 'none';
  }
});
  </script>

  </body>
</html>
