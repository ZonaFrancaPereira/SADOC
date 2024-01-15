<?php
include_once("conexion.php");

$correo_usuario2 = $_POST['correo_usuario2'];
$contrasena_usuario2 = $_POST['contrasena_usuario2'];
$nombre_usuario2 = $_POST['nombre_usuario2'];
$apellidos_usuario2 = $_POST['apellidos_usuario2'];
$estado_usuario_nuevo = $_POST['estado_usuario_nuevo'];
$proceso_usuario_fk2 = $_POST['proceso_usuario_fk2'];
$id_cargo_fk2 = $_POST['id_cargo_fk2'];
$tipo_usuario_fk2 = $_POST['tipo_usuario_fk2'];

// Hashea la contraseña antes de almacenarla en la base de datos
$hash_contrasena = password_hash($contrasena_usuario2, PASSWORD_BCRYPT);

try {
    $stmt = $conn->prepare('INSERT INTO usuarios (correo_usuario, contrasena_usuario, nombre_usuario, apellidos_usuario, estado_usuario, proceso_usuario_fk, id_cargo_fk, tipo_usuario_fk) VALUES(?,?,?,?,?,?,?,?)');
    $stmt->bindParam(1, $correo_usuario2);
    $stmt->bindParam(2, $hash_contrasena); // Almacena el hash en lugar de la contraseña en texto claro
    $stmt->bindParam(3, $nombre_usuario2);
    $stmt->bindParam(4, $apellidos_usuario2);
    $stmt->bindParam(5, $estado_usuario_nuevo);
    $stmt->bindParam(6, $proceso_usuario_fk2);
    $stmt->bindParam(7, $id_cargo_fk2);
    $stmt->bindParam(8, $tipo_usuario_fk2);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
?>