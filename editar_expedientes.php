<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


$id=$_REQUEST['id'];
$idcsj=$_REQUEST['idcsj'];
$consulta=mysqli_query($con,"SELECT * from expedientes where id_expedientes='$id' ");
$row=mysqli_fetch_assoc($consulta);

?>
<style media="screen">
.amoldarcheck{
      height: 52px;
      margin-bottom: 0px;
      border:1px solid #ffbd28;
      padding-top:5px;
      background: rgba(0, 0, 0, 0.4);
      border-bottom: 2px solid #ffbd28;
    }

</style>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
<div class="contenedor">

              <form class="form" action="app/modificarExpediente.php?id=<?php echo $id."&idcsj=".$idcsj; ?>" method="POST" enctype="multipart/form-data">
                  <div class="form_header">
                      <h2 class="form_titulo">EDITAR EXPEDIENTE</h2>
                  </div>

                  <hr>

                  <div class="row">

                    <div class="col-md-6 content_cajas">
                          <label class="form_label" for="lugar">Lugar de trámite:</label>
                          <select class="form_input" id="lugar" name="lugar" required><option value="" >-Seleccionar-</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from lugares");
                              while($row4=mysqli_fetch_array($consulta4)){
                              if($row4['id_lugares']==$row['lugares']){$sel="selected='selected'";}else{$sel="";}
                              echo "<option ".$sel." value='".$row4['id_lugares']."'>"; echo $row4['descrip_l']; echo "</option>"; } ?> </select>
                      </div>
                    <div class="col-md-6 content_cajas">
                        <label class="form_label" for="codigo">Código:</label>
                        <input class="form_input" type="text" id="codigo" name="codigo" maxlength="15" value="<?php echo $row['codigo_exp'] ?>"  placeholder="Escriba Codigo" required>
                    </div>



                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="nombre_anexo">Nombre/Asunto del Anexo:</label>
                          <input class="form_input" type="text" id="nombre_anexo" name="nombre_anexo" value="<?php echo $row['nombre_anexo'] ?>" onkeypress="return sololetras(event)" placeholder="Escriba Nombre/Asunto del Anexo" required>
                      </div>
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="num_anexos">Cantidad de Anexos:</label>
                          <input class="form_input" type="text" id="num_anexos" name="num_anexos" value="<?php echo $row['num_doc_anexados'] ?>" maxlength="3" onkeypress="return solonumeros(event)" placeholder="Escriba Cantidad de Anexos" required>
                      </div>


                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="documento">Documento (Anexo):</label>
                          <input class="form_input" type="file" id="documento" name="documento" placeholder="Escriba Documento" accept="application/pdf">
                      </div>

                      <div class="col-md-6 content_cajas">

                        <span class="input-group-addon" title="Solicitar Pago a Cliente" style="background:#ffbd28; color:#fff; border-color:#ffbd28;"><i class="fas fa-hand-holding-usd"></i></span>
                        <input type="checkbox" name="solicitarpago" id="solicitarpago" class="checked" value="1" <?php  if($row['solicitud_pago']=="1"){ echo 'checked';} ?>>
                        <label class="labelt amoldarcheck" for="solicitarpago" >Solicitar Pago a Cliente </label>
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
                          <a href="ingreso_expedientes.php?id=<?php echo $idcsj; ?>"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                      </div>
                  </div>
              </form>
              <script>
              $(buscar_cedula());
              function buscar_cedula(consulta){
                $.ajax({
                  url: 'ajax_cedula_empleado.php',
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
                      title: 'Ya existe un Empleado con la misma cédula'
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
                  buscar_cedula(valr);
                }
              });
              </script>


          <br><br>


        </div>
        </div>



<script>
  $(document).on('change','#nombre_anexo', function(){
      var valr= $('#nombre_anexo').val();
      if(valr!=""){
         // var texto = MaysPrimera(valr.tolowerCase());
         var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
         // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
         var texto = valr.toUpperCase();// TODO0 MAYUSCULA
          document.getElementById('nombre_anexo').value=texto;
      }
  });
  $(document).on('change','#apellidos', function(){
      var valr= $('#apellidos').val();
      if(valr!=""){
         // var texto = MaysPrimera(valr.tolowerCase());
         var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
         // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
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
title: 'Empleado Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
