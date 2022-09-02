
<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id_empleado = $_SESSION['ID_EMPLE'];

$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT * from asig_caso_abogado where id_casos_juridicos='$id'");
$np=mysqli_num_rows($consulta);
$nombreEmpleado="";

if($np>0){
  $valueop=0;
  $option="-QUITAR ABOGADO-";
  $row1=mysqli_fetch_assoc($consulta);
  $id_emp_rep=$row1['id_empleados'];
  $consulta2=mysqli_query($con,"SELECT * from empleados where cedula='$id_emp_rep'");
  $row2=mysqli_fetch_assoc($consulta2);
  $img_ufoto=$row2['foto'];
  $nombreEmpleado=$row2['nombres']." ".$row2['apellidos'];
}else{
  $valueop="";
  $option="-SELECCIONAR-";
  $id_emp_rep="0";
  $img_ufoto="img_empleados\defoult.jpg";
}

$consul=mysqli_query($con,"SELECT * from casos_juridicos where id_casos_juridicos='$id'");
$nrow=mysqli_num_rows($consul);
$estadoCJ='0';
if ($nrow>0) {
  $rowcj=mysqli_fetch_array($consul);
  $estadoCJ=$rowcj['id_estado'];
}

// echo "<br>id del caso ".$id;
// echo "<br>id del abogado asignado ".$id_emp_rep;
// echo "<br>id del estado del caso ".$estadoCJ;
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
  <body style="background-image: url('login/img/juridico7.jpg');">
  <div class="container delimitador" style="margin-top: 87px;">
    <div class="contenedor">

      <div class="contet_asig">

        <div class="asignador" style="background: #ededfd;">

          <div class="cabecera_asig">
            <h3>ASIGNAR ABOGADO AL CASO</h3>
            <hr>
            <div class="" id="caja_img_f">
                <center> <img src="<?php echo $img_ufoto; ?>" alt="" width="200" height="200"></center>
            </div>
<script>
$(function() {
  $("#abogado").customselect();
});
</script>
          </div>

          <form name="formulario1" class="formu_asig" action="app/guardarAsignarAbogado.php?id=<?php echo $id; ?>" method="post">
          <div class="row">
            <div class="col-md-1"></div>
              <div class="col-md-10 content_cajas">
                <input type="text" id="abogadoBase" value="<?php echo $id_emp_rep; ?>" style="display: none;">
                <label class="form_label" for="provincias">Abogado Ayudante:</label>
                <?php if ($estadoCJ==3) { ?>
                  <input class="form_input" type="text" id="cedula" name="cedulap" value="<?php echo $nombreEmpleado; ?>" maxlength="10" readonly>
                <?php } else { ?>
                <select class="form_input custom-select" id="abogado" name="abogado" required>
                  <option value="<?php echo $valueop; ?>"><?php echo $option; ?></option>
                  <?php
                    $consulta4=mysqli_query($con,"SELECT * from empleados where id_estado!='2' and cedula!='$id_empleado' order by nombres ASC");
                    while($row4=mysqli_fetch_array($consulta4)){
                      if($row4['cedula']==$id_emp_rep){$sel="selected='selected'";}else{$sel="";}
                      echo "<option ".$sel." value='".$row4['cedula']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; $contad++; }  ?>
                </select>
                <?php } ?>
            </div>

          </div><br>
            <div class="row">
                <div class="col-md-1"></div>
                  <div class="col-md-5">
                    <!-- <input type="submit" class="btn_submit" value="ASIGNAR" <?php if ($estadoCJ=="3") { ?> disabled title="Este caso ya a Finalizado" <?php } ?> > -->
                    <?php if ($estadoCJ=="3" and $np>0) { ?>
                    <input type="button" class="btn_submit" value="ASIGNAR" onclick="casoCerrado()" title="Este caso ya a Finalizado">
                    <?php } elseif ($estadoCJ=="1" and $np==0) { ?>
                    <input type="submit" class="btn_submit" value="ASIGNAR" onclick="completarCampos()" title="">
                    <?php } elseif ($estadoCJ=="1" and $np>0) { ?>
                    <!--<input type="button" class="btn_submit" value="ASIGNAR" onclick="casoConDeuda()" title="Este caso aun tiene deudas">-->
                    <input type="button" class="btn_submit" value="MODIFICAR" id="verificarCambio" title="Modificar el abogado asignado">
                    <?php }else{ ?>
                    <input type="submit" class="btn_submit" value="ASIGNAR" title="Este caso aun sigue abierto">
                    <?php } ?>
                  </div>
                  <div class="col-md-5">
                      <a href="buscar_caso_juridico.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                  </div>

            </div>
          </form>

        </div>

      </div>
      <br>
      </div>

      </div>

<script>
$(document).on('click','#verificarCambio', function(){
  var abgBase= document.getElementById("abogadoBase").value;
  var abgNuevo= document.getElementById("abogado").value;

  if(abgBase!=abgNuevo){
    document.formulario1.submit();
  }else{
    noHayCambios();
  }
});  
</script>



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
function casoConDeuda(){
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
    title: 'YA HA ASIGNADO UN ABOGADO A ESTE CASO'
  })
}
</script>

<script>
function completarCampos(){
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
    title: 'COMPLETE TODOS LOS CAMPOS'
  })
}

function noHayCambios(){
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
    title: 'NO HA REALIZADO NINGUN CAMBIO'
  })
}
</script>

<script type="text/javascript">

  $(buscar_abog_asig());

  function buscar_abog_asig(consul){
    $.ajax({
      url: 'ajax_abogado_asig.php',
      type: 'POST',
      dataType: 'html',
      data: {consul: consul},
    })
    .done(function(respuesta){
    if(respuesta!=0 || respuesta!=""){
      $('#caja_img_f').html(respuesta);
    }
    })
    .fail(function(){
      console.log("error")
    })
  }
  $(document).on('change','#abogado', function(){
    var valr= $(this).val();
    if(valr!=""){
      buscar_abog_asig(valr);
    }
  });
</script>

<?php include "footer.php" ?>
