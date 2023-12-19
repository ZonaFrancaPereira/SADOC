<?php
require('php/conexion.php');

// Obtener el id_actividad desde la solicitud (puedes usar $_POST o $_GET según tu método)
$id_actividad = $_POST['id_actividad'];

// Consulta de actualización
$sql = "UPDATE actividades_acpm
        SET estado = 'completo'
        WHERE id_actividad = $id_actividad
        AND EXISTS (
            SELECT 1
            FROM evidencias
            WHERE id_actividad = $id_actividad
        )";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Estado actualizado correctamente";
} else {
    echo "Error al actualizar el estado: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>