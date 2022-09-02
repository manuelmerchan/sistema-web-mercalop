<?php
session_start();
if(isset($_SESSION['ID_EMPLE'])){
  if($_SESSION['ID_EMPLE']==""){
     header("Location:index.php");
   }else{
     if ($_SESSION['TIPO_EMPLE']=='13' ) {
       $sesion_id_emple=$_SESSION['ID_EMPLE'];
       // $query_sesion="AND CJ.id_empleados='$sesion_id_emple' OR CL.id_estado='1' and CJ.id_estado!='2' AND CJ.id_abg_ayudante='$sesion_id_emple' ";
       $query_sesion="AND CJ.id_abg_ayudante='$sesion_id_emple'";

     }else{
       $query_sesion="";
       $sesion_id_emple="";
     }
   }
}else{ header("Location:index.php"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mercalop</title>

    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/icomoon.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/805c37e370.js" crossorigin="anonymous"></script>

    <link href="css/util.css" rel="stylesheet">

    <link href="css/misestilos.css" rel="stylesheet">
    <link href="css/jquery.dataTables.min.css" rel="stylesheet">
      <script src="js/jquery.js"></script>
      <script src="js/sweetalert2.min.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="img/buro.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>

<!--/head-->
