<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/guardarDigitalizar.php" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Cargar Formatos </h2>
                    </div>
                    <hr>


                    <div class="row">

                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="categoria">Categorias:</label>
                          <select class="form_input" id="categoria" name="categoria" required><option value="" >-Seleccionar-</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from categorias");
                              while($row4=mysqli_fetch_array($consulta4)){
                              echo "<option value='".$row4['id_categorias']."'>"; echo $row4['nombrec']; echo "</option>"; } ?> </select>
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="nombre">Nombre de Documento:</label>
                          <input class="form_input" type="text" id="nombre" name="nombre" required placeholder="Escriba Nombre de Documento">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="documento">Documento a digitalizar:</label>
                          <input class="form_input" type="file" id="documento" name="documento" required  title="Seleccione Documento a digitalizar">
                      </div>


                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-5">
                            <a href="inicio.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>

<script>
$(document).on('change','#nombre', function(){
    var valr= $('#nombre').val();
    if(valr!=""){
        // var texto = MaysPrimera(valr.tolowerCase());
        var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
        // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        var texto = valr.toUpperCase();// TODO0 MAYUSCULA
        document.getElementById('nombre').value=texto;
    }
});
</script>
            <br><br>
            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Nombre Documento</th>
                    <th>Descargar Documento</th>
                    <th>Editar / Borrar</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * from digitalizacion ");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <td><?php echo $row['nombre']; ?> </td>
                  <td><?php if($row['documento']!=""){ ?> <a href="<?php echo $row['documento']; ?>" target="_blank"><i class="fas fa-file-download fa-2x"></i></a> <?php } ?>  </td>
                  <td>
                    <div class="cont_tbn_tb">
                      <a href="editar_digitalizar.php?id=<?php echo $row['id_digitalizacion']; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_digitalizacion'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_digitalizacion'] ?>"> </i>
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
          confirmButtonText: 'Si, eliminar!',
          cancelButtonText: 'No, cancelar!',
          reverseButtons: true
          }).then((result) => {
          if (result.value) {
          document.location.href="app/eliminarDigitalizar.php?id="+id_emp;
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
    $('.tabla').DataTable();
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
  title: 'Registro Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
