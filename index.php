<?php  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><meta charset="euc-jp">
    

  <title>Buro Juridico Mercalop</title>
  <link rel="shortcut icon" href="img/buro.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <link rel="stylesheet" type="text/css" href="login/estilos_login.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>
<body>

  <div class="modal-dialog text-center">
    <div class="col-sm-9 main-section m-t-180">
      <div class="modal-content">

        <div class="col-12 user-img">
          <img src="login/img/face.png">
        </div>

        <div class="col-12 form-input">
          <form class="login-form validate-form" id="formLogin" action="" method="post">
            <div class="form-group">
              <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Contrasena">
            </div>
            <button type="submit" class="btn btn-success">Iniciar sesión</button>
          </form>
        </div>

        <div class="col-12 text-right" style="display: flex; align-items: right; text-align: right; justify-content: right;">
          <a href="#" style="color: #b7b7bc">Inicio</a><p class="m-r-10 m-l-10" style="color: #b7b7bc"> | </p><a href="recuperar_pass.php" style="color: #b7b7bc">Olvido su Contrasena?</a>
        </div>

      </div>
    </div>
  </div>

</body>
<script src="js/sweetalert2.min.js"></script>
<script src="codigo.js"></script>
</html>


