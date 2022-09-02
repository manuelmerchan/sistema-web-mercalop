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
              <h2 style="color: #000">BUSCAR EMPLEADOS</h2>
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
                    <th>Dirección</th>
                    <th>Tipo Empleado</th>
                    <th>Asig/Modif. Usuarios</th>
                    <th>Editar / Dar de Baja</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * from empleados E inner join tipo_empleado TE on TE.id_tipo_empleado=E.id_tipo_empleado where E.id_estado='1' ORDER BY E.id_empleados DESC");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <td> <img src=" <?php echo $row['foto']; ?>" alt="" width="60" height="60"> </td>
                  <td><?php echo $row['cedula']; ?> </td>
                  <td><?php echo $row['nombres']." ".$row['apellidos']; ?> </td>
                  <td><?php echo $row['correo']; ?> </td>
                  <td><?php echo $row['telefono']; ?> </td>
                  <td><?php echo $row['direccion']; ?> </td>
                  <td><?php echo $row['descrip_te']; ?> </td>
                  <td><div class="cont_tbn_tb">
                      <a href="asignar_usuario.php?id=<?php echo $row['id_empleados'] ?>">
                        <button type="button" title="Asignar/Modificar Usuario" class="btn btn-default asignar" name="button">
                          <i class="far fa-share-square fa-2x"></i>
                        </button>
                      </a>
                    </div></td>
                  <td>
                    <div class="cont_tbn_tb">
                      <a href="editar_empleados.php?id=<?php echo $row['id_empleados']; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Dar de baja" id="<?php echo $row['cedula']; ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['cedula']; ?>"> </i>
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
          document.location.href="app/eliminarEmpleado.php?id="+id_emp;
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

<!-- GUARDAR -->
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
  title: 'Datos Guardados Correctamente'
})
}
ejecutarEjemplo();
</script>
<?php unset($_SESSION['confirmar']); } }?>

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
  title: 'El empleado fue dado de baja !!'
})
}
ejecutarEjemplo();
</script>
<?php unset($_SESSION['eliminar']); } }?>

<?php
if (isset($_SESSION['confi'])) {
  $swal="";
  if ($_SESSION['confi']==10) {
    $titulo="Advertencia!";
    $mensaje="No se puede eliminar el empleado que esta en sesión.";
    $tipo="warning"; //success error info question
  } elseif ($_SESSION['confi']==2) {
    $titulo="Éxito!";
    $mensaje="Los datos fueron modificados.";
    $tipo="success";
  }
  $swal.="<script>Swal.fire('".$titulo."','".$mensaje."','".$tipo."')</script>";
  echo $swal;
  unset($_SESSION['confi']);
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
