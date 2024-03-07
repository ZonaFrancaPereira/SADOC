<?php
include_once("conexion.php");

$id_acpm_fk1 = $_POST["id_acpm_fk1"];
$fecha_modificar = $_POST["fecha_modificar"];

try {
    $stmt = $conn->prepare("UPDATE acpm SET fecha_finalizacion = ? WHERE id_consecutivo = ?");
    $stmt->bindParam(1, $fecha_modificar);
    $stmt->bindParam(2, $id_acpm_fk1);
    
    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
?>
