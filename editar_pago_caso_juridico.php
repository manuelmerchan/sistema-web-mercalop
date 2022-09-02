<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


$id=$_REQUEST['id'];
$idcj=$_REQUEST['idcj'];

$consulta=mysqli_query($con,"SELECT * from cotizacion C inner join casos_juridicos CJ where CJ.id_casos_juridicos='$idcj' ");
$row=mysqli_fetch_array($consulta);
$total=$row['total_pagar'];
$pago_ini=$row['valor_pago_inicial'];
$deuda=$total;

$acum_abono=0;
$consulta2=mysqli_query($con,"SELECT * from pago_abono where id_casos_juridicos='$idcj' ");
while ($row2=mysqli_fetch_array($consulta2)) {
  $acum_abono+=$row2['abono'];
}
$deuda=$deuda-$acum_abono;

$consulta3=mysqli_query($con,"SELECT * from pago_abono where id_pago_abono='$id' ");
$row3=mysqli_fetch_array($consulta3);

?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarPagoCasoJuridico.php?id=<?php echo $id."&idcj=".$idcj; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Editar Pago / Abono</h2>
                        <!-- <p>Total Deuda Pendiente: $ <?php echo number_format($deuda+$row3['abono'], 2); ?></p> -->
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="pagos">Pago o Abono: </label>
                          <input class="form_input" type="number" id="pagos" name="pagos" value="<?php echo $row3['abono']; ?>" max="<?php echo number_format($deuda+$row3['abono'], 2); ?>" min="0" placeholder="Escriba pagos" required onkeypress="return solonumeros(event)">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="MODIFICAR">
                        </div>
                        <div class="col-md-5">
                            <a href="ingreso_pago_caso_juridico.php?id=<?php echo $idcj; ?>"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br>



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
  title: 'Registro Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
