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
$consulta2=mysqli_query($con,"SELECT * FROM empleados E INNER JOIN usuarios U ON E.id_empleados=U.id_empleados WHERE E.id_empleados='$idrecup'");
$row2=mysqli_fetch_array($consulta2);
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
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
		          
	        </div>

	        <div class="camino">
	          	<div class="camino_cuerpo">

	            	<div class="camino_cuerpo_opcion">
	            		<a href="inicio.php"><i class="fas fa-home"></i>Inicio</a>
	            	</div>
		            
	          	</div>
	        </div>
	    </div>

        <br><br>
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
