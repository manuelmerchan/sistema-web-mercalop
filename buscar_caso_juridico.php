<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
// include ('menu_fixed.php');
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>

<style>
.container{
  width: 100%;
}
.custom_select{
  width: 110px;
  height: 36px;
  text-align: center;
  border: none;
  border-radius: 5px;
  background: rgba(90, 90, 90, .9);
  color: #ECECEC;
}
.custom_select:hover{
  background: rgba(255, 255, 255, .7);
  color: #3B3B3B;
  cursor: pointer;
}
.cont_tabla{
	height: auto;
	width: 100%;
	margin-top: 20px;
	display: flex;
	align-items: center;
	justify-content: center;
	padding: 20px;
	padding-bottom: 20px;
	padding-left: 20px;
	overflow-x: scroll;
}
</style>
<div class="container delimitador">
  <div class="contenedor">

    <div class="ccf_cabecera_pantalla">
        <div class="ccfcp_contenedor_titulo">
            <div class="ccfcp_ct_icono">
              <i class="fas fa-balance-scale" style="color: #000"></i>
            </div>
            <div class="ccfcp_ct_titulo">
              <h2 style="color: #000">CASOS JURIDICOS</h2>
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
                    <th>Código</th>
                    <th>Empleado</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Tipo de Caso</th>
                    <!-- <th>Detalle Tipos de Caso</th> -->
                    <th>Estado</th>
                    <th>Proceso</th>
                    <th>Agregar Datos de Oponente</th>
                    <th>Cambiar Abogado del Caso</th>
                    <th>Crear Expediente</th>
                    <th>Opciones</th>
                  </tr>
                </thead>

<?php

