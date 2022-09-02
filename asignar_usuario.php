<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];

$consulta="SELECT * FROM empleados WHERE id_empleados='$id'";
$ejec=mysqli_query($con,$consulta);
$row=mysqli_fetch_array($ejec);
$idte=$row['id_tipo_empleado'];
$nombre = $row["nombres"]." ".$row["apellidos"];
$id=$row['cedula'];

$consulta2="SELECT * FROM usuarios U INNER JOIN empleados E ON U.id_empleados=E.cedula WHERE U.id_empleados='$id'";
$ejec2=mysqli_query($con,$consulta2);
$numrow=mysqli_num_rows($ejec2);

if ($numrow!=0) {
  $abc=true;
  $row2=mysqli_fetch_array($ejec2);
  if ($row2['clave']!='') {
    $claveob=$row2['clave'];
    $usuob=$row2['usuario'];

    $configuracion= $row2["configuracion"];
    $registrar= $row2["registrar"];
    $cotizacion= $row2["cotizacion"];
    $juridico= $row2["caso_juridico"];
    $cuentas= $row2["cuentas"];
    $facturas= $row2["facturas"];
    $reportes= $row2["reportes"];

  }else{
    $usuob=$row['cedula'];
    $claveob="";
  }
}else{
  $abc=false;
  $usuob=$row['cedula'];
  $claveob="";

  $configuracion= "";
  $registrar= "";
  $cotizacion= "";
  $juridico= "";
  $cuentas= "";
  $facturas= "";
  $reportes= "";
}
?>
<body>

<?php if ($abc==true) { ?>
<script>
 Swal.fire( "El empleado ya tiene un usuario y contraseña asignado" );
 //alert("El empleado ya tiene un usuario y contraseña asignado");
</script>
<?php } unset($_SESSION['exis']); ?>

<div class="container delimitador">
  <div class="contenedor">

<style media="screen">
.amoldarcheck{
      height: 50px;
      margin-bottom: 0px;
      border:1px solid #c59765;
      padding-top:5px;
    }
</style>

                <form class="form" action="app/guardarUsuario.php?id=<?php echo $id."&idte=".$idte; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">ASIGNAR USUARIOS</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="Usuario">Empleado:</label>
                          <input class="form_input" type="text" id="" name="" value="<?php echo $nombre; ?>" readonly>
                      </div>
                      <div class="col-md-6 content_cajas">
                      </div>
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="Usuario">Usuario:</label>
                          <input class="form_input" type="text" id="usuario" name="usuario" value="<?php echo $usuob; ?>" placeholder="Escriba su Usuario">
                      </div>
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="cedula">Contraseña:</label>
                          <input class="form_input" type="text" id="clave" name="clave" value="<?php echo  $claveob; ?>" maxlength="8" placeholder="Escriba su Contraseña" required>
                      </div>
                      <div  class="col-md-12" style="width:100%; height:2px; border: 1px solid #b6b6b6; margin: 10px 0px;" >
                      </div>

                      <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" title="Configuración" style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="fas fa-cogs"></i> </span>
                        <input type="checkbox" name="configuracion" id="configuracion" class="checked" value="1" <?php if($configuracion!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="configuracion" >Configuración</label>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" title="Cotización" style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="fas fa-search-dollar"></i></span>
                        <input type="checkbox" name="cotizacion" id="cotizacion" class="checked" value="1" <?php  if($cotizacion!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="cotizacion" >Cotización</label>
                      </div>
                      </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" title="Registrar" style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="fas fa-users"></i></span>
                        <input type="checkbox" name="registrar" id="registrar" class="checked" value="1" <?php  if($registrar!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="registrar" >Registrar </label>
                        </div>
                        </div>
                      <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon" title="Casos Judiciales " style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="fas fa-balance-scale"></i></i></span>
                      <input type="checkbox" name="judiciales" id="judiciales" class="checked" value="1" <?php if($juridico!=""){ echo 'checked';} ?> >
                      <label class="labelt amoldarcheck" for="judiciales" >Casos Judiciales  </label>
                      </div>
                      </div>


                      </div>

                      <div class="col-md-6">

                      <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon" title="Cuentas x Cobrar" style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="fas fa-hand-holding-usd"></i></span>
                      <input type="checkbox" name="cuentas" id="cuentas" class="checked" value="1" <?php if($cuentas!=""){ echo 'checked';} ?> >
                      <label class="labelt amoldarcheck" for="cuentas" >Cuentas x Cobrar</label>
                      </div>
                      </div>
                      <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon" title="Reportes" style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="far fa-file-pdf "></i></span>
                      <input type="checkbox" name="reportes" id="reportes" class="checked" value="1" <?php if($reportes!=""){ echo 'checked';} ?> >
                      <label class="labelt amoldarcheck" for="reportes" >Reportes </label>
                      </div>
                      </div>
                      </div>

                      <div class="col-md-6">

                        <div class="form-group">
                        <div class="input-group">
                        <span class="input-group-addon" title="Facturas" style="background:#2d2d2d; color:#eeeeee; border-color:#c59765;"><i class="fas fa-cash-register"></i></span>
                        <input type="checkbox" name="facturas" id="facturas" class="checked" value="1" <?php  if($facturas!=""){ echo 'checked';} ?> >
                        <label class="labelt amoldarcheck" for="facturas" >Facturas</label>
                        </div>
                        </div>

                      <div class="form-group">

                      </div>

                      </div>


                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                          <?php if ($abc==true) { ?>
                            <input type="submit" class="btn_submit" value="MODIFICAR">
                          <?php }else{ ?>
                            <input type="submit" class="btn_submit" value="GUARDAR">
                          <?php } ?>
                        </div>
                        <div class="col-md-3">
                            <a href="buscar_empleados.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>
<br><br><br>

  </div>
</div>


<?php include ('footer.php'); ?>
