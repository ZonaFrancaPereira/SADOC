<?php 
include_once("conexion.php");

$id_proceso_fk=$_POST["id_proceso_fk"];
$fecha_mantenimiento=$_POST["fecha_mantenimiento"];
$Id_usuario_fk=$_POST["Id_usuario_fk"];
$id_cargo_fk=$_POST["id_cargo_fk"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$serie=$_POST["serie"];
$nombre_usuario=$_POST["nombre_usuario"];
$soplar_partes_externas=$_POST["soplar_partes_externas"];
$verificar_usuario=$_POST["verificar_usuario"];
$liberar_espacio=$_POST["liberar_espacio"];
$actualizar_logos=$_POST["actualizar_logos"];
$lubricar_puertos=$_POST["lubricar_puertos"];
$verificar_contraseñas=$_POST["verificar_contraseñas"];
$desinstalar_programas=$_POST["desinstalar_programas"];
$organizar_cableado=$_POST["organizar_cableado"];
$limpieza_equipo=$_POST["limpieza_equipo"];
$formato_asignacion_equipo=$_POST["formato_asignacion_equipo"];
$desfragmentar=$_POST["desfragmentar"];
$limpiar_partes_interna=$_POST["limpiar_partes_interna"];
$depurar_temporales=$_POST["depurar_temporales"];
$verificar_actualizaciones=$_POST["verificar_actualizaciones"];
$usuario=isset($_POST["usuario"]) ? $_POST["usuario"] : "NO";
$clave = isset($_POST["clave"]) ? $_POST["clave"] : "NO";
$estandar = isset($_POST["estandar"]) ? $_POST["estandar"] : "NO";
$administrador=isset($_POST["administrador"]) ? $_POST["administrador"] : "NO";
$analisis_completo=isset($_POST["analisis_completo"]) ? $_POST["analisis_completo"] : "NO";
$bloqueo_usb=isset($_POST["bloqueo_usb"]) ? $_POST["bloqueo_usb"] : "NO";
$dominio_zfip=isset($_POST["dominio_zfip"]) ? $_POST["dominio_zfip"] : "NO";
$apagar_pantalla=isset($_POST["apagar_pantalla"]) ? $_POST["apagar_pantalla"] : "NO";
$estado_suspension=isset($_POST["estado_suspension"]) ? $_POST["estado_suspension"] : "NO";
$firma=$_POST["firma"];
$estado_mantenimiento_equipo=$_POST["estado_mantenimiento_equipo"];

try {
	$stmt = $conn->prepare('INSERT INTO mantenimientos(id_mantenimiento, id_proceso_fk, fecha_mantenimiento, Id_usuario_fk, id_cargo_fk, marca, modelo, serie, nombre_usuario, soplar_partes_externas, verificar_usuario, liberar_espacio, actualizar_logos, lubricar_puertos, verificar_contraseñas, desinstalar_programas, organizar_cableado, limpieza_equipo, formato_asignacion_equipo, desfragmentar, limpiar_partes_interna, depurar_temporales, verificar_actualizaciones, usuario, clave, estandar, administrador, analisis_completo, bloqueo_usb, dominio_zfip, apagar_pantalla, estado_suspension, firma, estado_mantenimiento_equipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $id_mantenimiento);
	$stmt->bindParam(2, $id_proceso_fk);
	$stmt->bindParam(3, $fecha_mantenimiento);
	$stmt->bindParam(4, $Id_usuario_fk);
	$stmt->bindParam(5, $id_cargo_fk);
    $stmt->bindParam(6, $marca);
    $stmt->bindParam(7, $modelo);
    $stmt->bindParam(8, $serie);
    $stmt->bindParam(9, $nombre_usuario);
    $stmt->bindParam(10, $soplar_partes_externas);
    $stmt->bindParam(11, $verificar_usuario);
    $stmt->bindParam(12, $liberar_espacio);
    $stmt->bindParam(13, $actualizar_logos);
    $stmt->bindParam(14, $lubricar_puertos);
    $stmt->bindParam(15, $verificar_contraseñas);
    $stmt->bindParam(16, $desinstalar_programas);
    $stmt->bindParam(17, $organizar_cableado);
    $stmt->bindParam(18, $limpieza_equipo);
    $stmt->bindParam(19, $formato_asignacion_equipo);
    $stmt->bindParam(20, $desfragmentar);
    $stmt->bindParam(21, $limpiar_partes_interna);
    $stmt->bindParam(22, $depurar_temporales);
    $stmt->bindParam(23, $verificar_actualizaciones);
    $stmt->bindParam(24, $usuario);
    $stmt->bindParam(25, $clave);
    $stmt->bindParam(26, $estandar);
    $stmt->bindParam(27, $administrador);
    $stmt->bindParam(28, $analisis_completo);
    $stmt->bindParam(29, $bloqueo_usb);
    $stmt->bindParam(30, $dominio_zfip);
    $stmt->bindParam(31, $apagar_pantalla);
    $stmt->bindParam(32, $estado_suspension);
    $stmt->bindParam(33, $firma);
    $stmt->bindParam(34, $estado_mantenimiento_equipo);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}

?>