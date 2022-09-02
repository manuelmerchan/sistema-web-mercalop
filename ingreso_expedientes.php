<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$consul=mysqli_query($con,"SELECT * from casos_juridicos where id_casos_juridicos='$id'");
$nrow=mysqli_num_rows($consul);
$estadoCJ='0';
if ($nrow>0) {
  $row=mysqli_fetch_array($consul);
  $estadoCJ=$row['id_estado'];
}

$id_casoJ=$row['id_casos_juridicos'];
$consPago=mysqli_query($con,"SELECT sum(abono) tabono FROM pago_abono WHERE id_casos_juridicos='$id' ");
$rowPago=mysqli_fetch_array($consPago);
$pagos=$rowPago['tabono'];

$consDeuda=mysqli_query($con,"SELECT sum(valor_deuda) tdeuda FROM deudas WHERE id_casos_juridicos='$id' ");
$rowDeuda=mysqli_fetch_array($consDeuda);
$deudas=$rowDeuda['tdeuda'];

$deuda_p=$deudas-$pagos;

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

              <form class="form" action="app/guardarExpediente.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                  <div class="form_header">
                      <h2 class="form_titulo">CREAR EXPEDIENTE AL CLIENTE </h2>
                  </div>

                  <?php echo "la deuda es ".$deuda_p; ?>

                  <hr>
                  
                  <div class="row">
                    <!-- <div class="col-md-6 content_cajas">
                          <label class="form_label" for="casos_juridicos">Caso Juridico:</label>
                          <select class="form_input" id="casos_juridicos" name="casos_juridicos" required><option value="" >-Seleccionar-</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from casos_juridicos");
                              while($row4=mysqli_fetch_array($consulta4)){
                              echo "<option value='".$row4['id_casos_juridicos']."'>"; echo $row4['codigo']; echo "</option>"; } ?> </select>
                      </div> -->
                    <div class="col-md-6 content_cajas">
                          <label class="form_label" for="lugar">Lugar de trámite:</label>
                          <select class="form_input" id="lugar" name="lugar" required><option value="" >-Seleccionar-</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from lugares");
                              while($row4=mysqli_fetch_array($consulta4)){
                              echo "<option value='".$row4['id_lugares']."'>"; echo $row4['descrip_l']; echo "</option>"; } ?> </select>
                      </div>
                    <div class="col-md-6 content_cajas">
                        <label class="form_label" for="codigo">Código:</label>
                        <input class="form_input" type="text" id="codigo" name="codigo" maxlength="15" value="<?php echo $row['codigo']; ?>" placeholder="Escriba Codigo" readonly required>
                    </div>

                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="nombre_anexo">Nombre/Asunto del Anexo:</label>
                          <input class="form_input" type="text" id="nombre_anexo" name="nombre_anexo" placeholder="Escriba Nombre/Asunto del Anexo" onpaste="return false;" required>
                      </div>

  <script>
      $(document).on('change','#nombre_anexo', function(){
          var valr= $('#nombre_anexo').val();
            var texto = valr.toUpperCase(); // todo mayuscula
            document.getElementById('nombre_anexo').value=texto;

      });
  </script>

                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="num_anexos">Cantidad de hojas Anexadas:</label>
                          <input class="form_input" type="text" id="num_anexos" name="num_anexos" maxlength="3" onkeypress="return solonumeros(event)" required placeholder="Escriba Cantidad de Anexos" onpaste="return false;" required>
                      </div>


                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="documento">Documento (Anexo):</label>
                          <input class="form_input" type="file" id="documento" name="documento" placeholder="Escriba Documento" required accept="application/pdf">
                      </div>

                      <div class="col-md-6 content_cajas">

                        <span class="input-group-addon" title="Solicitar Pago a Cliente" style="background:#ffbd28; color:#fff; border-color:#ffbd28;"><i class="fas fa-hand-holding-usd"></i></span>
                        <input type="checkbox" name="solicitarpago" id="solicitarpago" class="checked" value="1" <?php if($deuda_p==0){ echo "disabled"; } // if($row2['m3']!=""){ echo 'checked';} ?>>
                        <label class="labelt amoldarcheck" for="solicitarpago" style="color:#3F3F3F" >
                          <?php if($deuda_p==0){ echo "No tiene deudas"; }else{ echo "Solicitar Pago a Cliente"; } ?>
                        </label>
                      </div>


                  </div>

                  <br><br>

                  <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3">
                        <?php if ($estadoCJ=="3") { ?>
                          <input type="button" class="btn_submit" value="GUARDAR" onclick="casoCerrado()" title="Este caso ya a Finalizado">
                          <?php }else{ ?>
                          <input type="submit" class="btn_submit" value="GUARDAR" title="Este caso aun sigue abierto">
                        <?php } ?>
                        <!-- <input type="submit" class="btn_submit" value="GUARDAR" <?php if ($estadoCJ=="3") { ?> disabled title="Este caso ya a Finalizado" <?php } ?> > -->
                      </div>
                      <div class="col-md-3">
                          <a href="buscar_caso_juridico.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                      </div>
                  </div>
              </form>

