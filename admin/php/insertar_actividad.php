<?php 
include_once("conexion.php");

$fecha_actividad=$_POST["fecha_actividad"];
$descripcion_actividad=$_POST["descripcion_actividad"];
$estado_actividad=$_POST["estado_actividad"];
$id_usuario=$_POST["id_usuario_fk"];
$id_acpm=$_POST["id_acpm_fk"];

try {
	$stmt = $conn->prepare('INSERT INTO actividades_acpm(fecha_actividad, descripcion_actividad, estado_actividad, id_usuario_fk, id_acpm_fk) VALUES(?,?,?,?,?)');
	$stmt->bindParam(1, $fecha_actividad);
	$stmt->bindParam(2, $descripcion_actividad);
	$stmt->bindParam(3, $estado_actividad);
	$stmt->bindParam(4, $id_usuario);
	$stmt->bindParam(5, $id_acpm);

	if ($stmt->execute()){
		echo "1";
	}else{
		echo "ERROR";
	}
} catch(PDOException $e){
	echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
}

?>