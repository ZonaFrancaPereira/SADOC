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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se envió el formulario de urgencia
    if (isset($_POST["responder_urgencia"])) {
        // Obtener los datos del formulario de urgencia
        $id_soporte = $_POST["id_soporte"];
        $urgencia = $_POST["urgencia"];

        try {
            // Preparar la consulta de actualización con el ID de soporte en la cláusula WHERE
            $stmt = $conn->prepare("UPDATE soporte SET urgencia = ? WHERE id_soporte = ?");

            // Asignar los parámetros y ejecutar la consulta
            $stmt->bindParam(1, $urgencia);
            $stmt->bindParam(2, $id_soporte);


            if ($stmt->execute()) {
                // Éxito al guardar en la base de datos
                echo "1";
                // Consultar el correo relacionado con el ID de soporte
                $stmt_correo = $conn->prepare("SELECT correo_soporte FROM soporte WHERE id_soporte = ?");
                $stmt_correo->bindParam(1, $id_soporte);
                $stmt_correo->execute();
                $row = $stmt_correo->fetch(PDO::FETCH_ASSOC);
                $email1 = $row['correo_soporte'];

                //LIBRERÍA
                require '../mail/autoload.php';
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

                // Lista de destinatarios
                $destinatarios = array($email1);
                foreach ($destinatarios as $destinatario) {
                    $mail->addAddress($destinatario);
                }
                $mail->isHTML(true);
                $titulo_correo = "Urgencia de solicitud de soporte - Tipo de Urgencia: " . $urgencia;
                $message  = "<html><body>";

                $message .= '
                <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
                    <div style="background-color: #F8F9F9; color: black; text-align: center; padding: 10px; border-radius: 5px 5px 0 0;">
                        <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
                        <h1>Urgencia de la Solicitud: ' . $urgencia . '</h1>
                    </div>
                    <div style="padding: 20px;">
                        <p>Tipos de Urgencia:</p>
                        <ul>
                            <li><strong>1:</strong> Urgente - se tendrá máximo un día para ser atendida</li>
                            <li><strong>2:</strong> Urgencia media - tendrán 2 días para ser cerradas</li>
                            <li><strong>3:</strong> Prioridad baja - tendrán 4 días para su cierre</li>
                        </ul>
                        <p>Por favor inicia sesión en nuestro sistema para revisar la Solicitud.</p>
                        <center>
                            <a href="https://app.zonafrancadepereira.com/" target="_blank">
                                <button style="border: none; color: white; padding: 14px 28px; cursor: pointer; border-radius: 5px; background: #0b7dda;">Iniciar Sesión</button>
                            </a>
                        </center>
                        <p>¡Gracias!</p>
                    </div>
                    <div style="text-align: center; padding: 10px; background-color: #f4f4f4; border-radius: 0 0 5px 5px;">
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
    }
    // Verificar si se envió el formulario de respuesta de solicitud
    elseif (isset($_POST["responder_solicitud"])) {
        // Obtener los datos del formulario de respuesta de solicitud
        $id_soporte1 = $_POST["id_soporte1"];
        $solucion_soporte = $_POST["solucion_soporte"];
        $fecha_solucion = $_POST["fecha_solucion"];
        $usuario_respuesta = $_POST["usuario_respuesta"];

        try {
            // Preparar la consulta de actualización con el ID de soporte en la cláusula WHERE
            $stmt = $conn->prepare("UPDATE soporte SET solucion_soporte = ?, fecha_solucion = ?, usuario_respuesta = ? WHERE id_soporte = ?");

            // Asignar los parámetros y ejecutar la consulta
            $stmt->bindParam(1, $solucion_soporte);
            $stmt->bindParam(2, $fecha_solucion);
            $stmt->bindParam(3, $usuario_respuesta);
            $stmt->bindParam(4, $id_soporte1);

            if ($stmt->execute()) {
                // Éxito al guardar en la base de datos
                echo "1";
                // Consultar el correo relacionado con el ID de soporte
                $stmt_correo = $conn->prepare("SELECT correo_soporte FROM soporte WHERE id_soporte = ?");
                $stmt_correo->bindParam(1, $id_soporte1);
                $stmt_correo->execute();
                $row = $stmt_correo->fetch(PDO::FETCH_ASSOC);
                $email2 = $row['correo_soporte'];

                //LIBRERÍA
                require '../mail/autoload.php';
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

                // Lista de destinatarios
                $destinatarios = array($email2);
                foreach ($destinatarios as $destinatario) {
                    $mail->addAddress($destinatario);
                }
                $mail->isHTML(true);
                $titulo_correo = "Solicitud de soporte - Solución proporcionada";

                $message  = "<html><body>";

                $message .= '
                <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
                    <div style="background-color: #F8F9F9; color: black; text-align: center; padding: 10px; border-radius: 5px 5px 0 0;">
                        <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
                        <h1>Solución proporcionada para la solicitud de soporte</h1>
                    </div>
                    <div style="padding: 20px;">
                        <p>Estimado usuario,</p>
                        <p>Nos complace informarle que se ha proporcionado una solución para su solicitud de soporte. A continuación, podrá visualizar los detalles:</p>
                        <p><strong>Fecha de solución:</strong> ' . $fecha_solucion . '</p>
                        <p><strong>Solución:</strong> ' . $solucion_soporte . '</p>
                        <p>Por favor, inicie sesión en nuestro sistema para revisar la solicitud y confirmar la solución proporcionada.</p>
                        <center>
                            <a href="https://app.zonafrancadepereira.com/" target="_blank">
                                <button style="border: none; color: white; padding: 14px 28px; cursor: pointer; border-radius: 5px; background: #0b7dda;">Iniciar Sesión</button>
                            </a>
                        </center>
                        <p>¡Gracias por su paciencia y colaboración!</p>
                    </div>
                    <div style="text-align: center; padding: 10px; background-color: #f4f4f4; border-radius: 0 0 5px 5px;">
                        <p>Este es un mensaje automático, por favor no responda a este correo.</p>
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
    } else {
        echo "No se ha recibido ningún formulario válido.";
    }
} else {
    echo "Acceso no permitido.";
}
