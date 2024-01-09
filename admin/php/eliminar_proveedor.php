<?php
// Incluye el archivo de conexión
include_once("conexion.php");


    // Obtiene el ID de la actividad desde la solicitud POST
    $id_proveedor = $_POST['id_proveedor'];

    try {
        // Consulta de eliminación
        $sql = "DELETE FROM proveedor_compras
                WHERE id_proveedor = ?";

        // Prepara la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_proveedor);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "success"; // Éxito: devuelve 1
        } 
    } catch (PDOException $e) {
        $conn->rollBack();
        echo "ERROR: " . $e->getMessage();
    }


// No es necesario cerrar la conexión en PDO, se maneja automáticamente
?>