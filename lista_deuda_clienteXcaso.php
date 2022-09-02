<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
// if ($query_sesion!="") {
//   $query_sesion.="and CJ.id_estado!='3'";
// }

?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">
    <div class="ccf_cabecera_pantalla">
        <div class="ccfcp_contenedor_titulo">
            <div class="ccfcp_ct_icono">
              <i class="fas fa-hand-holding-usd" style="color: #000"></i>
            </div>
            <div class="ccfcp_ct_titulo">
              <h2 style="color: #000">DEUDAS POR CASO</h2>
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
                    <th>Código del Caso</th>
                    <th>Clientes</th>
                    <th>Cédula</th>
                    
                    <th>Tipo de Caso</th>
                    <th>Valor del Caso</th>
                    <th>Agg Deuda </th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT *,CJ.fecha fechacj,CJ.id_estado estadocj FROM casos_juridicos CJ inner join estado E on E.id_estado=CJ.id_estado inner join tipo_caso TCJ on TCJ.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso inner join cotizacion C on C.id_cotizacion=CJ.id_cotizacion inner join clientes CL on CL.cedula=C.id_clientes WHERE CL.id_estado='1' and CJ.id_estado!='3' and CJ.id_estado!='2' ".$query_sesion." ORDER BY CJ.id_casos_juridicos DESC");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <td><?php echo $row['fechacj']; ?> </td>
                  <td><?php echo $row['codigo']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['cedula']; ?> </td>
                  
                  <td><?php echo $row['descrip_tcj']; ?> </td>
                  <td><?php echo $row['valor_pago_inicial']; ?> </td>

                    <td><div class="cont_tbn_tb">
                        <a href="ingreso_deuda_caso_juridico.php?id=<?php echo $row['id_casos_juridicos'] ?>">
                          <button type="button" title="Agregar Deuda al caso" class="btn btn-default asignar" name="button">
                            <i class="far fa-share-square fa-2x"></i>
                          </button>
                        </a>
                      </div></td>
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
          document.location.href="app/eliminarCaso_juridico.php?id="+id_emp;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          }
      })
    })
  </script> <?php } ?>
            </table>
          </div>



  </div>
</div>

<script>
$(document).ready( function () {
    // $('.tabla').DataTable();
    $('.tabla').DataTable( { "ordering": false } );
} );
</script>




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
  title: 'Empleado Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
