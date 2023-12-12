<?php 
include_once("conexion.php");

// Obtener datos del formulario
$riesgo_acpm = $_POST['riesgo_acpm'];
$justificacion_riesgo = $_POST['justificacion_riesgo'];
$cambios_sig = $_POST['cambios_sig'];
$justificacion_sig = $_POST['justificacion_sig'];
$conforme_sig = $_POST['conforme_sig'];
$justificacion_conforme_sig = $_POST['justificacion_conforme_sig'];
$fecha_estado = $_POST['fecha_estado'];

try {
	$stmt = $conn->prepare('INSERT INTO acpm (riesgo_acpm, justificacion_riesgo, cambios_sig, justificacion_sig, conforme_sig, justificacion_conforme_sig, fecha_estado) VALUES(?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $riesgo_acpm);
	$stmt->bindParam(2, $justificacion_riesgo);
	$stmt->bindParam(3, $cambios_sig);
	$stmt->bindParam(4, $justificacion_sig);
	$stmt->bindParam(5, $conforme_sig);
    $stmt->bindParam(6, $justificacion_conforme_sig);
    $stmt->bindParam(7, $fecha_estado);

	if ($stmt->execute()){
		echo "1";
	}else{
		echo "ERROR";
	}
} catch(PDOException $e){
	echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
}

?>