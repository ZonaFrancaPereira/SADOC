<?php 
include_once("conexion.php");

$id_proceso_fk_3=$_POST["id_proceso_fk_3"];
$fecha_mantenimiento3 =$_POST["fecha_mantenimiento3"];
$Id_usuario_fk3 =$_POST["Id_usuario_fk3"];
$id_cargo_fk3 =$_POST["id_cargo_fk3"];
$articulo =$_POST["articulo"];
$marca_general =$_POST["marca_general"];
$modelo_general =$_POST["modelo_general"];
$serial_general =$_POST["serial_general"];
$partes_externas =$_POST["partes_externas"];
$condiciones_fisicas =$_POST["condiciones_fisicas"];
$cableado_verificar =$_POST["cableado_verificar"];
$dispositivo=$_POST["dispositivo"];
$estado_general=$_POST["estado_general"];

try {
	$stmt = $conn->prepare('INSERT INTO mantenimiento_general(id_general, id_proceso_fk_3, fecha_mantenimiento3, Id_usuario_fk3, id_cargo_fk3, articulo, marca_general, modelo_general, serial_general, partes_externas, condiciones_fisicas, cableado_verificar, dispositivo, estado_general) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $id_general);
	$stmt->bindParam(2, $id_proceso_fk_3);
	$stmt->bindParam(3, $fecha_mantenimiento3);
	$stmt->bindParam(4, $Id_usuario_fk3);
	$stmt->bindParam(5, $id_cargo_fk3);
    $stmt->bindParam(6, $articulo);
    $stmt->bindParam(7, $marca_general);
    $stmt->bindParam(8, $modelo_general);
    $stmt->bindParam(9, $serial_general);
    $stmt->bindParam(10, $partes_externas);
    $stmt->bindParam(11, $condiciones_fisicas);
    $stmt->bindParam(12, $cableado_verificar);
    $stmt->bindParam(13, $dispositivo);
    $stmt->bindParam(14, $estado_general);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}

?>