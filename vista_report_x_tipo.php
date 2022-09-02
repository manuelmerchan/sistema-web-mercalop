<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador" >
  <div class="contenedor">
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


                <form class="form3" action="report/reporte_caso_x_tipo.php" target="_blank" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Reporte por Tipo de Caso</h2>
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

                    </div>
                    <div class="row">
                      <div class="col-md-12 content_cajas">
                            <label class="form_label" for="clientes">Tipo de Caso:</label>
                            <select class="form_input custom-select" id="clientes" name="tipocaso" autofocus required><option value="TODOS">-TODOS-</option>
                              <?php $consulta4=mysqli_query($con,"SELECT * from tipo_caso");
                                while($row4=mysqli_fetch_array($consulta4)){
                                echo "<option  value='".$row4['id_tipo_caso']."'>"; echo $row4['descrip_tcj']; echo "</option>"; } ?> </select>
                        </div><br><br><br><br><br>
                      <script>
                        $(function() {
                          $("#clientes").customselect();
                        });
                      </script>


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