$data_query="SELECT *,CJ.fecha fechacj,CJ.id_estado estadocj FROM casos_juridicos CJ inner join estado E on E.id_estado=CJ.id_estado inner join tipo_caso TCJ on TCJ.id_tipo_caso=CJ.id_tipo_caso inner join cotizacion C on C.id_cotizacion=CJ.id_cotizacion inner join clientes CL on CL.cedula=C.id_clientes WHERE CL.id_estado='1' and CJ.id_estado!='2' ".$query_sesion." ORDER BY id_casos_juridicos DESC ";
$consulta=mysqli_query($con,$data_query);
while($row=mysqli_fetch_array($consulta)){
  //CONSULTA PROCESO
  $idEstadoProceso=$row['proceso'];
  $consEstadoProceso=mysqli_query($con,"SELECT * FROM estado WHERE id_estado='$idEstadoProceso'");
  $rowEstadoProceso=mysqli_fetch_array($consEstadoProceso);
  $estadoProceso = $rowEstadoProceso['descrip'];

  $estadocj=$row['estadocj'];
  $consEstado=mysqli_query($con,"SELECT * FROM estado WHERE id_estado='$estadocj'");
  $rowConsEstado=mysqli_fetch_array($consEstado);
  $nombreEstado=$rowConsEstado['descrip'];
  $id_casoJ=$row['id_casos_juridicos'];

  $idempleadobase=$row['id_abg_ayudante'];
  $consDatEmple = mysqli_query($con,"SELECT * FROM empleados WHERE cedula='$idempleadobase'");
  $rowConsDatEmple=mysqli_fetch_array($consDatEmple);
  $nombreEmpleado=$rowConsDatEmple['nombres']." ".$rowConsDatEmple['apellidos'];

  // $consulta2=mysqli_query($con,"SELECT * from oponente where id_casos_juridicos='$id_casoJ' ");
  // $nrow2=mysqli_num_rows($consulta2);

  $consFactura=mysqli_query($con,"SELECT * FROM facturas WHERE casos_juridicos='$id_casoJ' ");
  $numFactura=mysqli_num_rows($consFactura);

  $consPago=mysqli_query($con,"SELECT sum(abono) tabono FROM pago_abono WHERE id_casos_juridicos='$id_casoJ' ");
  $rowPago=mysqli_fetch_array($consPago);
  $pagos=$rowPago['tabono'];
  $consDeuda=mysqli_query($con,"SELECT sum(valor_deuda) tdeuda FROM deudas WHERE id_casos_juridicos='$id_casoJ' ");
  $rowDeuda=mysqli_fetch_array($consDeuda);
  $deudas=$rowDeuda['tdeuda'];
  $deuda_p=$deudas-$pagos;

  $consExpediente=mysqli_query($con,"SELECT * from expedientes where id_casos_juridicos='$id_casoJ' ");
  $numExpediente=mysqli_num_rows($consExpediente);
?>
                  <tr <?php if ($row['estadocj']=='3'){ ?> style="background:#c7f6c6;"  <?php } ?> >

                    <td><?php echo $row['fechacj']; ?> </td>
                    <td><?php echo $row['codigo']; ?> </td>
                    <td><?php echo $nombreEmpleado; ?> </td>
                    <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  
                    <!-- <td><?php echo $row['estadocj']." * ".$numExpediente." * ".$deuda_p." * ".$numFactura; ?> </td> -->
                    <td><?php echo $row['telefono']; ?> </td>
                    <td><?php echo $row['descrip_tcj']; ?> </td>
                    <!-- <td><?php echo $row['descrip_dtc']; ?> </td> -->
                    <!-- <td><?php echo $row['descrip']; ?> </td> -->
                    <td><?php echo $nombreEstado; ?> </td>
                    <!-- <td><?php echo $estadoProceso; ?> </td> -->
                    <td>
                      <select name="estado_proceso" id="estado_proceso" class="custom_select" <?php if ($row['estadocj']=='3'){ echo "disabled"; }?> >
                        <option value="">-SELECCIONE-</option>
                        <?php
                          $consEst=mysqli_query($con,"SELECT * from estado WHERE id_estado>=5 and id_estado<=7");
                            while($rowEst=mysqli_fetch_array($consEst)){
                              if($idEstadoProceso==$rowEst['id_estado']){$sel="selected='selected'";}else{$sel="";}
                        ?>
                        <option class="selecopc" <?php echo $sel; ?> value="<?php echo $row['id_estado']; ?>" id="<?php echo $row['id_casos_juridicos'] ?>" data-proceso="<?php echo $rowEst['id_estado']; ?>"><b> <?php echo $rowEst['descrip']; ?> </b></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td> <?php if ($row['estadocj']!='3'){ ?><div class="cont_tbn_tb">
                      <a href="ingreso_oponente.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                        <button type="button" title="Agregar datos del oponente" class="btn btn-default asignar" name="button">
                          <i class="far fa-share-square fa-2x"></i>
                        </button>
                      </a>
                    </div> <?php } ?></td>
                    
                    <td><?php if ($row['estadocj']!='3'){ ?><div class="cont_tbn_tb">
                        <a href="asignar_abogado.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                          <button type="button" title="Asignar a Abogado" class="btn btn-default asignar" name="button">
                            <i class="far fa-share-square fa-2x"></i>
                          </button>
                        </a>
                      </div> <?php } ?></td>
                  <td><?php if ($row['estadocj']!='3'){ ?><div class="cont_tbn_tb">
                      <a href="ingreso_expedientes.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                        <button type="button" title="Crear Expediente" class="btn btn-default asignar" name="button">
                          <i class="far fa-folder-open fa-2x"></i>
                        </button>
                      </a>
                    </div> <?php } ?></td>
                    
                  <td>
                    <div class="cont_tbn_tb">
                      <?php if ($row['estadocj']!='3' && $numExpediente>0 && $deuda_p!=0 && $numFactura==0){ ?>
                        <a href="lista_casos_pagos.php" style="font-size: 13px;" class="btn btn-info">IR A PAGOS</a>
                      <?php } ?>
                    
                      <?php if ($row['estadocj']!='3' && $numExpediente==0 && $numFactura==0 ){ ?>
                        <a href="editar_casos_juridicos.php?id=<?php echo $row['id_casos_juridicos']; ?>">
                          <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                            <i class="far fa-edit fa-2x"> </i>
                          </button>
                        </a>
                        <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_casos_juridicos'] ?>" name="button" id="elim">
                          <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_casos_juridicos'] ?>"> </i>
                        </button>
                      <?php } ?>

                      <?php if ($row['estadocj']!='3' && $numExpediente>0 && $deuda_p==0 && $numFactura==0){ ?>
                        <a href="lista_factura_casos.php" class="btn btn-info" style="font-size: 13px;" title="Ya no posee ninguna deuda el Caso">
                          FACTURAR CASO
                        </a>
                      <?php } ?>
                    </div>
                  </td>
                </tr>
  <script type="text/javascript">
    $('.eliminar').click(function(e){
      var id_emp= e.target.id;

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Esta Seguro?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          window.location.href="app/eliminarCasosJuridicos.php?id="+id_emp;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          }
      })
    })
  </script> 

            <?php } ?>
            </table>
          </div>

<script type="text/javascript">
$('.selecopc').click(function(e){
  var id_caso= e.target.id;
  var id_proceso= this.dataset.proceso;
  window.location.href="app/cambiarEstadoProceso.php?idcaso="+id_caso+"&idproceso="+id_proceso;
})

</script> 

<script>
$(document).ready( function () {
    // $('.tabla').DataTable();
    $('.tabla').DataTable( { "ordering": false } );
} );
</script>


  </div>
</div>

<?php include ('footer.php'); ?>

<?php if (isset($_SESSION['confirmar'])) {
  if ($_SESSION['confirmar']==1){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Datos Guardados'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['confirmar']=0; } }?>

<!-- EDITAR -->
<?php if (isset($_SESSION['confirmar'])) {
  if ($_SESSION['confirmar']==2){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Datos Editados Correctamente'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['confirmar']=0; } }?>

<!-- ELIMINAR -->
<?php if (isset($_SESSION['eliminar'])) {
  if ($_SESSION['eliminar']==1){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Caso Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>

<!-- CAMBIAR ESTADO PROCESO -->
<?php if (isset($_SESSION['cambio'])) {
  if ($_SESSION['cambio']==1){ ?>
<script>
function ejecutarEjemplo(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'SE HA MODIFICADO EL PROCESO DEL CASO'
})
}
ejecutarEjemplo();
</script>
<?php unset($_SESSION['cambio']); } }?>
