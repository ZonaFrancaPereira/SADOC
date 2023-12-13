<?php
include_once("conexion.php");

// Obtener datos del formulario
$estado_acpm = "Rechazada";
$descripcion_rechazo_sig = $_POST['descripcion_rechazo_sig'];
$id_acpm_fk_sig = $_POST['id_acpm_fk_sig'];

try {
    $stmt = $conn->prepare('INSERT INTO acpm_rechazada(fecha_rechazo, descripcion_rechazo, id_acpm_fk) VALUES(NOW(), ?, ?)');
    $stmt->bindParam(1, $descripcion_rechazo_sig); // Agregué el tipo de dato
    $stmt->bindParam(2, $id_acpm_fk_sig); // Agregué el tipo de dato

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
?>