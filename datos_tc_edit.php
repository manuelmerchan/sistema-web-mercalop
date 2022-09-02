<?php
include('config/conexion.php');
$tc=$_POST['tc'];
$dtc3=$_POST['dtc'];
$sql="SELECT * from detalle_tipo_caso where id_tipo_caso='$tc' order by descrip_dtc ASC";

$result=mysqli_query($con,$sql);

$cadena="<script> $(function() { $('#selectdetalletc').customselect(); }); </script>  <label class='form_label' for='detalletc'>Detalle Tipo de Caso:</label> <select class='form_input custom-select' id='selectdetalletc' name='detalletc'>";

	while ($ver=mysqli_fetch_array($result)) {
    if($dtc3==$ver['id_detalle_tipo_caso']){$sel="selected='selected'";}else{$sel="";}
		$cadena=$cadena.'<option '.$sel.' value='.$ver['id_detalle_tipo_caso'].'>'.utf8_encode($ver['descrip_dtc']).'</option>';
	}

echo  $cadena."</select>";
?>
