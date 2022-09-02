<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="report/reporte_empleados.php" target="_blank" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Reporte de Empleados</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="genero">Fecha Inicio:</label>
                          <input class="form_input" type="date" id="fecha_ini" name="fecha_ini" onchange="validar_fecha1()" required>
                      </div>
                      <div class="col-md-6 content_cajas">
                          <label class="form_label" for="genero">Fecha Fin:</label>
                          <input class="form_input" type="date" id="fecha_fin" name="fecha_fin" onblur="validar_fecha2()" required>
                      </div>

                      <div class="col-md-7 content_cajas">
                          <label class="form_label" for="genero">Estado:</label>
                          <select class="form_input" name="estado" id="estado" required>
                            <option value="todos">-SELECCIONE-</option>
                            <option value="activos">ACTIVOS</option>
                            <option value="inactivos">INACTIVOS</option>
                            <option value="todos">TODOS</option>
                          </select>
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="GENERAR">
                        </div>
                        <div class="col-md-5">
                            <a href="inicio.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


            <br><br>

            <!-- TABLA -->


            <script type="text/javascript">
              function validar_fecha1() {
                var fecha = new Date();
                var dd = fecha.getDate();
                var mm = fecha.getMonth()+1;
                var yyyy = fecha.getFullYear();
                if(dd<10){ dd='0'+dd; }
                if(mm<10){ mm='0'+mm; }
                fecha_actual=yyyy+'-'+mm+'-'+dd;
                var fecha_ini=document.getElementById('fecha_ini').value;

                if (fecha_ini>fecha_actual) {
                  Swal.fire("Fecha Incorrecta");
                  document.getElementById('fecha_ini').value="";

                }
              }

              function validar_fecha2() {

                var fecha_ini=document.getElementById('fecha_ini').value;
                var fecha_fin=document.getElementById('fecha_fin').value;

                if (fecha_fin<fecha_ini) {
                  Swal.fire("Fecha Incorrecta");
                  document.getElementById('fecha_fin').value="";

                }
              }
            </script>



  </div>
</div>

<?php include ('footer.php'); ?>
