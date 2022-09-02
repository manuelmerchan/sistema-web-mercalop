<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$consulta=mysqli_query($con,"SELECT * from casos_juridicos order by id_casos_juridicos DESC");
$nurow=mysqli_num_rows($consulta);
if ($nurow>0) {
  $row=mysqli_fetch_array($consulta);
  $num_f=$row['id_casos_juridicos'];
  $num_f=$num_f+1;
}else{
  $num_f=1;
}
$cantnum_f=strlen($num_f);
if($cantnum_f==1){
  $num_f="0".$num_f;
}
$anioactual=date("y");
?>

<script src='js/jquery-customselect.js'></script>
<link href='css/jquery-customselect.css' rel='stylesheet' />
<style media="screen">
  .custom-select{ width: 100%; height: 50px; background: rgba(0,0,0,.7); border: none; outline: none; border-bottom: 2px solid #ffbd28; margin-bottom: 20px; border-radius: 2px; font-size: 18px; color: #FFFFFF;
    font-family: roboto; }
  .custom-select a{ display: flex; align-items: center; width: 100%; height: 50px; }
  .custom-select a span{ color: #fff; width: 100%; height: 50px; display: flex; align-items: center; padding-left: 12px; }
  .custom-select input{ color: #000; width: 90%; }
  .custom-select div div{ color: #000; }
  .input_cotiza{ padding: 6px; margin-bottom: 10px; height: 30px; font-size: 16px; }
  .content_cajas_cotiza{ height: 55px; }
</style>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador" style="margin-top: 117px;">
  <div class="contenedor">

                <form class="form" action="app/guardarCasoJuridico.php" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">INGRESO DE CASO JURÍDICO</h2>
                    </div>

                    <hr>
<script>
$(function() {
  $("#listaprovincia").customselect();
});
</script>
                    <div class="row">
                      <div class="col-md-6 content_cajas">
                            <label class="form_label" for="provincias">Provincias:</label>
                            <select class="form_input custom-select" id="listaprovincia" name="provincias" required> <option value="" >-Seleccionar-</option>
                                    <?php
                                        $consulta4=mysqli_query($con,"SELECT * from provincias order by provincia_nombre ASC");
                                         while($row4=mysqli_fetch_array($consulta4)){
                                        echo "<option ".$sel." value='".$row4['provincia_id']."'>"; echo $row4['provincia_nombre']; echo "</option>"; $contad++; }  ?> </select>
                      </div>

<script>
$(function() {
  $("#listaciudad").customselect();
});
</script>
            <div class="col-md-6 content_cajas" id="selectciudad">
              <label class="form_label" for="ciudades">Ciudades:</label>
              <select class='form_input custom-select' id='listaciudad' name='ciudades'> <option value="">-Seleccionar-</option> </select>
            </div>
<script type="text/javascript">
$(document).ready(function(){
	// $('#listaprovincia').val(1);
	// recargarLista();

	$('#listaprovincia').change(function(){
		recargarLista();
	});
})
</script>
<script type="text/javascript">
function recargarLista(){
	$.ajax({
		type:"POST",
		url:"datos_pc.php",
		data:"provincia=" + $('#listaprovincia').val(),
		success:function(r){
			$('#selectciudad').html(r);
		}
	});
}
</script>

                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="codigo">Código:</label>
                          <input class="form_input" type="text" id="codigo" name="codigo" maxlength="15" value="" placeholder="Elija Tipo de Caso" readonly required>
                          <input style="display: none;" type="text" id="codigoes" maxlength="15" value="CJ-<?php echo $num_f.'-'.$anioactual; ?>" placeholder="Escriba Codigo">
                      </div>
<script>
$(function() {
  $("#tipo_caso").customselect();
});
</script>
                      <div class="col-md-6 content_cajas">
                        <label class="form_label" for="tipo_caso">Tipo de Caso:</label>
                        <select class="form_input custom-select" id="tipo_caso" name="tipo_caso" required>
                          <option value="" >-Seleccionar-</option>
                          <?php $consulta4=mysqli_query($con,"SELECT * from tipo_caso");
                            while($row4=mysqli_fetch_array($consulta4)){ echo "<option value='".$row4['id_tipo_caso']."'>"; echo $row4['descrip_tcj']; echo "</option>"; } ?> </select>
                      </div>
                      <div class="col-md-6 content_cajas" id="selectdetalle">
                        <label class="form_label" for="detalletc">Detalle  de Caso:</label>
                        <select class="form_input" name=""> <option value="">-Seleccionar-</option> </select>
                      </div>
    <script type="text/javascript">
    	$(document).ready(function(){
    		// $('#tipo_caso').val(1);
    		// recargarListaD();

    		$('#tipo_caso').change(function(){
    			recargarListaD();
          completarCodigo();
    		});
    	})
    </script>
    <script type="text/javascript">
    	function recargarListaD(){
    		$.ajax({
    			type:"POST",
    			url:"datos_tc.php",
    			data:"tc=" + $('#tipo_caso').val(),
    			success:function(r){
    				$('#selectdetalle').html(r);
    			}
    		});
    	}

      function completarCodigo(){
    		$.ajax({
    			type:"POST",
    			url:"datos_tc2.php",
    			data:"tc=" + $('#tipo_caso').val(),
    			success:function(r){
            var tipocaso = r;
            var partes = tipocaso.split(' ');
            var longitud = partes.length;

            let cadena ="";

            if (longitud==1) {

              for (let i = 0; i < 1; i++){
                //Dividimos la frase en varias palabras
                let aux = partes[i];
                //concatenamos las 3 primeras letras de cada palabra
                cadena += aux.substring(0, 3);
              }

            }else{

              // for (let i = 0; i < longitud; i++){
              for (let i = 0; i < 2; i++){
                //Dividimos la frase en varias palabras
                let aux = partes[i];
                //concatenamos las 3 primeras letras de cada palabra
                // cadena += aux.substring(0, 3);
                if (i==0) {
                  cadena += aux.substring(0, 2);
                }else{
                  cadena += aux.substring(0, 1);
                }
              }

            }

            var codigo = document.getElementById('codigoes').value;
            var partesc = codigo.split('-');
            var partec1 = partesc[0];
            var partec2 = partesc[1];
            var partec3 = partesc[2];

            // var nuevocodigo = cadena+'-'+partec1+''+partec3+'-'+partec2;
            var nuevocodigo = cadena+'-'+partec3+'-'+partec2;

            document.getElementById('codigo').value=nuevocodigo;

    			}
    		});
    	}
    </script>


<script>
$(function() {
  $("#cotizacion").customselect();
});
</script>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="cotizacion">Cotización:</label>
                            <select class="form_input custom-select" id="cotizacion" name="cotizacion" required>
                              <option value="" >-Seleccionar-</option>
                              <?php
                                $consulta4=mysqli_query($con,"SELECT * from cotizacion C inner join clientes CL on CL.cedula=C.id_clientes where C.id_estado='1' ");
                                $numCot=mysqli_num_rows($consulta4);
                                if($numCot>=1){
                                  while($row4=mysqli_fetch_array($consulta4)){
                                    echo "<option value='".$row4['id_cotizacion']."'>"; echo "Nº:".$row4['num_cotizacion']." - ".$row4['nombres']." ".$row4['apellidos']; echo "</option>";
                                  }
                                }else{
                                  echo "<option> No hay Cotizaciones</option>";
                                }
                              ?>
                            </select>
                        </div>
                        <div class="col-md-6 content_cajas">
                            <label class="form_label" for="pago_ini">Pago Inicial:</label>
                            <input class="form_input" type="number" id="pago_ini" name="pago_ini" step="0.01" placeholder="Pago Inicial" min="30" max="" onkeypress="return solonumeros(event)" onpaste="return false;" required>
                        </div>

                        <div class="col-md-12 descripc">
                            <label class="form_label" for="descripcion">Descripción:</label>
                            <textarea class="form_input descripc" id="descripcion" name="descripcion" placeholder="Escriba Descripción" rows="8" cols="80"></textarea>
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
                            <a href="buscar_caso_juridico.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>
                <script>
                $(buscar_valor_cotiza());
                function buscar_valor_cotiza(consulta){
                  $.ajax({
                    url: 'ajax_valor_cotiza.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {consulta: consulta},
                  })
                  .done(function(respuesta){
                    if(respuesta!=''){
                      document.getElementById('pago_ini').max=respuesta;
                      document.getElementById('pago_ini').placeholder='Pago inicial máximo de '+respuesta;
                      //document.getElementById('pago_ini').value=respuesta;
                    }else{

                    }
                    // document.getElementById('cedula').value=respuesta;
                  })
                  .fail(function(){
                    console.log("error")
                  })
                }
                $(document).on('change','#cotizacion', function(){
                  var valr= $(this).val();
                  if(valr!=""){
                    buscar_valor_cotiza(valr);
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


    $(document).on('keyup','#descripcion', function(){
        var valr= $('#descripcion').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
            document.getElementById('descripcion').value=texto;
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
  title: 'Caso Eliminado'
})
}
ejecutarEjemplo();
</script>
<?php $_SESSION['eliminar']=0; } }?>
