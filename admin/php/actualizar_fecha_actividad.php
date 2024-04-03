<?php
include_once("conexion.php");

$id_actividad = $_POST["id_actividad"];
$fecha_modificar_actividad = $_POST["fecha_modificar_actividad"];

try {
    $stmt = $conn->prepare("UPDATE actividades_acpm SET fecha_actividad = ? WHERE id_actividad = ?");
    $stmt->bindParam(1, $fecha_modificar_actividad);
    $stmt->bindParam(2, $id_actividad);
    
    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
?>