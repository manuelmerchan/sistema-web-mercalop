<?php
include ('config/conexion.php');
include ('cabecera.php');
include ('menu.php');

$id=$_REQUEST['id'];
$consulta=mysqli_query($con,"SELECT * from servicios where id_servicios='$id' ");
$row=mysqli_fetch_array($consulta);
?>
<body style="background-image: url('login/img/juridico7.jpg');"></body>
<div class="container delimitador">
  <div class="contenedor">



                <form class="form3" action="app/modificarServicios.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form_header">
                        <h2 class="form_titulo">Editar Servicio</h2>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="servicios">Servicio:</label>
                          <input class="form_input" type="text" id="servicios" name="servicios" value="<?php echo $row['descrip_s']; ?>" onkeypress="return sololetras(event)" required placeholder="Escriba Servicios" onpaste="return false;">
                      </div>
                      <div class="col-md-12 content_cajas">
                          <label class="form_label" for="valor">Valor:</label>
                          <input class="form_input" type="number" step="0.01"  min="0.01" id="valor" name="valor" value="<?php echo $row['valor']; ?>" placeholder="Escriba Valor" onkeypress="return solonumeros(event)" onpaste="return false;">
                      </div>

                    </div>

                    <br><br>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <input type="submit" class="btn_submit" value="MODIFICAR">
                        </div>
                        <div class="col-md-5">
                            <a href="ingreso_servicios.php"> <button type="button" class="btn_cancel" name="button">CANCELAR</button> </a>
                        </div>
                    </div>
                </form>


                <script>
    // $(document).on('keyup','#nombres', function(){
    //     var valr= $('#nombres').val();
    //     if(valr!=""){
    //        // var texto = MaysPrimera(valr.tolowerCase());
    //        var texto = toTitleCase(valr); // solo la primera palabra esta en mayuscula
    //        // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
    //         document.getElementById('nombres').value=texto;
    //     }
    // });

    $(document).on('change','#servicios', function(){
        var valr= $('#servicios').val();
        if(valr!=""){
           // var texto = MaysPrimera(valr.tolowerCase());
           var texto = MaysPrimera(valr); // solo la primera palabra esta en mayuscula
           // var texto = toTitleCase(valr); // todas las palabras empiezan con mayuscula
           var texto = valr.toUpperCase();// TODO0 MAYUSCULA
            document.getElementById('servicios').value=texto;
        }
    });
    function toTitleCase(str){
    return str.replace(/(?:^|\s)\w/g, function(match){
      return match.toUpperCase();
    });
  }

  function MaysPrimera(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
</script>


            <br><br><br><br><br><br><br>


<?php include ('footer.php'); ?>
