<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("conexion.php");

$id_proceso_fk=$_POST["id_proceso_fk"];
$fecha_mantenimiento=$_POST["fecha_mantenimiento"];
$Id_usuario_fk=$_POST["Id_usuario_fk"];
$id_cargo_fk=$_POST["id_cargo_fk"];
$correo_destinatario=$_POST["correo_destinatario"];
$marca=$_POST["marca"];
$modelo=$_POST["modelo"];
$serie=$_POST["serie"];
$nombre_equipo=$_POST["nombre_usuario"];
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
	$stmt = $conn->prepare('INSERT INTO mantenimientos(id_mantenimiento, id_proceso_fk, fecha_mantenimiento, Id_usuario_fk, id_cargo_fk, correo_destinatario, marca, modelo, serie, usuario_equipo, soplar_partes_externas, verificar_usuario, liberar_espacio, actualizar_logos, lubricar_puertos, verificar_contraseñas, desinstalar_programas, organizar_cableado, limpieza_equipo, formato_asignacion_equipo, desfragmentar, limpiar_partes_interna, depurar_temporales, verificar_actualizaciones, usuario, clave, estandar, administrador, analisis_completo, bloqueo_usb, dominio_zfip, apagar_pantalla, estado_suspension, firma, estado_mantenimiento_equipo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $id_mantenimiento);
	$stmt->bindParam(2, $id_proceso_fk);
	$stmt->bindParam(3, $fecha_mantenimiento);
	$stmt->bindParam(4, $Id_usuario_fk);
	$stmt->bindParam(5, $id_cargo_fk);
    $stmt->bindParam(6, $correo_destinatario);
    $stmt->bindParam(7, $marca);
    $stmt->bindParam(8, $modelo);
    $stmt->bindParam(9, $serie);
    $stmt->bindParam(10, $nombre_equipo);
    $stmt->bindParam(11, $soplar_partes_externas);
    $stmt->bindParam(12, $verificar_usuario);
    $stmt->bindParam(13, $liberar_espacio);
    $stmt->bindParam(14, $actualizar_logos);
    $stmt->bindParam(15, $lubricar_puertos);
    $stmt->bindParam(16, $verificar_contraseñas);
    $stmt->bindParam(17, $desinstalar_programas);
    $stmt->bindParam(18, $organizar_cableado);
    $stmt->bindParam(19, $limpieza_equipo);
    $stmt->bindParam(20, $formato_asignacion_equipo);
    $stmt->bindParam(21, $desfragmentar);
    $stmt->bindParam(22, $limpiar_partes_interna);
    $stmt->bindParam(23, $depurar_temporales);
    $stmt->bindParam(24, $verificar_actualizaciones);
    $stmt->bindParam(25, $usuario);
    $stmt->bindParam(26, $clave);
    $stmt->bindParam(27, $estandar);
    $stmt->bindParam(28, $administrador);
    $stmt->bindParam(29, $analisis_completo);
    $stmt->bindParam(30, $bloqueo_usb);
    $stmt->bindParam(31, $dominio_zfip);
    $stmt->bindParam(32, $apagar_pantalla);
    $stmt->bindParam(33, $estado_suspension);
    $stmt->bindParam(34, $firma);
    $stmt->bindParam(35, $estado_mantenimiento_equipo);
    

    if ($stmt->execute()) {
         // Éxito al guardar en la base de datos
         echo "1";

         //CORREO DESTINATARIO (ESTO DESPUÉS LO VAMOS A CONFIGURAR DESDE LA APP)
         //$email = "ygarciaz@zonafrancadepereira.com";
         //$email = "yrios@zonafrancadepereira.com";
         //LIBRERÍA
         require '../mail/autoload.php';
         $mail = new PHPMailer(true);
         $mail->SMTPDebug = SMTP::DEBUG_SERVER;
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
         $mail->SMTPAuth = true;
         $mail->Username = 'info@zonafrancadepereira.com';
         $mail->Password = 'lwohsrzjdnqfhsyx';
         $mail->SMTPSecure = 'ssl';
         $mail->Port = 465;
         $mail->CharSet = 'UTF-8';
         $mail->setFrom('info@zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');

         // Lista de destinatarios
		$destinatarios = array($correo_destinatario);
		foreach ($destinatarios as $destinatario) {
			$mail->addAddress($destinatario);
		}
         $mail->isHTML(true);
         $titulo_correo = "Mantenimiento realizado " . $Id_usuario_fk . " / " . $fecha_mantenimiento;
         $message  = "<html><body>";
 
         $message .= '
         <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
         <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
             <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
             <h1>Mantenimiento realizado al equipo:' . $nombre_equipo . ', modelo: ' . $modelo . ' <h1/>
         </div>
         <div style="padding: 20px;">
             <p>Te informamos que se ha realizado un mantenimiento en el equipo. A continuación, se detallan algunos aspectos relevantes:</p>
             <ul>
                 <li>Fecha de mantenimiento:' . $fecha_mantenimiento .'</li>
                 <li>Marca:' . $marca .'</li>
                 <li>Serie: '. $serie .'</li>
             </ul>
             <p>Por favor, inicia sesión en nuestro sistema para revisar los detalles del mantenimiento. <br>
             <center>
             <a href="http://localhost/sadoc/" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesión</button></a></center>
             <p>¡Gracias!</p>
         </div>
         <div style=" text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;">
             <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
         </div>
     </div>';
         //CIERRE FINAL 
         $message .= "</body></html>";
         $mail->isHTML(true);
         $mail->Subject =  $titulo_correo;
         $mail->Body =  $message;
         $mail->send();
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}

?>