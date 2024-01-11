<?php
require('conexion.php');

// Obtener los datos del POST
$id_usuario = $_POST['id_usuario'];
$estado_usuario = $_POST['estado_usuario'];


// Ejecutar la consulta
try {


    // Construye y ejecuta la consulta UPDATE con parámetros
    $stmt = $conn->prepare("UPDATE usuarios
    SET estado_usuario = :estado_usuario
    WHERE Id_usuario = :id_usuario");
    $stmt->bindParam(':estado_usuario', $estado_usuario, PDO::PARAM_STR);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    $registros = $stmt->rowCount();

    if ($registros > 0) {
    echo 'success';
} else {
    echo 'error';
}

} catch (PDOException $e) {
    echo "Error en el servidor: " . $e->getMessage();
}
?>