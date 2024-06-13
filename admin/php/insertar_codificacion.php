<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '../../../vendor/autoload.php'; // Ruta al autoload.php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cargar las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../');
$dotenv->load();
$smtpUsername = $_ENV['SMTP_USERNAME'];
$smtpPassword = $_ENV['SMTP_PASSWORD'];
$smtpHost = $_ENV['SMTP_HOST'];
$smtpPort = $_ENV['SMTP_PORT'];
$smtpSecure = $_ENV['SMTP_SECURE'];

var_dump($_ENV);

include_once("conexion.php");

$vigencia = $_POST["vigencia"];
$fecha_solicitud_cod = $_POST["fecha_solicitud_cod"];
$usuario_solicitud_cod = $_POST["usuario_solicitud_cod"];
$cargo_solicitud_cod = $_POST["cargo_solicitud_cod"];
$correo_solicitante = $_POST["correo_solicitante"];
$nombre_documento = $_POST["nombre_documento"];
$codigo = $_POST["codigo"];
$descripcion_cambio = $_POST["descripcion_cambio"];
$link_formato_codificacion = $_POST["link_formato_codificacion"];
$contenidoSinParrafos2 = strip_tags($link_formato_codificacion, '<a><b><strong><i><em><u><s><strike><code>');
$elabora_nombre = $_POST["elabora_nombre"];
$elabora_correo = $_POST["elabora_correo"];
$revisa_nombre = $_POST["revisa_nombre"];
$revisa_correo = $_POST["revisa_correo"];
$aprueba_nombre = $_POST["aprueba_nombre"];
$aprueba_correo = $_POST["aprueba_correo"];
$codigo_doc_afectado = $_POST["codigo_doc_afectado"];
$nombre_doc_afectado = $_POST["nombre_doc_afectado"];
$afecta = $_POST["afecta"];
$todos_colaboradores = isset($_POST["todos_colaboradores"]) ? $_POST["todos_colaboradores"] : "No";
$solo_lider = isset($_POST["solo_lider"]) ? $_POST["solo_lider"] : "No";
$miembros_proceso = isset($_POST["miembros_proceso"]) ? $_POST["miembros_proceso"] : "No";
$colaborador_especifico = isset($_POST["colaborador_especifico"]) ? $_POST["colaborador_especifico"] : "No";
$nombre_interna = $_POST["nombre_interna"];
$correo_interna = $_POST["correo_interna"];
$nombre_externa = $_POST["nombre_externa"];
$correo_externa = $_POST["correo_externa"];
$enviar_copia = isset($_POST["enviar_copia"]) ? $_POST["enviar_copia"] : "No";


try {
    // Iniciar una transacción
    $conn->beginTransaction();

    // INSERTAR SOLICITUD DE CODIFICACION
    $stmt = $conn->prepare('INSERT INTO solicitud_codificacion(vigencia, fecha_solicitud_cod, usuario_solicitud_cod, cargo_solicitud_cod, correo_solicitante, nombre_documento, codigo, descripcion_cambio, link_formato_codificacion, elabora_nombre, elabora_correo, revisa_nombre, revisa_correo, aprueba_nombre, aprueba_correo, todos_colaboradores, solo_lider, miembros_proceso, colaborador_especifico, enviar_copia) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->bindParam(1, $vigencia);
    $stmt->bindParam(2, $fecha_solicitud_cod);
    $stmt->bindParam(3, $usuario_solicitud_cod);
    $stmt->bindParam(4, $cargo_solicitud_cod);
    $stmt->bindParam(5, $correo_solicitante);
    $stmt->bindParam(6, $nombre_documento);
    $stmt->bindParam(7, $codigo);
    $stmt->bindParam(8, $descripcion_cambio);
    $stmt->bindParam(9, $contenidoSinParrafos2);
    $stmt->bindParam(10, $elabora_nombre);
    $stmt->bindParam(11, $elabora_correo);
    $stmt->bindParam(12, $revisa_nombre);
    $stmt->bindParam(13, $revisa_correo);
    $stmt->bindParam(14, $aprueba_nombre);
    $stmt->bindParam(15, $aprueba_correo);
    $stmt->bindParam(16, $todos_colaboradores);
    $stmt->bindParam(17, $solo_lider);
    $stmt->bindParam(18, $miembros_proceso);
    $stmt->bindParam(19, $colaborador_especifico);
    $stmt->bindParam(20, $enviar_copia);

    if ($stmt->execute()) {
        $id_codificacion = $conn->lastInsertId(); // Obtener el ID de la solicitud de codificación

        // Insertar datos en tabla
        $codigo_doc_afectado = $_POST["codigo_doc_afectado"];
        $nombre_doc_afectado = $_POST["nombre_doc_afectado"];
        $afecta = $_POST["afecta"];
        $nombre_interna = $_POST["nombre_interna"];
        $correo_interna = $_POST["correo_interna"];
        $nombre_externa = $_POST["nombre_externa"];
        $correo_externa = $_POST["correo_externa"];

        $stmt2 = $conn->prepare('INSERT INTO detalle_codificacion(id_codificacion_fk, codigo_doc_afectado, nombre_doc_afectado, afecta,nombre_interna, correo_interna,nombre_externa, correo_externa) VALUES(?,?,?,?,?,?,?,?)');
        foreach ($codigo_doc_afectado as $key => $value) {
            $stmt2->bindParam(1, $id_codificacion);
            $stmt2->bindParam(2, $codigo_doc_afectado[$key]);
            $stmt2->bindParam(3, $nombre_doc_afectado[$key]);
            $stmt2->bindParam(4, $afecta[$key]);
            $stmt2->bindParam(5, $nombre_interna[$key]);
            $stmt2->bindParam(6, $correo_interna[$key]);
            $stmt2->bindParam(7, $nombre_externa[$key]);
            $stmt2->bindParam(8, $correo_externa[$key]);
            $stmt2->execute();
        }

        $conn->commit(); // Commit la transacción
        echo "1"; // Éxito
        $email = "ygarciaz@zonafrancadepereira.com";
        // Envío de correo a los destinatarios obtenidos
        require '../mail/autoload.php';
        // Envío de correo a los destinatarios obtenidos
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port = $smtpPort;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('info@zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');

        $destinatarios = array($email);
        foreach ($destinatarios as $destinatario) {
            $mail->addAddress($destinatario);
        }

        $mail->isHTML(true);
        $titulo_correo = "Nueva Solicitud de Codificacion - Usuario: " . $usuario_solicitud_cod;
        $message  = "<html><body>";

        $message .= '
            <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                    <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
                    <h1>Solicitud de Codificación de Documento</h1>
                </div>
                <div style="padding: 20px;">
                    <p>Se ha generado una nueva solicitud de Codificación:</p>
                    <ul>
                        <li>Usuario solicitante: ' . $usuario_solicitud_cod . '</li>
                        <li>Cargo: ' . $cargo_solicitud_cod . '</li>
                        <li>Descripción del Cambio: ' . $descripcion_cambio . '</li>
                    </ul>
                    <p>Por favor, toma las acciones necesarias para abordar esta solicitud lo antes posible.</p>
                    <p>inicia sesión en nuestro sistema para revisar la Solicitud.</p>
                    <center>
                        <a href="https://app.zonafrancadepereira.com/" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesión</button></a>
                    </center>
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
