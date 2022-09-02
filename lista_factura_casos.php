<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">
    <div class="ccf_cabecera_pantalla">
        <div class="ccfcp_contenedor_titulo">
            <div class="ccfcp_ct_icono">
              <i class="fas fa-cash-register" style="color: #000"></i>
            </div>
            <div class="ccfcp_ct_titulo">
              <h2 style="color: #000">FACTURAR CASOS JURÍDICOS</h2>
            </div>
            <div class="ccfcp_ct_titulo2">
              <p style="color: #000"></p>
            </div>
            <!-- <div class="ccfcp_ct_boton">
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#contenido_mostrar" aria-expanded="false" aria-controls="collapseExample">Agregar Empleado <i class="fas fa-angle-down"></i></button>
            </div> -->
        </div>

        <div class="camino">
            <div class="camino_cuerpo">

              <div class="camino_cuerpo_opcion">
                <a href="inicio.php"><i class="fas fa-home"></i>Inicio</a>
              </div>
              <!-- <i class="fas fa-angle-right"></i>
              <div class="camino_cuerpo_opcion active_camino">
                <a href="ingreso_empleado.php">Ingresar Empleado</a>
              </div> -->
            </div>
        </div>
    </div>


            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Clientes</th>
                    <th>Cédula</th>
                    <th>Código del Caso</th>
                    <th>Tipo de Caso</th>
                    <th>Detalle Tipo de Caso</th>
                    <th>FACTURAR </th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT *,CJ.fecha fechacj,CJ.id_estado estadocj from casos_juridicos CJ inner join estado E on E.id_estado=CJ.id_estado inner join tipo_caso TCJ on TCJ.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso inner join cotizacion C on C.id_cotizacion=CJ.id_cotizacion inner join clientes CL on CL.cedula=C.id_clientes where CL.id_estado='1' and CJ.id_estado!='3'  and CJ.id_estado!='2' ");
                    while($row=mysqli_fetch_array($consulta)){
                      $id_cj=$row['id_casos_juridicos'];
                      $consulta1=mysqli_query($con,"SELECT sum(abono) tabono FROM pago_abono WHERE id_casos_juridicos='$id_cj' ");
                      $row1=mysqli_fetch_array($consulta1);
                      $pagos=$row1['tabono'];
                      $consul1=mysqli_query($con,"SELECT sum(valor_deuda) tdeuda FROM deudas WHERE id_casos_juridicos='$id_cj' ");
                      $rowl=mysqli_fetch_array($consul1);
                      $deudas=$rowl['tdeuda'];
                      $deuda_p=$deudas-$pagos;

                      $consul4=mysqli_query($con,"SELECT * FROM oponente WHERE id_casos_juridicos='$id_cj' ");
                      $nrow4=mysqli_num_rows($consul4);

                      $consul5=mysqli_query($con,"SELECT * FROM expedientes WHERE id_casos_juridicos='$id_cj' ");
                      $nrow5=mysqli_num_rows($consul5);

                      if ($deuda_p==0 && $nrow5>0) {

                  ?>

                  <td><?php echo $row['fechacj']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['cedula']; ?> </td>
                  <td><?php echo $row['codigo']; ?> </td>
                  <td><?php echo $row['descrip_tcj']; ?> </td>
                  <td><?php echo $row['descrip_dtc']; ?> </td>

                  <td><div class="cont_tbn_tb">
                    <a href="ingreso_factura.php?id=<?php echo $row['id_casos_juridicos'] ?>" >
                      <button type="button" title="Imprimir" class="btn btn-default asignar" name="button">
                        <i class="fas fa-print fa-2x"></i>
                      </button>
                    </a>
                  </div></td>
                </tr>
<?php } } ?>
            </table>
          </div>

  </div>
</div>

<script>
$(document).ready( function () {
    $('.tabla').DataTable();
} );
</script>


<?php include ('footer.php'); ?>
