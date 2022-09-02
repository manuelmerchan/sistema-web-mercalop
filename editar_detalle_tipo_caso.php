<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$idtcj=$_REQUEST['idtcj'];
$consulta=mysqli_query($con,"SELECT * from detalle_tipo_caso where id_detalle_tipo_caso='$id' ");
$row=mysqli_fetch_array($consulta);
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarDetalleTipo_Caso.php?id=<?php echo $id."&idtcj=".$idtcj; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Editar Detalle Tipo de Caso</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="detalle">Detalle Tipo de Caso:</label>
                          <input class="form_input" type="text" id="detalle" name="detalle" value="<?php echo $row['descrip_dtc']; ?>" onkeypress="return sololetras(event)" onpaste="return false;" required>
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="MODIFICAR">
                        </div>
                        <div class="col-md-5">
                            <a href="ingreso_detalle_tipo_caso.php?id=<?php echo $idtcj; ?>"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>
                <script>
$(document).on('change','#detalle', function(){
    var valr= $('#detalle').val();
    if(valr!=""){
        // var texto = MaysPrimera(valr.tolowerCase());
        var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
        // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
        var texto = valr.toUpperCase();// TODO0 MAYUSCULA
        document.getElementById('detalle').value=texto;
    }
});
</script>

            <br><br><br><br><br><br><br>


<?php include ('footer.php'); ?>
