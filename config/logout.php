<?php
session_start();
//error_reporting(0);

session_unset();
unset($_SESSION['confirmar']);
session_destroy();

// sleep(1);
// $_SESSION['mns_salida']=1;
header("Location:../index.php");
?>
