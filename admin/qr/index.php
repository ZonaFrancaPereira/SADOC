<?php 
require 'barcode.php';
$generator = new barcode_generator();
header('Content-Type: image/svg+xml');
//ciclo
$svg = $generator->render_svg("qr", "https://www.google.com","");

echo $svg;
?>