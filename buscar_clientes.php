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
              <i class="fa fa-pencil" style="color: #000"></i>
            </div>
            <div class="ccfcp_ct_titulo">
              <h2 style="color: #000">BUSCAR CLIENTES</h2>
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
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Correos</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Tipo Empleado</th>
                    <th>Editar / Dar de baja</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * from clientes C inner join tipo_cliente TC on TC.id_tipo_cliente=C.id_tipo_cliente where C.id_estado='1' ORDER BY C.id_clientes DESC");
                    while($row=mysqli_fetch_array($consulta)){
                      if ($row['cedula']!='0999999999') {

                  ?>
                  <td><?php echo $row['cedula']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['correo']; ?> </td>
                  <td><?php echo $row['telefono']; ?> </td>
                  <td><?php echo $row['direccion']; ?> </td>
                  <td><?php echo $row['descrip_tc']; ?> </td>
                  <td>
                    <div class="cont_tbn_tb">
                      <a href="editar_clientes.php?id=<?php echo $row['id_clientes']; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Dar de Baja" id="<?php echo $row['id_clientes'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_clientes'] ?>"> </i>
                      </button>
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
        confirmButtonText: 'Si, dar de baja!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          document.location.href="app/eliminarCliente.php?id="+id_emp;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          }
      })
    })
  </script> <?php } } ?>
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
<?php unset($_SESSION['confirmar']); } }?>

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
  title: 'Cliente eliminado'
})
}
ejecutarEjemplo();
</script>
<?php unset($_SESSION['eliminar']); } }?>
