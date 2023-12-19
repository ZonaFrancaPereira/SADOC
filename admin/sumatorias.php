<?php 
include "php/conexion.php";
$id_usuario_fk=$_SESSION['Id'];
// TOTAL DE ACTIVIDADES VENCIDAS

  try {
    $stmt = $conn->prepare("SELECT COUNT(*) AS total_actividades_vencidas
FROM actividades_acpm
WHERE estado_actividad = 'Incompleta' 
  AND fecha_actividad < CURRENT_DATE AND id_usuario_fk='".$id_usuario_fk."' ");
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch()) {
        $total_actividades_vencidas=$row['total_actividades_vencidas'];
      }
    }
  } catch (PDOException $e) {
    echo "Error en el servidor";
  }

  //TOTAL ACTIVOS ASIGNADOS 
  try {
    $stmt = $conn->prepare("SELECT COUNT(id_activo) AS cantidad_activos
    FROM activos
    WHERE (estado_activo = 'Activo' OR estado_activo = 'Rentado') AND id_usuario_fk = '".$id_usuario_fk."' ");
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch()) {
        $cantidad_activos=$row['cantidad_activos'];
      }
    }
  } catch (PDOException $e) {
    echo "Error en el servidor";
  }
//TOTAL DE ORDENES EN ESPERA
  try {
    $stmt = $conn->prepare("SELECT COUNT(id_orden) AS cantidad_orden
    FROM orden_compra
     WHERE (estado_orden = 'Proceso' OR estado_orden = 'Analisis de Cotizacion') AND id_cotizante='".$id_usuario_fk."' ");
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {
      while ($row = $stmt->fetch()) {
        $cantidad_orden=$row['cantidad_orden'];
      }
    }
  } catch (PDOException $e) {
    echo "Error en el servidor";
  }
  // ACTIVIDADES PROXIMAS A VENCER
  
try {
  $stmt = $conn->prepare("SELECT COUNT(*) AS cantidad_actividades_a_vencer
  FROM actividades_acpm
  WHERE (fecha_actividad <= DATE_ADD(CURDATE(), INTERVAL 10 DAY)
  AND fecha_actividad >= CURDATE() ) AND id_usuario_fk='".$id_usuario_fk."' ");
  $stmt->execute();
  $registros = 1;
  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
      $proxima_vencer=$row['cantidad_actividades_a_vencer'];
    }
  }
} catch (PDOException $e) {
  echo "Error en el servidor";
}

//TOTAL ACPM ABIERTAS
try {
  $stmt = $conn->prepare("SELECT COUNT(id_consecutivo) AS total_acpm
  FROM acpm
  WHERE (estado_acpm = 'Abierta' OR estado_acpm = 'Proceso'  OR estado_acpm = 'Rechazada') AND id_usuario_fk = '".$id_usuario_fk."' ");
  $stmt->execute();
  $registros = 1;
  if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
      $total_acpm=$row['total_acpm'];
    }
  }
} catch (PDOException $e) {
  echo "Error en el servidor";
}

?>

