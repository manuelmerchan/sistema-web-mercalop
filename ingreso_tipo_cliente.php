<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <!--<form class="form3" action="app/guardarTipoCliente.php" method="POST" enctype="multipart/form-data">-->
                <form name="formulario1" class="form3" action="app/guardarTipoCliente.php" method="POST">
                    <div class="form_header">
                        <h2 class="form_titulo">Tipo De Cliente</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="tipo_cli">Tipo De Cliente:</label>
                          <input class="form_input" type="text" id="tipo_cli" name="tipo_cli" required onkeypress="return sololetras(event)" placeholder="Escriba Tipo De Cliente" onpaste="return false;">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <!-- <input type="submit" class="btn_submit" id="guardar" value="GUARDAR" disabled> -->
                            <input type="button" class="btn_submit" id="guardar" value="GUARDAR">
                        </div>
                        <div class="col-md-5">
                            <a href="inicio.php"> <button type="button" class="btn_cancel"  name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>

<script>
$(buscar_tip_emple());
function buscar_tip_emple(consulta){
    $.ajax({
        url: 'ajax_tipo_cliente.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    .done(function(respuesta){
        if(respuesta==''){
        }else{
            if(respuesta>0){
                document.getElementById('tipo_cli').value='';
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
                    title: 'YA EXISTE ESE REGISTRO!!'
                })
                //document.getElementById('guardar').setAttribute("disabled", "");
            }else{
                document.formulario1.submit();
                //document.getElementById('guardar').removeAttribute("disabled");
            }
        }
        // document.getElementById('cedula').value=respuesta;
    })
    .fail(function(){
        console.log("error")
    })
}
//$(document).on('change','#tipo_cli', function(){
    //var valr= $(this).val();
    //if(valr!=""){
        //buscar_tip_emple(valr);
    //}
//});
$(document).on('click','#guardar', function(){
  // var valr= $(this).val();
  var valr= document.getElementById('tipo_cli').value;
  if(valr!=""){
    buscar_tip_emple(valr);
  }else{
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
      title: 'COMPLETE TODOS LOS CAMPOS!!'
    })
  }
});
</script>


        <script>
            $(document).on('change','#tipo_cli', function(){
            var valr= $('#tipo_cli').val();
            if(valr!=""){
                // var texto = MaysPrimera(valr.tolowerCase());
                var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
                // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
                var texto = valr.toUpperCase();// TODO0 MAYUSCULA
                document.getElementById('tipo_cli').value=texto;
            }
          });
        </script>

            <br><br>

            <!-- TABLA -->
            <div class="cont_tabla">
              <table class="tabla">
                <thead>
                  <tr>
                    <th>Tipo De Cliente</th>
                    <th>Editar / Borrar</th>
                  </tr>
                </thead>
                <tr>
                  <?php
                    $consulta=mysqli_query($con,"SELECT * from tipo_cliente ORDER BY id_tipo_cliente DESC");
                    while($row=mysqli_fetch_array($consulta)){
                  ?>
                  <td><?php echo $row['descrip_tc']; ?> </td>
                  <td>
                    <div class="cont_tbn_tb">
                      <a href="editar_tipo_cliente.php?id=<?php echo $row['id_tipo_cliente']; ?>">
                        <button type="button" title="Modificar" class="btn btn-primary modificar" name="button">
                          <i class="far fa-edit fa-2x"> </i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger eliminar" title="Eliminar" id="<?php echo $row['id_tipo_cliente'] ?>" name="button" id="elim">
                        <i class="far fa-trash-alt fa-2x" id="<?php echo $row['id_tipo_cliente'] ?>"> </i>
                      </button>
                    </div>
                  </td>
                </tr>
  <script type="text/javascript">
    $('.eliminar').click(function(e){
      var id_emp= e.target.id;

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
          document.location.href="app/eliminarTipoCliente.php?id="+id_emp;
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

<?php
if (isset($_SESSION['confi'])) {
  $swal="";
  if ($_SESSION['confi']==10) {
    $titulo="Advertencia!";
    $mensaje="Acción Inválida, el registro está en uso.";
    $tipo="warning"; //success error warning info question
  } elseif ($_SESSION['confi']==5) {
    $titulo="Aviso!";
    $mensaje="Ya existe un Cargo con el mismo nombre";
    $tipo="warning";
  }
  $swal.="<script>Swal.fire('".$titulo."','".$mensaje."','".$tipo."')</script>";
  echo $swal;
  unset($_SESSION['confi']);
}
?>
