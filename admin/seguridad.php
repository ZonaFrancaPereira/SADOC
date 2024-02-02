<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
if ($_SESSION['ingreso'] == true) {
    require('php/conexion.php');
    require('plantilla.php');
    require 'qr/barcode.php';
    $generator = new barcode_generator();
    header('Content-Type: image/svg+xml');

  }else{
    session_unset();
      session_destroy();
      header('location: ../index.php');
  }
?>