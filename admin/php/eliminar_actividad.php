<?php
// Incluye el archivo de conexión
include_once("conexion.php");

// Verifica si se ha enviado la solicitud para eliminar actividad
if (isset($_POST['eliminar_actividad'])) {
    // Obtiene el ID de la actividad desde la solicitud POST
    $id_actividad_eliminar = $_POST['id_actividad_eliminar'];

    try {
        // Consulta de eliminación
        $sql = "DELETE FROM actividades_acpm
                WHERE id_actividad = ?";

        // Prepara la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_actividad_eliminar);

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