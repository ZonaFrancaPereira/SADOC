<?php 
include_once("conexion.php");

$fecha_evidencia=$_POST["fecha_evidencia"];
$evidencia=$_POST["evidencia"];
$contenidoSinParrafos = strip_tags($evidencia, '<a><b><strong><i><em><u><s><strike><code>');

$recursos=$_POST["recursos"];
$id_actividad_fk=$_POST["id_actividad_fk"];
$id_usuario_e_fk=$_POST["id_usuario_e_fk"];

try {
	$stmt = $conn->prepare('INSERT INTO detalle_actividad(fecha_evidencia, evidencia, recursos, id_actividad_fk, id_usuario_e_fk) VALUES(?,?,?,?,?)');
	$stmt->bindParam(1, $fecha_evidencia);
	$stmt->bindParam(2, $contenidoSinParrafos);
	$stmt->bindParam(3, $recursos);
	$stmt->bindParam(4, $id_actividad_fk);
	$stmt->bindParam(5, $id_usuario_e_fk);

	if ($stmt->execute()){
		echo "1";
	}else{
		echo "ERROR";
	}
} catch(PDOException $e){
	echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
}

?>