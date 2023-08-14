<?php 
include_once("conexion.php");
$origen_acpm=$_POST["origen_acpm"];
$fuente_acpm=$_POST["fuente_acpm"];
$descripcion_fuente=$_POST["descripcion_fuente"];
$tipo_acpm=$_POST["tipo_acpm"];
$descripcion_acpm=$_POST["descripcion_acpm"];
$causa_acpm=$_POST["causa_acpm"];
$nc_similar=$_POST["nc_similar"];
$descripcion_nsc=$_POST["descripcion_nsc"];
$correccion_acpm=$_POST["correccion_acpm"];
$fecha_correccion=$_POST["fecha_correccion"];
$estado_acpm="Abierta";
$riesgo_acpm=$_POST["riesgo_acpm"];
$justificacion_riesgo=$_POST["justificacion_riesgo"];
$fecha_estado=date("Y-m-d");
$fecha_finalizacion=$_POST["fecha_finalizacion"];
$id_usuario_fk=$_POST["id_usuario_fk"];


try {
	$stmt = $conn->prepare('INSERT INTO acpm(origen_acpm,fuente_acpm,descripcion_fuente,tipo_acpm,descripcion_acpm,causa_acpm, nc_similar,descripcion_nsc,correccion_acpm,fecha_correccion,estado_acpm,riesgo_acpm,justificacion_riesgo,fecha_estado, fecha_finalizacion,id_usuario_fk) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $origen_acpm);
	$stmt->bindParam(2, $fuente_acpm);
	$stmt->bindParam(3, $descripcion_fuente);
	$stmt->bindParam(4, $tipo_acpm);
	$stmt->bindParam(5, $descripcion_acpm);
	$stmt->bindParam(6, $causa_acpm);
	$stmt->bindParam(7, $nc_similar);
	$stmt->bindParam(8, $descripcion_nsc);
	$stmt->bindParam(9, $correccion_acpm);
	$stmt->bindParam(10, $fecha_correccion);
	$stmt->bindParam(11, $estado_acpm);
	$stmt->bindParam(12, $riesgo_acpm);
	$stmt->bindParam(13, $justificacion_riesgo);
	$stmt->bindParam(14, $fecha_estado);
	$stmt->bindParam(15, $fecha_finalizacion);
	$stmt->bindParam(16, $id_usuario_fk);

	if ($stmt->execute()){
		echo "1";
	}else{
		echo "ERROR";
	}
} catch(PDOException $e){
	echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
}

?>