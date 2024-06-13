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

include_once("conexion.php");


// Obtener datos del formulario
$id_codificacion = $_POST['id_codificacion'];
$estado_sig_codificacion = $_POST['estado_sig_codificacion'];
$fecha_sig_codificacion = $_POST['fecha_sig_codificacion'];
$responsable_sig_codificacion = $_POST['responsable_sig_codificacion'];
$causa_rechazo_codificacion = $_POST['causa_rechazo_codificacion'];
$evidencia_difucion = $_POST['evidencia_difucion']; // Aquí se obtiene el contenido de Quill

// Procesar el contenido de Quill
$contenidoSinParrafos = strip_tags($evidencia_difucion, '<a><b><strong><i><em><u><s><strike><code>');

try {
    // Actualizar la solicitud de codificación
    $stmt = $conn->prepare('UPDATE solicitud_codificacion SET estado_sig_codificacion=?, fecha_sig_codificacion=?, responsable_sig_codificacion=?, causa_rechazo_codificacion=?, evidencia_difucion=? WHERE id_codificacion=?');
    $stmt->bindParam(1, $estado_sig_codificacion);
    $stmt->bindParam(2, $fecha_sig_codificacion);
    $stmt->bindParam(3, $responsable_sig_codificacion);
    $stmt->bindParam(4, $causa_rechazo_codificacion);
    $stmt->bindParam(5, $contenidoSinParrafos);
    $stmt->bindParam(6, $id_codificacion);

    if ($stmt->execute()) {
        echo "1";

        // Si el estado es "rechazado", enviar correo al solicitante
        if (strtolower($estado_sig_codificacion) == 'rechazado') {
            // Obtener el correo del solicitante
            $stmt = $conn->prepare('SELECT correo_solicitante FROM solicitud_codificacion WHERE id_codificacion = ?');
            $stmt->bindParam(1, $id_codificacion);
            $stmt->execute();
            $correo_solicitante = $stmt->fetchColumn();

            if ($correo_solicitante) {
                require '../mail/autoload.php';
                // Enviar correo
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor
                    $mail->SMTPDebug = 0; // Cambiar de SMTP::DEBUG_SERVER a 0 para desactivar la depuración
                    $mail->isSMTP();
                    $mail->Host = $smtpHost;
                    $mail->SMTPAuth = true;
                    $mail->Username = $smtpUsername;
                    $mail->Password = $smtpPassword;
                    $mail->SMTPSecure = $smtpSecure;
                    $mail->Port = $smtpPort;
                    $mail->CharSet = 'UTF-8';

                    // Remitente y destinatario
                    $mail->setFrom('info@zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');
                    $mail->addAddress($correo_solicitante);

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = "Solicitud de Codificación Rechazada";
                    $mail->Body = "
                    <html><body>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;'>
                        <div style='background-color: #F8F9F9; color: black; text-align: center; padding: 10px; border-radius: 5px 5px 0 0;'>
                            <img src='https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png'>
                            <h1>Solicitud de Codificación Rechazada</h1>
                        </div>
                        <div style='padding: 20px;'>
                            <p>Su solicitud de codificación ha sido rechazada por la siguiente razón:</p>
                            <p>{$causa_rechazo_codificacion}</p>
                            <p>Por favor, revise los detalles y tome las acciones necesarias.</p>
                            <p>Gracias.</p>
                        </div>
                        <div style='text-align: center; padding: 10px; background-color: #f4f4f4; border-radius: 0 0 5px 5px;'>
                            <p>Este es un mensaje automático, por favor no responda a este correo.</p>
                        </div>
                    </div>
                    </body></html>";

                    $mail->send();
                    echo "Correo enviado exitosamente.";
                } catch (Exception $e) {
                    echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "No se encontró el correo del solicitante.";
            }
        }
    } else {
        echo "ERROR";
    }
} catch (PDOException $e) {
    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
