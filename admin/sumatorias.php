<?php 
include "php/conexion.php";
$id_usuario_fk=$_SESSION['Id'];
// TOTAL DE ACTIVIDADES VENCIDAS
  try {
    $stmt = $conn->prepare("SELECT 
    SUM(CASE WHEN DATE(fecha_actividad) < CURDATE() THEN 1 ELSE 0 END) AS total_actividades_vencidas,id_usuario_fk FROM 
    actividades_acpm WHERE id_usuario_fk='".$id_usuario_fk."' ");
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
     WHERE estado_activo = 'Activo' OR estado_activo = 'Rentado' AND id_usuario_fk='".$id_usuario_fk."' ");
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
    $stmt = $conn->prepare("SELECT COUNT(id_activo) AS cantidad_activos
    FROM activos
     WHERE estado_activo = 'Activo' OR estado_activo = 'Rentado' AND id_usuario_fk='".$id_usuario_fk."' ");
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
  ?>

