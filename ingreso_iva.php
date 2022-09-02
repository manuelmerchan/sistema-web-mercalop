<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">
<?php
// $consulta=mysqli_query($con,"SELECT * from iva where id_iva='1' ");
// $row=mysqli_fetch_array($consulta);
 ?>


                <form class="form3" action="app/guardar_iva.php" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">I.V.A.</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="iva">Valor del porcentaje:</label>
                          <input class="form_input" type="number" id="iva" name="iva" max="25" step="0.01" min="0.00" onkeypress="return solonumeros(event)" placeholder="ingrese el valor del IVA" onpaste="return false;" required>
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


            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Descripción</th>
                    <th>valor</th>
                    <th>Establecer</th>
                    <th> Borrar</th>
                  </tr>
                </thead>

                  <?php
                    $consulta=mysqli_query($con,"SELECT * FROM iva ORDER BY id_iva DESC");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <tr <?php  if($row['id_estado']=='1'){ ?> style="background:rgb(152, 199, 151);"<?php } ?>>
                  <td><?php echo $row['descrip_iva']; ?> </td>
                  <td><?php echo $row['valor_iva']; ?> </td>
                  <td><div class="cont_tbn_tb">
                      <a href="app/designat_iva.php?id=<?php echo $row['id_iva'] ?>">
                        <button type="button" title="Designar" class="btn btn-default asignar" name="button">
                          <i class="far fa-check-square fa-2x"></i>
                        </button>
                      </a>
                    </div></td>
                  <td><?php  if($row['id_iva']!='1'){ ?>
                    <div class="cont_tbn_tb">
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_iva'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_iva'] ?>"> </i>
                      </button>
                    </div><?php } ?>
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
            document.location.href="app/eliminarIva.php?id="+id_emp;
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

<!-- ASIGNAR IVA -->
<?php if (isset($_SESSION['asignar'])) {
  if ($_SESSION['asignar']==1){ ?>
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
  title: 'EL VALOR DEL IVA FUE ASIGNADO'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['asignar']=0; } }?>


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

<?php
if (isset($_SESSION['confi'])) {
  $swal="";
  if ($_SESSION['confi']==10) {
    $titulo="Advertencia!";
    $mensaje="Acción Inválida, el registro está en uso.";
    $tipo="warning"; //success error warning info question
  } elseif ($_SESSION['confi']==5) {
    $titulo="Aviso!";
    $mensaje="Ya existe un Cargo con el mismo nombre";
    $tipo="warning";
  }
  $swal.="<script>Swal.fire('".$titulo."','".$mensaje."','".$tipo."')</script>";
  echo $swal;
  unset($_SESSION['confi']);
}
?>
