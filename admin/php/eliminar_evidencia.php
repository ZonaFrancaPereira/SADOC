<?php
// Incluye el archivo de conexión
include_once("conexion.php");

// Verifica si se ha enviado la solicitud para eliminar evidencia
if (isset($_POST['eliminar_evidencia'])) {
    // Obtiene el ID de la evidencia desde la solicitud POST
    $id_evidencia_eliminar = $_POST['id_evidencia_eliminar'];

    try {
        // Consulta de eliminación
        $sql = "DELETE FROM detalle_actividad
                WHERE id_detalle_acpm = ?";

        // Prepara la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_evidencia_eliminar);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "1"; // Éxito: devuelve 1
        } 
    } catch (PDOException $e) {
        $conn->rollBack();
    echo "ERROR: " . $e->getMessage();
    }
}

// No es necesario cerrar la conexión en PDO, se maneja automáticamente
?>