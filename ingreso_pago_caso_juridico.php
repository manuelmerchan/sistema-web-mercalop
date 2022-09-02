<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT sum(abono) tabono FROM pago_abono WHERE id_casos_juridicos='$id' ");
$row=mysqli_fetch_array($consulta);
$pagos=$row['tabono'];

$consul1=mysqli_query($con,"SELECT sum(valor_deuda) tdeuda FROM deudas WHERE id_casos_juridicos='$id' ");
$rowl=mysqli_fetch_array($consul1);
$deudas=$rowl['tdeuda'];

$deuda_p=$deudas-$pagos;


?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/guardarPagoCasoJuridico.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Pagos / Abonos</h2>
                        <p>Deuda actual: $ <?php echo number_format($deuda_p, 2); ?></p>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="pagos">Pagos o Abonos: </label>
                          <input class="form_input" type="number" id="pagos" name="pagos" step="0.01"  max="<?php echo number_format($deuda_p, 2); ?>" min="0.01" placeholder="Escriba pagos" onkeypress="return solonumeros(event)" required>
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                          <?php if($deuda_p!=0){ ?>
                            <input type="submit" class="btn_submit" value="GUARDAR">
                          <?php }else{ ?>
                            <input type="button" class="btn_submit" value="GUARDAR" onclick="noHayDeuda()">
                          <?php } ?>
                        </div>
                        <div class="col-md-5">
                            <a href="lista_casos_pagos.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>
<script>
  function noHayDeuda(){
    Swal.fire('Advertencia!','Ya no tiene deudas.','warning')
  }
</script>

            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Pagos/Abonos</th>
                    <th>Empleado</th>
                    <th>Nota de Venta</th>
                    <th>Editar / Borrar</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                  $tp_acum=0;
                  $conta=0;
                    $consulta3=mysqli_query($con,"SELECT * from pago_abono PA inner join empleados E on E.cedula=PA.id_empleados where PA.id_casos_juridicos='$id' ORDER BY PA.id_pago_abono DESC");
                    while($row3=mysqli_fetch_array($consulta3)){
                        $tp_acum+=$row3['abono'];
                        $conta++;
                  ?>
                  <td><?php echo $row3['fecha']." ".$row3['hora']; ?> </td>
                  <td><?php echo $row3['abono']; ?> </td>
                  <td><?php echo $row3['nombres']." ".$row3['apellidos']; ?> </td>
                  <td><div class="cont_tbn_tb">
                    <a href="report/nota_de_venta.php?id=<?php echo $row3['id_pago_abono'] ?>" target="_blank">
                      <button type="button" title="Imprimir" class="btn btn-default asignar" name="button">
                        <i class="fas fa-print fa-2x"></i>
                      </button>
                    </a>
                  </div></td>

                  <td><?php //if ($conta!=3) { ?><div class="cont_tbn_tb">
                      <a href="editar_pago_caso_juridico.php?id=<?php echo $row3['id_pago_abono']."&idcj=".$id; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row3['id_pago_abono'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row3['id_pago_abono'] ?>"> </i>
                      </button>
                    </div>
                <?php //} ?>  </td>
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
          document.location.href="app/eliminarPagoCasoJuridico.php?id="+id_emp+"&idcsj="+id_cj;
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
      <th >TOTAL PAGADO</th>
      <th>$  <?php echo number_format($tp_acum, 2) ?></th>
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
