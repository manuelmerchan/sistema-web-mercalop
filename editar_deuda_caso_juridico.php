<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


$id=$_REQUEST['id'];
$idcj=$_REQUEST['idcj'];

$consul1=mysqli_query($con,"SELECT * FROM deudas WHERE id_deudas='$id' ");
$rowl=mysqli_fetch_array($consul1);
$deuda=$rowl['valor_deuda'];
$descripcion=$rowl['descripcion'];



?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarDeudaCasoJuridico.php?id=<?php echo $id."&idcj=".$idcj; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Editar Deuda</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="deuda">Deuda: </label>
                          <input class="form_input" type="number" id="deuda" name="deuda" value="<?php echo $deuda; ?>"  min="0" placeholder="Escriba Deuda" onkeypress="return solonumeros(event)" required>
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="descrip">Descripción: </label>
                          <input class="form_input" type="text" id="descrip" name="descrip" value="<?php echo $descripcion; ?>"  placeholder="Escriba Descripción" required>
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="MODIFICAR">
                        </div>
                        <div class="col-md-5">
                            <a href="ingreso_deuda_caso_juridico.php?id=<?php echo $idcj; ?>"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br>


  </div>
</div>

<script>
$(document).ready( function () {
    // $('.tabla').DataTable();
    $('.tabla').DataTable( { "ordering": false } );
} );
</script>

<?php include ('footer.php'); ?>
