<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador" style="margin-top: 117px;">
  <div class="contenedor">



                <form name="formulario1" class="form" action="app/guardarClientes.php" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">INGRESO DE CLIENTES</h2>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="cedula">Cédula:</label>
                          <input class="form_input" type="text" id="cedula" name="cedula" maxlength="10" onchange="validarCedula(this.value);" required onkeypress="return solonumeros(event)" placeholder="Escriba su Cédula" onpaste="return false;">
                      </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="nombres">Nombres:</label>
                            <input class="form_input" type="text" id="nombres" name="nombres" placeholder="Escriba su nombre" required onkeypress="return sololetras(event)" onpaste="return false;">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="apellidos">Apellidos:</label>
                            <input class="form_input" type="text" id="apellidos" name="apellidos" placeholder="Escriba su apellido" required onkeypress="return sololetras(event)" onpaste="return false;">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="genero">Género:</label>
                            <select class="form_input" id="genero" name="genero" required><option value="" >-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from genero");
                                while($row4=mysqli_fetch_array($consulta4)){
                                echo "<option value='".$row4['id_genero']."'>"; echo $row4['descrip_g']; echo "</option>"; } ?> </select>
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="estado_civil">Estado Civil:</label>
                            <select class="form_input" id="estado_civil" name="estado_civil" required><option value="" >-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from estado_civil");
                                while($row4=mysqli_fetch_array($consulta4)){
                                echo "<option value='".$row4['id_estado_civil']."'>"; echo $row4['descrip_ec']; echo "</option>"; } ?> </select>
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="correo">Correo:</label>
                            <input class="form_input" type="email" id="correo" name="correo" placeholder="Escriba su correo" required onchange="validarcorreo()">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="telefono">Teléfono:</label>
                            <input class="form_input" type="text" id="telefono" name="telefono" required placeholder="Escriba su Telefono" maxlength="10" onkeypress="return solonumeros(event)" onpaste="return false;">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="direccion">Dirección:</label>
                            <input class="form_input" type="text" id="direccion" name="direccion" required placeholder="Escriba la dirección">
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="tipo_cliente">Tipo Cliente:</label>
                            <select class="form_input" id="tipo_cliente" name="tipo_cliente" required><option value="" >-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from tipo_cliente");
                                while($row4=mysqli_fetch_array($consulta4)){
                                echo "<option value='".$row4['id_tipo_cliente']."'>"; echo $row4['descrip_tc']; echo "</option>"; } ?> </select>
                        </div>
                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <!-- <input type="submit" class="btn_submit" value="GUARDAR"> -->
                            <input type="button" id="guardar" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-3">
                            <a href="buscar_clientes.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>

<script>
$(document).on('click','#guardar', function(){
  // var valr= $(this).val();
  var cedula= document.getElementById('cedula').value;
  var nombres= document.getElementById('nombres').value;
  var apellidos= document.getElementById('apellidos').value;
  var genero= document.getElementById('genero').value;
  var estado_civil= document.getElementById('estado_civil').value;
  var correo= document.getElementById('correo').value;
  var telefono= document.getElementById('telefono').value;
  var direccion= document.getElementById('direccion').value;
  var tipo_cliente= document.getElementById('tipo_cliente').value;
  if(cedula!="" && nombres!="" && apellidos!="" && genero!="" && estado_civil!="" && correo!="" && telefono!="" && direccion!="" && tipo_cliente!=""){
    mensajeEnvio();
    document.formulario1.submit();
  }else{
    const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

    Toast.fire({
      icon: 'warning',
      title: 'COMPLETE TODOS LOS CAMPOS!!'
    })
  }
});

function mensajeEnvio(){
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 20000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'info',
  title: 'ENVIANDO DATOS, ESPERE...'
})
}
// mensajeEnvio();
</script>


<script>
$(buscar_cedula_cli());
function buscar_cedula_cli(consulta){
  $.ajax({
    url: 'ajax_cedula_cliente.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta==''){

    }else{
      if(respuesta>0){
        $("#cedula").css({
          "background-color": "rgba(255,87,87,0.5)"
        });
        document.getElementById('cedula').value='';
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
          icon: 'warning',
          title: 'YA EXISTE UN CLIENTE CON LA MISMA CÉDULA'
        })
      }else{
        $("#cedula").css({
          "background-color": "rgba(56,208,49,0.5)"
        });
      }
    }
    // document.getElementById('cedula').value=respuesta;
  })
  .fail(function(){
    console.log("error")
  })
}

$(document).on('change','#cedula', function(){
  var valr= $(this).val();
  if(valr!=""){
    buscar_cedula_cli(valr);
  }
});
</script>

            <br><br>


  </div>
</div>

<script>
$(document).ready( function () {
    $('.tabla').DataTable();
} );
</script>

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
