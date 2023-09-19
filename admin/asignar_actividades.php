<?php

$conn = new mysqli('localhost', 'root','','upload');

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener los datos del formulario 
$fecha_actividad = trim($_POST["fecha_actividad"]);
$descripcion_actividad = trim($_POST["descripcion_actividad"]);
$estado_actividad = trim($_POST["estado_actividad"]);
$id_usuario = trim($_POST["id_usuario"]);
$id_acpm = trim($_POST["id_acpm"]);

// Insertar datos en la tabla
$sql = "INSERT INTO actividades_acpm(fecha_actividad, descripcion_actividad, estado_actividad, id_usuario_fk, id_acpm_fk) VALUES ('$fecha_actividad', ' $descripcion_actividad', '$estado_actividad' , '$id_usuario','$id_acpm')";

if ($conn->query($sql) === TRUE) {
    echo "Datos insertados con éxito.";
} else {
    echo "Error al insertar datos: " . $conn->error;
}
// Cerrar la conexión
$conn->close();
?>