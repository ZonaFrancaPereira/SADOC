<?php 
include_once("conexion.php");

// Obtener datos del formulario
$id_activo_fk = $_POST['id_activo_fk'];
$msd = $_POST['msd'];
$antivirus = $_POST['antivirus'];
$visio_pro = $_POST['visio_pro'];
$mac_osx = $_POST['mac_osx'];
$windows = $_POST['windows'];
$autocad = $_POST['autocad'];
$office = $_POST['office'];
$appolo = $_POST['appolo'];
$zeus = $_POST['zeus'];
$otros = $_POST['otros'];
$procesador = $_POST['procesador'];
$disco_duro = $_POST['disco_duro'];
$memoria_ram = $_POST['memoria_ram'];
$cd_dvd = $_POST['cd_dvd'];
$tarjeta_video = $_POST['tarjeta_video'];
$tarjeta_red = $_POST['tarjeta_red'];
$tipo_red = $_POST['tipo_red'];
$tiempo_bloqueo = $_POST['tiempo_bloqueo'];
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$zfip = $_POST['zfip'];
$privilegios = $_POST['privilegios'];
$backup = $_POST['backup'];
$dia_backup = $_POST['dia_backup'];
$realiza_backup = $_POST['realiza_backup'];
$justificacion_backup = $_POST['justificacion_backup'];

try {
    // Preparar la consulta de inserción
    $stmt = $conn->prepare('INSERT INTO detalles_equipos (msd,antivirus,visio_pro,mac_osx,windows,autocad,office,appolo,zeus,otros,procesador,disco_duro,memoria_ram,cd_dvd,tarjeta_video,tarjeta_red,tipo_red,tiempo_bloqueo,usuario,clave,zfip,privilegios,backup,dia_backup,realiza_backup,justificacion_backup,id_activo_fk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    // Vincular los parámetros
    $stmt->bindParam(1, $msd);
    $stmt->bindParam(2, $antivirus);
    $stmt->bindParam(3, $visio_pro);
    $stmt->bindParam(4, $mac_osx);
    $stmt->bindParam(5, $windows);
    $stmt->bindParam(6, $autocad);
    $stmt->bindParam(7, $office);
    $stmt->bindParam(8, $appolo);
    $stmt->bindParam(9, $zeus);
    $stmt->bindParam(10, $otros);
    $stmt->bindParam(11, $procesador);
    $stmt->bindParam(12, $disco_duro);
    $stmt->bindParam(13, $memoria_ram);
    $stmt->bindParam(14, $cd_dvd);
    $stmt->bindParam(15, $tarjeta_video);
    $stmt->bindParam(16, $tarjeta_red);
    $stmt->bindParam(17, $tipo_red);
    $stmt->bindParam(18, $tiempo_bloqueo);
    $stmt->bindParam(19, $usuario);
    $stmt->bindParam(20, $clave);
    $stmt->bindParam(21, $zfip);
    $stmt->bindParam(22, $privilegios);
    $stmt->bindParam(23, $backup);
    $stmt->bindParam(24, $dia_backup);
    $stmt->bindParam(25, $realiza_backup);
    $stmt->bindParam(26, $justificacion_backup);
    $stmt->bindParam(27, $id_activo_fk);
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
