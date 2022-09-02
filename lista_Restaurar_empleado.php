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
              <h2 style="color: #000">RESTAURAR EMPLEADOS</h2>
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
                    <th>Foto</th>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Correos</th>
                    <th>Teléfono</th>
                    <th>Tipo Empleado</th>
                    <th>Restaurar / Eliminar</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * from empleados E inner join tipo_empleado TE on TE.id_tipo_empleado=E.id_tipo_empleado where E.id_estado='2' ");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                  <td><?php echo $row['cedula']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['correo']; ?> </td>
                  <td><?php echo $row['telefono']; ?> </td>
                  <td><?php echo $row['descrip_te']; ?> </td>
                  <td>
                    <div class="cont_tbn_tb">
                      <!-- <a href="app/restaurar_empleado.php?id=<?php echo $row['id_empleados'] ?>">
                        <button type="button" title="Restaurar empleado" class="btn btn-default asignar" name="button">
                          <i class="fas fa-user-plus fa-2x"></i> </button>
                      </a> -->
                      <button type="button" class="btn btn-default asignar" title="Restaurar Empleado" id="<?php echo $row['cedula']; ?>" name="button" id="elim"> <i class="fas fa-user-plus fa-2x" id="<?php echo $row['cedula']; ?>"></i>
                      </button>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['cedula']; ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['cedula']; ?>"> </i>
                      </button>
                    </div>
                  </td>
                </tr>
<script type="text/javascript">
$('.asignar').click(function(e){
  var id_emp= e.target.id;

  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  })

  swalWithBootstrapButtons.fire({
    title: 'Restaurar Empleado?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, restaurar!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
    document.location.href="app/restaurar_empleado.php?id="+id_emp;
  } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
  ) {
    }
  })
})
</script>
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
          document.location.href="app/eliminarEmpleadoTotal.php?id="+id_emp;
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

  </div>
</div>
<script>
$(document).ready( function () {
    $('.tabla').DataTable();
} );
</script>


<?php include ('footer.php'); ?>

<?php
if (isset($_SESSION['confirmar'])) {
  if ($_SESSION['confirmar']==1){
?>
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
  title: 'Empleado Recuperado'
})
}
ejecutarEjemplo();
</script>
<?php unset( $_SESSION['confirmar']); } } ?>


<?php
if (isset($_SESSION['eliminar'])) {
  $swal="";
  if ($_SESSION['eliminar']==1) {
    $titulo="Exito!";
    $mensaje="El empleado fue eliminado por completo";
    $tipo="success"; //success error info question
  }
  $swal.="<script>Swal.fire('".$titulo."','".$mensaje."','".$tipo."')</script>";
  echo $swal;
  unset($_SESSION['eliminar']);
}
?>

<?php
if (isset($_SESSION['esta'])) {
  $swal="";
  if ($_SESSION['esta']==11) {
    $titulo="Advertencia!";
    $mensaje="No se puede eliminar el empleado porque esta activo en varios procesos.";
    $tipo="warning"; //success error info question
  }
  $swal.="<script>Swal.fire('".$titulo."','".$mensaje."','".$tipo."')</script>";
  echo $swal;
  unset($_SESSION['esta']);
}
?>
