<?php
include('conexion.php');
$datos= $_GET['datos'];
$datosuser = explode("---", $datos);
$usu= $datosuser[0];
$clave= $datosuser[1];

    $sql = "SELECT * FROM clientes where id_estado='1' and cedula='$usu' and clave='$clave' ";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $response= array();
        while ($row = mysqli_fetch_array($result)) {
            // temp user array
             $listado = array();
            $listado["id"] = $row["id_clientes"];
            $listado["nombre"] = $row["nombre"];
            $listado["apellido"] = $row["apellido"];
            // push single product into final response array
           array_push($response, $listado);
        }
        // success
         //$response["-"] = $listado;
        // echoing JSON response
        echo json_encode($response);

    } else {
        $response["message"] = "Usuario o Contraseña estan equivocados";
        // echo no users JSON
        echo json_encode($response);
    }

?>
