<?php 
include_once("conexion.php");
session_start();
// Obtener datos del formulario
$id_activo_fk = $_POST['id_activoa_fk'];
$id_usuario_fk = $_POST['id_usuario_fk'];
$fecha_asignacion = $_POST['fecha_asignacion'];
$observaciones_asignacion = $_POST['observaciones_asignacion'];
//PERSONA DE TI QUE REALIZA LA ASIGNACION
$id_ti_fk = $_SESSION['Id'];
$estado_asignacion="Activa";

try {
    // Preparar la consulta de inserción
    $stmt = $conn->prepare('INSERT INTO asignacion_equipos ( fecha_asignacion,
    estado_asignacion,
    observaciones_asignacion,
    id_ti_fk,
    id_usuario_fk) VALUES (?, ?, ?, ?, ?)');
    // Vincular los parámetros
    $stmt->bindParam(1, $fecha_asignacion);
    $stmt->bindParam(2, $estado_asignacion);
    $stmt->bindParam(3, $observaciones_asignacion);
    $stmt->bindParam(4, $id_ti_fk);
    $stmt->bindParam(5, $id_usuario_fk);
 
   
    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "1"; // Éxito
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error de PDO: " . $e->getMessage();
}

   

?>
