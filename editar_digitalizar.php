<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT * from digitalizacion where id_digitalizacion='$id' ");
$row=mysqli_fetch_array($consulta);
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarDigitalizar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Editar Formato </h2>
                    </div>
                    <hr>


                    <div class="row">

                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="categoria">Categorias:</label>
                          <select class="form_input" id="categoria" name="categoria" required><option value="" >-Seleccionar-</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from categorias");
                              while($row4=mysqli_fetch_array($consulta4)){
                              if($row4['id_categorias']==$row['id_categoria']){$sel="selected='selected'";}else{$sel="";}
                              echo "<option ".$sel." value='".$row4['id_categorias']."'>"; echo $row4['nombrec']; echo "</option>"; } ?> </select>
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="nombre">Nombre de Documento:</label>
                          <input class="form_input" type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required placeholder="Escriba Nombre de Documento">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="documento">Documento a digitalizar:</label>
                          <input class="form_input" type="file" id="documento" name="documento" title="Seleccione Documento a digitalizar">
                      </div>


                    </div>
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

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="MODIFICAR">
                        </div>
                        <div class="col-md-5">
                            <a href="ingreso_digitalizar.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br>



  </div>
</div>


<?php include ('footer.php'); ?>
