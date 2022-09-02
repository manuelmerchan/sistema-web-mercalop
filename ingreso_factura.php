<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');


$id=$_REQUEST['id'];

$consulta=mysqli_query($con,"SELECT * FROM casos_juridicos CJ inner join clientes C on C.cedula=CJ.id_clientes inner join tipo_caso TC on TC.id_tipo_caso=CJ.id_tipo_caso inner join detalle_tipo_caso DTC on DTC.id_detalle_tipo_caso=CJ.detalle_tipo_caso WHERE CJ.id_casos_juridicos='$id' ");
$row=mysqli_fetch_array($consulta);


// $consul1=mysqli_query($con,"SELECT sum(valor_deuda) tdeuda FROM deudas WHERE id_casos_juridicos='$id' ");
// $rowl=mysqli_fetch_array($consul1);
// $deudas=$rowl['tdeuda'];
//
// $deuda_p=$deudas-$pagos;


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
    border-bottom: 2px solid #c59765;
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


  .tabla2{
    background: rgba(221, 221, 221, 0.68);
    width: 100%;
    align-items: center;
    border: 1px solid #4a4a4a;
   border-collapse: collapse;

  }

  .tabla2 th{
    background: rgba(221, 221, 221, 0.68);
  	padding: 0 5px;
  	text-align: center;
    border: 1px solid #4a4a4a;
   border-collapse: collapse;
  }
  .tabla2 td{
  	text-align: center;
  	padding: 0 5px;
    color: #000;
    border: 1px solid #4a4a4a;
   border-collapse: collapse;
  }
  tr:hover td{
  	background: rgba(221, 221, 221, 0.68);
  	color: #000;
  }
</style>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form" action="app/guardarFacturaCliente.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">INGRESO DE FACTURA</h2>
                    </div>

                    <hr>

                    <div class="row">

                      <!-- <div class="col-md-12 content_cajas">
                            <label class="form_label" for="clientes">Clientes:</label>
                            <select class="form_input custom-select" id="clientes" name="clientes" autofocus required>
                              <?php $consulta4=mysqli_query($con,"SELECT * from clientes");
                                while($row4=mysqli_fetch_array($consulta4)){
                                  if($row4['cedula']=='0994764XXX'){$sel="selected='selected'";}else{$sel="";}
                                echo "<option ".$sel." value='".$row4['id_clientes']."'>"; echo $row4['nombres']." ".$row4['apellidos']; echo "</option>"; } ?> </select>
                        </div><br><br><br><br><br> -->
                        <div class="col-md-3 content_cajas_cotiza">
                            <label class="form_label" for="nfactura">Nº Factura:</label>
                            <input class="form_input input_cotiza" type="text" id="nfactura" name="nfactura" onkeypress="return solonumeros(event)" value="<?php  ?>" placeholder="Escriba Nº Factura" required>
                        </div>

                        <div class="col-md-3 content_cajas_cotiza">
                            <label class="form_label" for="cedula">RUC/C.I. :</label>
                            <input class="form_input input_cotiza" type="text" id="cedula" name="cedula" value="<?php echo $row['cedula']; ?>" readonly required>
                        </div>
                        <div class="col-md-3 content_cajas_cotiza">
                            <label class="form_label" for="nombres">Nombres :</label>
                            <input class="form_input input_cotiza" type="text" id="nombres" name="nombres" value="<?php echo $row['nombres']." ".$row['apellidos']; ?>" readonly required>
                        </div>
                        <div class="col-md-3 content_cajas_cotiza">
                            <label class="form_label" for="telefono">Teléfono :</label>
                            <input class="form_input input_cotiza" type="text" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" required onkeypress="return enable(event)">
                        </div>
                        <div class="col-md-6 content_cajas_cotiza">
                            <label class="form_label" for="correo">Correo:</label>
                            <input class="form_input input_cotiza" type="text" id="correo" name="correo" value="<?php echo $row['correo']; ?>" readonly required>
                        </div>
                        <div class="col-md-6 content_cajas_cotiza">
                            <label class="form_label" for="direccion">Dirección:</label>
                            <input class="form_input input_cotiza" type="text" id="direccion" name="direccion" value="<?php echo $row['direccion']; ?>" readonly required>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-md-12">
                        <table class="tabla2">
                          <thead>
                            <tr>
                              <th>Detalle</th>
                              <th>valor</th>
                            </tr>
                          </thead>
                          <tr>
                            <?php
                            $dt_valor=0;
                              $consulta1=mysqli_query($con,"SELECT * from deudas where id_casos_juridicos='$id' ");
                              while($row1=mysqli_fetch_array($consulta1)){
                                if ($row1['descripcion']=='Valor del Caso') {
                                   $dt_descrip=$row['descrip_tcj']." :".$row['descrip_dtc'];
                                }else {
                                  $dt_descrip=$row1['descripcion'];
                                }
                                $dt_valor+=$row1['valor_deuda'];
                            ?>
                            <td><?php echo $dt_descrip; ?> </td>
                            <td><?php echo $row1['valor_deuda']; ?> </td>
                          </tr>
           <?php } ?>
                          </table>
                      </div>



                    </div><br>
                    <?php
                      $consulta3=mysqli_query($con,"SELECT * from iva where id_estado='1' ");
                      $row3=mysqli_fetch_array($consulta3);
                      $ivav=$row3['valor_iva'];
                      $sub_to=$dt_valor/($ivav/100+1);
                      $ivaf=$dt_valor-$sub_to;
                      $total_pagar=$dt_valor;
                     ?>
                    <div class="">
                      <div class="col-md-4 content_cajas_cotiza">
                          <label class="form_label" for="subtotal">SUBTOTAL:</label>
                          <input class="form_input input_cotiza" type="text" id="subtotal" name="subtotal" value="<?php echo number_format($sub_to, 2); ?>" readonly required>
                      </div>

                      <div class="col-md-4 content_cajas_cotiza">
                          <label class="form_label" for="iva">IVA:</label>
                          <input class="form_input input_cotiza" type="text" id="iva" name="iva" value="<?php echo number_format($ivaf, 2); ?>" readonly required>
                      </div>
                      <div class="col-md-4 content_cajas_cotiza">
                          <label class="form_label" for="totalp">TOTAL:</label>
                          <input class="form_input input_cotiza" type="text" id="totalp" name="totalp" value="<?php echo number_format($total_pagar, 2); ?>" readonly required>
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
                            <a href="lista_factura_casos.php"> <button type="button"  class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>




            <br><br>


  </div>
</div>


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
