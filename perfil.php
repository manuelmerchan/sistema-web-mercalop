<?php
include('config/conexion.php');
include('cabecera.php');
include('menu.php');

$ide=$_SESSION['ID_EMPLE'];
//$ide=1;
$consulta=mysqli_query($con,"SELECT * FROM empleados E WHERE E.cedula='$ide'");
$row=mysqli_fetch_array($consulta);
$nombres=$row['nombres']." ".$row['apellidos'];
$idrecup=$row['id_empleados'];
$consulta2=mysqli_query($con,"SELECT * FROM empleados E INNER JOIN usuarios U ON E.cedula=U.id_empleados WHERE E.id_empleados='$idrecup'");
$row2=mysqli_fetch_array($consulta2);
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
    <div class="contenedor pag_inicio">

    	<div class="ccf_cabecera_pantalla">
	        <div class="ccfcp_contenedor_titulo">
	          	<div class="ccfcp_ct_icono">
	            	<i class="fas fa-user-tie" style="color: #000"></i>
	          	</div>
	          	<div class="ccfcp_ct_titulo">
	            	<h2 style="color: #000">Bienvenido </h2>
	          	</div>
	          	<div class="ccfcp_ct_titulo2">
	            	<p style="color: #000"><?php echo $nombres; ?></p>
	          	</div>
		          <!-- <div class="ccfcp_ct_boton">
		            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#contenido_mostrar" aria-expanded="false" aria-controls="collapseExample">Agregar Empleado <i class="fas fa-angle-down"></i></button>
		          </div> -->
	        </div>

	        <div class="camino">
	          	<div class="camino_cuerpo">

	            	<div class="camino_cuerpo_opcion">
	            		<a href="inicio.php"><i class="fas fa-home"></i>Inicio</a>
	            	</div>
		            <!-- <i class="fas fa-angle-right"></i>
		            <div class="camino_cuerpo_opcion active_camino">
		              <a href="ingreso_empleado.php">Ingresar Empleado</a>
		            </div> -->
	          	</div>
	        </div>
	    </div>

        <br><br>

        <div class="form2">
        	<form class="m-t-20" action="app/guardarDatosEmpIndex.php" method="POST" enctype="multipart/form-data">
        		<div class="row">
                    <div class="col-md-6" style="">
                    	<label class="form_label" for="foto">Cambiar Foto:</label>
                    	<div style="display:flex; justify-content: center; align-items: center; background: rgba(255,255,255,.5); border-radius: 3px; margin-top: 7px;">
                    		<img src="<?php echo $row['foto']; ?>" width="250" height="280">
                    	</div>
                    	<input type="text" name="fotoguardada" value="<?php echo $row['foto']; ?>" style="display: none;">
                    	<input type="text" name="idemp" value="<?php echo $idrecup; ?>" style="display: none;">
                    	<input class="form_input" type="file" id="foto" name="foto" accept="image/jpeg">
                    </div>

                    <div class="col-md-6 content_cajas">
                        <label class="form_label" for="correo">Correo:</label>
                        <input class="form_input" type="text" id="correo" name="correo" placeholder="Escriba su nombre" value="<?php echo $row['correo']; ?>">
                    </div>
                    <div class="col-md-6 content_cajas">
                        <label class="form_label" for="telefono">Telefono:</label>
                        <input class="form_input" type="text" id="telefono" name="telefono" placeholder="Escriba su Telefono" value="<?php echo $row['telefono']; ?>">
                    </div>
                    <div class="col-md-6 content_cajas">
                        <label class="form_label" for="direccion">Direccion:</label>
                        <input class="form_input" type="text" id="direccion" name="direccion" placeholder="Escriba su nombre" value="<?php echo $row['direccion']; ?>">
                    </div>
                    <div class="col-md-6 content_cajas">
                        <label class="form_label" for="clave">Clave:</label>
                        <input class="form_input" type="password" id="clave" name="clave" placeholder="Escriba su nombre" value="<?php echo $row2['clave']; ?>">
                    </div>
                </div>

                <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            <input type="submit" class="btn_submit" value="GUARDAR CAMBIOS">
                        </div>
                    </div>
        	</form>
        </div>

	    <!-- <div class="collapse formulario_normal" id="contenido_mostrar">
	    	<p>holi</p>
	    </div> -->
    </div>
</div>
<br><br><br>
<?php include ('footer.php'); ?>

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
