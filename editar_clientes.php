<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT * from clientes where id_clientes='$id' ");
$row=mysqli_fetch_array($consulta);
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form" action="app/modificarCliente.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">EDITAR DE CLIENTES</h2>
                    </div>

                    <hr>

                    <div class="row">

                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="cedula">Cédula:</label>
                          <input class="form_input" type="text" id="cedula" name="cedula" maxlength="10" onchange="validarCedula(this.value);" required onkeypress="return solonumeros(event)" value="<?php echo $row['cedula']; ?>" placeholder="Escriba su Cédula" onpaste="return false;">
                      </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="nombres">Nombres:</label>
                            <input class="form_input" type="text" id="nombres" name="nombres" onkeypress="return sololetras(event)" required value="<?php echo $row['nombres']; ?>" placeholder="Escriba su nombre" onpaste="return false;">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="apellidos">Apellidos:</label>
                            <input class="form_input" type="text" id="apellidos" name="apellidos" onkeypress="return sololetras(event)" required value="<?php echo $row['apellidos']; ?>" placeholder="Escriba su apellido" onpaste="return false;">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="genero">Género:</label>
                            <select class="form_input" id="genero" name="genero" required><option value="" >-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from genero");
                                while($row4=mysqli_fetch_array($consulta4)){
                                if($row4['id_genero']==$row['id_genero']){$sel="selected='selected'";}else{$sel="";}
                                echo "<option ".$sel." value='".$row4['id_genero']."'>"; echo $row4['descrip_g']; echo "</option>"; } ?> </select>
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="estado_civil">Estado Civil:</label>
                            <select class="form_input" id="estado_civil" name="estado_civil" required><option value="" >-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from estado_civil");
                                while($row4=mysqli_fetch_array($consulta4)){
                                if($row4['id_estado_civil']==$row['id_estado_civil']){$sel="selected='selected'";}else{$sel="";}
                                echo "<option ".$sel." value='".$row4['id_estado_civil']."'>"; echo $row4['descrip_ec']; echo "</option>"; } ?> </select>
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="correo">Correo:</label>
                            <input class="form_input" type="text" id="correo" name="correo" required value="<?php echo $row['correo']; ?>" placeholder="Escriba su nombre">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="telefono">Telefono:</label>
                            <input class="form_input" type="text" id="telefono" name="telefono" maxlength="10" required value="<?php echo $row['telefono']; ?>" onkeypress="return solonumeros(event)" placeholder="Escriba su Teléfono">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="direccion">Direccion:</label>
                            <input class="form_input" type="text" id="direccion" name="direccion" required value="<?php echo $row['direccion']; ?>" placeholder="Escriba la dirección">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="tipo_cliente">Tipo Clientes:</label>
                            <select class="form_input" id="tipo_cliente" name="tipo_cliente" required><option value="" >-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from tipo_cliente");
                                while($row4=mysqli_fetch_array($consulta4)){
                                if($row4['id_tipo_cliente']==$row['id_tipo_cliente']){$sel="selected='selected'";}else{$sel="";}
                                echo "<option ".$sel." value='".$row4['id_tipo_cliente']."'>"; echo $row4['descrip_tc']; echo "</option>"; } ?> </select>
                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <input type="submit" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-3">
                            <a href="buscar_clientes.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br><br>



  </div>
</div>
<script>
    $(document).on('change','#nombres', function(){
        var valr= $('#nombres').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
           var texto = valr.toUpperCase();// TODO0 MAYUSCULA
            document.getElementById('nombres').value=texto;
        }
    });
    $(document).on('change','#apellidos', function(){
        var valr= $('#apellidos').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
           var texto = valr.toUpperCase();// TODO0 MAYUSCULA
            document.getElementById('apellidos').value=texto;
        }
    });

    $(document).on('keyup','#direccion', function(){
        var valr= $('#direccion').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('direccion').value=texto;
        }
    });

</script>


<?php include ('footer.php'); ?>
