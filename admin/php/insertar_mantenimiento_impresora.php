<?php 
include_once("conexion.php");

$id_proceso_fk_2=$_POST["id_proceso_fk_2"];
$fecha_mantenimiento_impresora=$_POST["fecha_mantenimiento_impresora"];
$Id_usuario_fk2=$_POST["Id_usuario_fk2"];
$id_cargo_fk2=$_POST["id_cargo_fk2"];
$nombre_impresora=$_POST["nombre_impresora"];
$marca_impresora=$_POST["marca_impresora"];
$modelo_impresora=$_POST["modelo_impresora"];
$serial_impresora=$_POST["serial_impresora"];
$soplar_exterior=$_POST["soplar_exterior"];
$isopropilico=$_POST["isopropilico"];
$toner=$_POST["toner"];
$alinear=$_POST["alinear"];
$verificar_cableado=$_POST["verificar_cableado"];
$rodillos=$_POST["rodillos"];
$reemplazar=$_POST["reemplazar"];
$limpiar=$_POST["limpiar"];
$imprimir=$_POST["imprimir"];
$verificar=$_POST["verificar"];
$estado_mantenimiento_impresora=$_POST["estado_mantenimiento_impresora"];

try {
	$stmt = $conn->prepare('INSERT INTO mantenimiento_impresora(id_impresora, id_proceso_fk_2, fecha_mantenimiento_impresora, Id_usuario_fk2, id_cargo_fk2, nombre_impresora, marca_impresora, modelo_impresora, serial_impresora, soplar_exterior, isopropilico, toner, alinear, verificar_cableado, rodillos, reemplazar, limpiar, imprimir, verificar, estado_mantenimiento_impresora) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $id_impresora);
	$stmt->bindParam(2, $id_proceso_fk_2);
	$stmt->bindParam(3, $fecha_mantenimiento_impresora);
	$stmt->bindParam(4, $Id_usuario_fk2);
	$stmt->bindParam(5, $id_cargo_fk2);
    $stmt->bindParam(6, $nombre_impresora);
    $stmt->bindParam(7, $marca_impresora);
    $stmt->bindParam(8, $modelo_impresora);
    $stmt->bindParam(9, $serial_impresora);
    $stmt->bindParam(10, $soplar_exterior);
    $stmt->bindParam(11, $isopropilico);
    $stmt->bindParam(12, $toner);
    $stmt->bindParam(13, $alinear);
    $stmt->bindParam(14, $verificar_cableado);
    $stmt->bindParam(15, $rodillos);
    $stmt->bindParam(16, $reemplazar);
    $stmt->bindParam(17, $limpiar);
    $stmt->bindParam(18, $imprimir);
    $stmt->bindParam(19, $verificar);
    $stmt->bindParam(20, $estado_mantenimiento_impresora);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}

?>