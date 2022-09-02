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
      body{
        background: #ebe9e9;
          background-image: url(images/fond_todo.jpg);
          background-size: cover;
          background-position: 0px 0px;
          background-repeat: no-repeat;
      }
    </style>
    <title></title>
  </head>
  <body>
<?php
include('conexion.php');
 $id=$_REQUEST['id'];
 //$id='4';
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
            $consulta1=mysqli_query($con,"SELECT * ,F.fecha fechaf ,F.hora horaf from facturas F inner join clientes CL on CL.cedula=F.id_clientes where F.id_estado='1' and CL.id_clientes='$id' ");
            while($row1=mysqli_fetch_array($consulta1)){
                $fecha = $row1['fechaf']." ".$row1['horaf'];
                $codigo = $row1['num_fact'];
                if ($row1['casos_juridicos']!='0') {
                  $id_cj=$row1['casos_juridicos'];
                  $consul1=mysqli_query($con,"SELECT * from  casos_juridicos CJ inner join tipo_caso TCJ on TCJ.id_tipo_caso=CJ.id_tipo_caso where CJ.id_casos_juridicos='$id_cj'");
                	$row2=mysqli_fetch_array($consul1);
                  $razonf ="Caso Juridico: ". $row2['descrip_tcj'];
                }else{
                  $razonf =" Servicios inmediatos ";
                }

        ?>
  			<div class="item"
  				 data-categoria="Todos"
  				 data-etiquetas="<?php echo $codigo." ".$fecha." ".$razonf; ?>"
  				 data-descripcion="<?php echo $razonf; ?>"
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
                      <label class=""><?php echo "<b>Fact.: ".$codigo."</b>"; ?></label>
                      <label class=""><?php echo "<b>".date("d/m/Y H:i:s", strtotime($fecha))."</b>"; ?></label>

                    </div>
                    <label class="descrip"><?php echo utf8_decode($razonf);  ?></label>

                <a href="../report/factura.php?id=<?php echo $row1['id_facturas']; ?>" target="_blank"><button type="button" class="boton_carrito" title="Ver Expedientes"   name="button">
                 <i class="fas fa-file-invoice-dollar fa-2x"></i> <!--<i class="fas fa-list fa-2x"></i> --> </button></a>

					</div>
				</div>
            </div>
            <?php  } ?>

  		</section>

</div>

<script src="https://unpkg.com/web-animations-js@2.3.2/web-animations.min.js"></script>
<script src="https://unpkg.com/muuri@0.8.0/dist/muuri.min.js"></script>
  <script src="main_list.js"></script>


  </body>
</html>