<script>
function casoCerrado(){
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
    icon: 'info',
    title: 'EL CASO ESTA FINALIZADO'
  })
}
</script>
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

          <!-- TABLA -->
          <div class="cont_tabla">
            <table class="tabla">
              <thead>
                <th></th>
                <th></th>
                <th >ANEXOS</th>
                <th></th>
                <th></th>
                <tr>
                  <th>Fecha</th>
                  <th>Lugar de Trámite</th>
                  <!-- <th>Código</th> -->
                  <th>Nombre/Asunto</th>
                  <th>Documento Anexado</th>
                  <th>Editar / Borrar</th>
                </tr>
              </thead>
              <tr>
                <?php
                  $consulta=mysqli_query($con,"SELECT * from expedientes EX inner join lugares L on L.id_lugares=EX.lugares where EX.id_estado='1' and EX.id_casos_juridicos='$id' order by id_expedientes desc");
                  while($row=mysqli_fetch_array($consulta)){
                ?>
                <!-- <td><?php echo $row['fecha']." ".$row['hora']; ?> </td> -->
                <td><?php echo $row['fecha']; ?> </td>
                <td><?php echo $row['descrip_l'] ?></td>
                <!-- <td><?php echo $row['codigo_exp']; ?> </td> -->
                <td><?php echo $row['nombre_anexo']; ?> </td>
                <td><?php if($row['documento']!=""){ ?> <a href="<?php echo $row['documento']; ?>" target="_blank" title="VER/DESCARGAR DOCUMENTO"><i class="fas fa-file-download fa-2x"></i></a> <?php } ?>  </td>

                <td><?php if ($estadoCJ!="3") { ?>
                  <div class="cont_tbn_tb">
                    <a href="editar_expedientes.php?id=<?php echo $row['id_expedientes']."&idcsj=".$id; ?>"><button type="button" title="Modificar" class="btn btn-primary modificar" name="button"> <i class="far fa-edit fa-2x"> </i>
                      </button>
                    </a>
                    <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_expedientes'] ?>" name="button" id="elim">
                      <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_expedientes'] ?>"> </i>
                    </button>
                  </div><?php } ?>
                </td>
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
        document.location.href="app/eliminarExpedientes.php?id="+id_emp+"&idcsj="+id_cj;
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



        </div>
        </div>


<script>
$(document).ready( function () {
  //$('.tabla').DataTable();
  $('.tabla').DataTable( { "ordering": false } );
} );
</script>

<script>
  $(document).on('keyup','#nombres', function(){
      var valr= $('#nombres').val();
      if(valr!=""){
         // var texto = MaysPrimera(valr.tolowerCase());
         // var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
         // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
         var texto = valr.toUpperCase();// TODO0 MAYUSCULA
          document.getElementById('nombres').value=texto;
      }
  });
  $(document).on('keyup','#apellidos', function(){
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
title: 'Datos Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
