<?php
include('conexion.php');
$datos= $_GET['datos'];
$datosuser = explode("---", $datos);
$cedula= $datosuser[0];
$correo= $datosuser[1];
$clave= $datosuser[2];
$clave1= $datosuser[3];

    $sql = "SELECT * FROM clientes where id_estado='1' and cedula='$cedula' and correo='$correo' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
      if ($clave==$clave1) {
        $response= array();
        while ($row = mysqli_fetch_array($result)) {
          $id_cli=$row["id_clientes"];
          $modificar=mysqli_query($con,"UPDATE clientes SET clave='$clave1' WHERE id_clientes='$id_cli'") or die ("error".mysqli_error());
            // temp user array
             $listado = array();
            $listado["id"] = 'EXITO';
            // push single product into final response array
           array_push($response, $listado);
        }
        // success
         //$response["-"] = $listado;
        // echoing JSON response
        echo json_encode($response);
      } else {
          $response["message"] = "Las contraseñas no son iguales!!";
          // echo no users JSON
          echo json_encode($response);
      }


    } else {
        $response["message"] = "La información ingresada fue Incorrecta!!";
        // echo no users JSON
        echo json_encode($response);
    }

?>
