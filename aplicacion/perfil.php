<?php
   session_start();
   include('conexion.php');
   $id=$_REQUEST['id'];

   $consult=mysqli_query($con,"SELECT * from clientes where id_clientes='$id' ");
   $row=mysqli_fetch_array($consult);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="jquery.js"></script>
    <script src="sweetalert2.min.js"></script>
</head>

<body>
    <!--======================================
=            Apock web design            =
=======================================
Gracias por utilizar mi contenido!
Me siento agradecido compartiendo para Uds
No olvides seguirme en:
ðŸ‘‰ Instagram - https://www.instagram.com/ApockGraficos
ðŸ‘‰ Twitter - https://twitter.com/ApockGraficos
ðŸ‘‰ Faccobook - https://www.facebook.com/ApockGraficos
====-->

<style type="text/css">
/*=====================================
reset estilos
no es necesario que copies esto
=====================================*/

html {
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    text-size-adjust: 100%;
    line-height: 1.4;
}
* {
    margin: 0;
    padding: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
body {
	background:#f0f0f0;

  color: #404040;
  font-family: "Arial", Segoe UI, Tahoma, sans-serifl, Helvetica Neue, Helvetica;
}

/*=====================================
estilos de la utilidad
Copiar esto
=====================================*/
.seccion-perfil-usuario .perfil-usuario-body,
.seccion-perfil-usuario {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
}

.seccion-perfil-usuario .perfil-usuario-header {
    width: 100%;
    display: flex;
    justify-content: center;
    background: transparent;
    /* background: linear-gradient(#B873FF, transparent); */
    margin-bottom: 0.7rem;
}

.seccion-perfil-usuario .perfil-usuario-portada {
    display: block;
    position: relative;
    width: 90%;
    height: 8rem;
    background: linear-gradient(45deg, #ffbd28, #1c1e21);
    border-radius: 0 0 20px 20px;
}


.seccion-perfil-usuario .perfil-usuario-avatar {
    display: flex;
    width: 150px;
    height: 150px;
    align-items: center;
    justify-content: center;
    border: 7px solid #FFFFFF;
    background-color: #DFE5F2;
    border-radius: 50%;
    box-shadow: 0 0 12px rgba(0, 0, 0, .2);
    position: absolute;
    bottom: -40px;
    left: calc(50% - 75px);
    z-index: 1;
}

.seccion-perfil-usuario .perfil-usuario-avatar img {
    width: 100%;
    position: relative;
    border-radius: 50%;
}


.seccion-perfil-usuario .perfil-usuario-body {
    width: 70%;
    position: relative;
    max-width: 750px;
}

.seccion-perfil-usuario .perfil-usuario-body .titulo {
    display: block;
    width: 100%;
    font-size: 1.75em;
    margin-bottom: 0.5rem;
}

.seccion-perfil-usuario .perfil-usuario-body .texto {
    color: #848484;
    font-size: 0.95em;
}

.seccion-perfil-usuario .perfil-usuario-footer,
.seccion-perfil-usuario .perfil-usuario-bio {
    display: flex;
    flex-wrap: wrap;
    padding: 1.5rem 2rem;
    box-shadow: 0 0 12px rgba(0, 0, 0, .2);
    background-color: #7c6124;
    border-radius: 15px;
    width: 100%;
    color:#f4f4f4;
}
.seccion-perfil-usuario .perfil-usuario-footer{
  margin-bottom: 5px;
}
.seccion-perfil-usuario .perfil-usuario-bio {
    margin-bottom: 0.7rem;
    text-align: center;
}
.perfil-usuario-bio .titulo {
    margin-top: 10px;
}
.seccion-perfil-usuario .lista-datos {
    width: 50%;
    list-style: none;
}

.seccion-perfil-usuario .lista-datos li {
    padding: 5px 0;
}

.seccion-perfil-usuario .lista-datos li>.icono {
    margin-right: 1rem;
    font-size: 1.2rem;
    vertical-align: middle;
}

/* adactacion a dispositivos */
@media (max-width: 750px) {
    .seccion-perfil-usuario .lista-datos {
        width: 100%;
    }
    .seccion-perfil-usuario .perfil-usuario-portada,
    .seccion-perfil-usuario .perfil-usuario-body {
        width: 95%;
    }
}

.formu_perfil{
  width: 100%;
  height: auto;
  margin-top:20px;
}
.formu_perfil .cajas{
  width: 100%;
  height: 40px;
  border: 0;
  border-bottom: 2px solid rgb(34, 34, 34);
  background: transparent;
  color:#f2f2f2;
  margin-bottom: 10px;
  font-family: serif;
  font-size: 22px;
  padding: 0px 10px;
}
.formu_perfil .cajas:focus{
  border-bottom: 2px solid rgb(237, 235, 19);
}

.formu_perfil .btn{
  width: 100%;
  height: 40px;
  border-radius: 10px;
  border: 1px solid rgb(236, 234, 0);
  background: linear-gradient(45deg, #ffbd28, #1c1e21);
  color:#f2f2f2;
  -webkit-box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
  -moz-box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
  box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
  margin-bottom: 10px;
  font-family: serif;
  font-size: 24px;
  padding: 0px 10px;
  margin-top: 10px;

}

</style>
    <!--==========================
=            html            =
===========================-->

<?php

	?>

    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="img/perfil_cliente.png" alt="img-avatar">

                </div>

            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $row['nombres']." ".$row['apellidos']; ?></h3>
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-signs"></i> <?php echo $row['direccion']; ?></li>
                    <li><i class="icono far fa-envelope fa-2x"></i> <?php echo $row['correo']; ?></li>
                    <li><i class="icono fas fa-phone-alt"></i> <?php echo $row['telefono']; ?></li>
                </ul>
                <ul class="lista-datos"><br>
                  <h3><i class="fas fa-unlock-alt"></i> Cambiar Contraseña</h3>
                  <form class="formu_perfil" action="cambio_clave_app.php?id=<?php echo $id; ?>" method="post">
                    <input type="password" name="clave" class="cajas" value="" placeholder="Nueva Contraseña" maxlength="10">
                    <input type="password" name="clave2" class="cajas" value="" placeholder="Repite Nueva Contraseña" maxlength="10">
                    <input type="submit" class="btn" name="" value="Cambiar Contraseña">
                  </form>
                </ul>
            </div>

        </div>
    </section>
    <!--====  End of html  ====-->

<!--=============================
redes sociales fijadas en pantalla
No es necesario que copies esto!
==============================-->
<style>
.mensaje a {
    color: inherit;
    margin-right: .5rem;
    display: inline-block;
}
.mensaje a:hover {
    color: #309B76;
    transform: scale(1.4)
}
</style>

<!--====  End of tarjeta  ====-->


<?php if (isset($_SESSION['confirmar'])) {
  if ($_SESSION['confirmar']==1){ ?>
<script>
function ejecutarEjemplo(){
  Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Cambio Exitoso!!',
    showConfirmButton: false,
    timer: 1500
  })
}
ejecutarEjemplo();
</script>
<?php $_SESSION['confirmar']=0; } } ?>

</html>
