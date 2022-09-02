<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


$id=$_REQUEST['id'];
$consult2=mysqli_query($con,"SELECT SUM(abono)suma_pagos FROM pago_abono WHERE id_casos_juridicos='$id' ");
$rowp2=mysqli_fetch_array($consult2);
$spagos=$rowp2['suma_pagos'];

$consult3=mysqli_query($con,"SELECT SUM(valor_deuda)suma_deuda FROM deudas WHERE id_casos_juridicos='$id' ");
$rowp3=mysqli_fetch_array($consult3);
$sdeuda=$rowp3['suma_deuda'];
$valor_restante=$sdeuda-$spagos;

?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/guardardeudaCasoJuridico.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Agregar Deuda</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="deuda">Deuda: </label>
                          <input class="form_input" type="number" id="deuda" name="deuda" step="0.01"  min="0.01" placeholder="Escriba Deuda" onkeypress="return solonumeros(event)" onpaste="return false;" required>
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="descrip">Descripción: </label>
                          <input class="form_input" type="text" id="descrip" name="descrip"  maxlength="95" placeholder="Escriba Descripción" required>
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-5">
                            <a href="lista_deuda_clienteXcaso.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Deuda</th>
                    <th>Descripción</th>
                    <th>Editar / Borrar</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                  $tp_acum=0;
                  $conta=0;
                    $consulta3=mysqli_query($con,"SELECT * FROM deudas D WHERE D.id_casos_juridicos='$id' ORDER BY D.id_deudas DESC ");
                    while($row3=mysqli_fetch_array($consulta3)){
                        $tp_acum+=$row3['valor_deuda'];
                        $conta++;
                        $descrip=$row3['descripcion'];
                  ?>
                  <td><?php echo $row3['fecha']; ?> </td>
                  <td><?php echo $row3['valor_deuda']; ?> </td>
                  <td><?php echo $row3['descripcion']; ?> </td>

                  <td>
                    <?php if ($descrip!="Valor del Caso") { ?><div class="cont_tbn_tb">
                      <a href="editar_deuda_caso_juridico.php?id=<?php echo $row3['id_deudas']."&idcj=".$id; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <?php if ($row3['valor_deuda']<=$valor_restante) {  ?>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row3['id_deudas'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row3['id_deudas'] ?>"> </i>
                      </button>
                    <?php } ?>
                    </div>
                <?php } ?>  </td>
                </tr>
  <script type="text/javascript">
    $('.eliminar').click(function(e){
      var id_emp= e.target.id;
      var id_cj='<?php echo $id; ?>';

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
          document.location.href="app/eliminardeudaCasoJuridico.php?id="+id_emp+"&idcsj="+id_cj;
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          }
      })
    })
  </script> <?php } ?>
  <tfoot>
    <tr>
      <!--<th >TOTAL :</th>
      <th>$  <?php echo number_format($tp_acum, 2) ?></th>
      -->
       <th >DEUDA ACTUAL :</th>
       <th>$  <?php echo number_format($valor_restante, 2) ?></th>
      <th colspan="3"></th>
    </tr>
  </tfoot>
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
  title: 'DATOS GUARDADOS'
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
  title: 'DATOS EDITADOS CORRECTAMENTE'
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
  title: 'REGISTRO ELIMINADO'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
