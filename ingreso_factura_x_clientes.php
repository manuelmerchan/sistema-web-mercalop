<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');



?>
<script src='js/jquery-customselect.js'></script>
<link href='css/jquery-customselect.css' rel='stylesheet' />
<style media="screen">
  .custom-select{
    width: 100%;
    height: 50px;
    background: rgba(0,0,0,.7);
    border: none;
    outline: none;
    border-bottom: 2px solid #ffbd28;
    margin-bottom: 20px;
    border-radius: 2px;
    font-size: 18px;
    color: #FFFFFF;
    font-family: roboto;
  }

  .custom-select a{
    display: flex;
    align-items: center;
    width: 100%;
    height: 50px;
  }
  .custom-select a span{
    color: #fff;
    width: 100%;
    height: 50px;
    display: flex;
    align-items: center;
    padding-left: 12px;
  }
  .custom-select input{
    color: #000;
    width: 90%;
  }
  .custom-select div div{
    color: #000;
  }

  .input_cotiza{
    padding: 6px;
    margin-bottom: 10px;
    height: 30px;
    font-size: 16px;
  }
  .content_cajas_cotiza{
      height: 55px;
  }
</style>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form" action="app/guardarFacturaCliente.php" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">INGRESO DE FACTURA</h2>
                    </div>

                    <hr>

                    <div class="row">

                      <div class="col-md-12 content_cajas">
                            <label class="form_label" for="clientes">Cliente:</label>
                            <select class="form_input custom-select" id="clientes" name="clientes" autofocus required>
                              <option value="">-Seleccionar-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from clientes where id_estado='1'");
                                while($row4=mysqli_fetch_array($consulta4)){
                                  if($row4['cedula']=='0999999999'){$sel="selected='selected'";}else{$sel="";}
                                echo "<option ".$sel." value='".$row4['id_clientes']."'>"; echo $row4['cedula']." - ".$row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                        </div><br><br><br><br><br>

                        <div class="col-md-4 content_cajas_cotiza">
                            <label class="form_label" for="cedula">RUC/C.I. :</label>
                            <input class="form_input input_cotiza" type="text" id="cedula" name="cedula" value="" readonly required>
                        </div>
                        <div class="col-md-4 content_cajas_cotiza">
                            <label class="form_label" for="nombres">Nombres :</label>
                            <input class="form_input input_cotiza" type="text" id="nombres" name="nombres" value="" readonly required>
                        </div>
                        <div class="col-md-4 content_cajas_cotiza">
                            <label class="form_label" for="telefono">Teléfono :</label>
                            <input class="form_input input_cotiza" type="text" id="telefono" name="telefono" value="" required onkeypress="return enable(event)">
                        </div>
                        <div class="col-md-6 content_cajas_cotiza">
                            <label class="form_label" for="correo">Correo:</label>
                            <input class="form_input input_cotiza" type="text" id="correo" name="correo" value="" readonly required>
                        </div>
                        <div class="col-md-6 content_cajas_cotiza">
                            <label class="form_label" for="direccion">Dirección:</label>
                            <input class="form_input input_cotiza" type="text" id="direccion" name="direccion" value="" readonly required>
                        </div>
                    </div>

                    <hr>

                    <div class="row">

                      <div class="col-md-4 content_cajas">
                          <label class="form_label" for="nfactura">Nº Factura:</label>
                          <input class="form_input" type="text" id="nfactura" name="nfactura" value="" placeholder="Escriba Nº Factura" onkeypress="return solonumeros(event)" required>
                      </div>
<script>
$(function() {
  $("#servicios").customselect();
});
</script>
                      <div class="col-md-8 content_cajas">
                          <label class="form_label" for="servicios">Servicios:</label>
                          <select class="form_input custom-select" id="servicios" name="servicios" required><option value="" >-Seleccionar-</option>
                            <?php $consulta4=mysqli_query($con,"SELECT * from servicios");
                              while($row4=mysqli_fetch_array($consulta4)){
                              echo "<option value='".$row4['id_servicios']."'>"; echo $row4['descrip_s']; echo "</option>"; } ?> </select>
                      </div>

                    </div><br>

                    <div class="">
                      <div class="col-md-4 content_cajas_cotiza">
                          <label class="form_label" for="subtotal">Sub Total:</label>
                          <input class="form_input input_cotiza" type="text" id="subtotal" name="subtotal" value="" readonly required>
                      </div>
                      <?php
                        $consulta3=mysqli_query($con,"SELECT * from iva where id_estado='1' ");
                        $row3=mysqli_fetch_array($consulta3);
                        $ivav=$row3['valor_iva'];

                       ?>
                      <div class="col-md-4 content_cajas_cotiza">
                          <label class="form_label" for="iva">IVA:</label>
                          <input class="form_input input_cotiza" type="text" id="iva" name="iva" value="" readonly required>
                      </div>
                      <div class="col-md-4 content_cajas_cotiza">
                          <label class="form_label" for="totalp">TOTAL:</label>
                          <input class="form_input input_cotiza" type="text" id="totalp" name="totalp" value="" readonly required>
                      </div>
                    </div>

                    <br><br><br><br>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <input type="submit" class="btn_submit" value="GUARDAR">
                        </div>
                        <div class="col-md-3">
                            <a href="buscar_facturas.php"> <button type="button"  class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>
    <script>
      $(function() {
        $("#clientes").customselect();
      });
    </script>

                <script>
                $(buscar_dt_cliente());
                function buscar_dt_cliente(consulta){
                  $.ajax({
                    url: 'ajax_datos_cliente.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {consulta: consulta},
                  })
                  .done(function(respuesta){
                    if(respuesta!=''){
                      var dat_cli=respuesta.split('**');
                      document.getElementById('cedula').value=dat_cli[0];
                      document.getElementById('nombres').value=dat_cli[1];
                      document.getElementById('telefono').value=dat_cli[2];
                      document.getElementById('correo').value=dat_cli[3];
                      document.getElementById('direccion').value=dat_cli[4];
                    }else{

                    }

                  })
                  .fail(function(){
                    console.log("error");
                  })
                }

                $(document).ready(function() {
                    $("#clientes").change(function() {
                      var dato=$(this).val();
                      if (dato!="") {
                        buscar_dt_cliente(dato);
                      }

                    });
                });
                </script>

                <script>
                $(buscar_servicio());
                function buscar_servicio(consulta){
                  $.ajax({
                    url: 'ajax_busca_servicio.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {consulta: consulta},
                  })
                  .done(function(respuesta){
                    if(respuesta!=''){
                      var valor=respuesta;
                      var ivav='<?php echo $ivav; ?>';
                      var ivaf=(parseFloat(valor) * parseFloat(ivav)) / 100;
                      var total_pagar=ivaf + parseFloat(valor);
                      document.getElementById('subtotal').value=parseFloat(valor).toFixed(2);

                      document.getElementById('iva').value=parseFloat(ivaf).toFixed(2);
                      document.getElementById('totalp').value=parseFloat(total_pagar).toFixed(2);



                    }else{

                    }
                    //
                  })
                  .fail(function(){
                    console.log("error")
                  })
                }
                $(document).on('change','#servicios', function(){
                  var valr= $(this).val();
                  if(valr!=""){
                    buscar_servicio(valr);
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
    $(document).on('keyup','#nombres', function(){
        var valr= $('#nombres').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
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

<script>
$(buscar_num_fact());
function buscar_num_fact(consulta){
  $.ajax({
    url: 'ajax_num_factura.php',
    type: 'POST',
    dataType: 'html',
    data: {consulta: consulta},
  })
  .done(function(respuesta){
    if(respuesta==''){

    }else{
    if(respuesta>0){
      $("#nfactura").css({
        "background-color": "rgba(255,87,87,0.5)"
      });
      document.getElementById('nfactura').value='';
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
        title: 'Ya existe el numero de Factura'
      })
    }else{
      $("#nfactura").css({
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
$(document).on('keyup','#nfactura', function(){
  var valr= $(this).val();
  if(valr!=""){
    buscar_num_fact(valr);
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
  title: 'Factura Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
