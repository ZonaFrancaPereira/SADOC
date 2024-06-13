<?php

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

// Obtener datos del formulario
$correo_soporte = $_POST["correo_soporte"];
$id_usuario_soporte = $_POST["id_usuario_soporte"];
$usuario_soporte = $_POST["usuario_soporte"];
$proceso_soporte = $_POST["proceso_soporte"];
$descripcion_soporte = $_POST["descripcion_soporte"];
// Manejar el archivo adjunto
$nombre_archivo = $_FILES["imagenes_soporte"]["name"];
$ruta_temporal = $_FILES["imagenes_soporte"]["tmp_name"];

// Verificar si se ha cargado un archivo
if ($nombre_archivo) {
    // Mover el archivo a una ubicación permanente
    $ruta_destino = "soporte/" . $nombre_archivo;
    move_uploaded_file($ruta_temporal, $ruta_destino);
} else {
    // Si no se ha cargado un archivo, establecer la ruta de destino como nula
    $ruta_destino = null;
}

try {
    $stmt = $conn->prepare('INSERT INTO soporte (correo_soporte, Id_usuario_fk, usuario_soporte, proceso_soporte, descripcion_soporte, imagenes_soporte) VALUES (?, ?, ?, ?, ?, ?)');

    $stmt->bindParam(1, $correo_soporte);
    $stmt->bindParam(2, $id_usuario_soporte);
    $stmt->bindParam(3, $usuario_soporte);
    $stmt->bindParam(4, $proceso_soporte);
    $stmt->bindParam(5, $descripcion_soporte);
    $stmt->bindParam(6, $nombre_archivo); // Almacena solo el nombre del archivo, no la ruta completa

    if ($stmt->execute()) {
        // Éxito al guardar en la base de datos
        echo "1";

        // Consultar los correos de los usuarios con proceso_usuario_fk = 2
        $stmt_correo = $conn->prepare("SELECT correo_usuario FROM usuarios WHERE proceso_usuario_fk = 2");
        $stmt_correo->execute();
        $destinatarios = $stmt_correo->fetchAll(PDO::FETCH_COLUMN);
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

        foreach ($destinatarios as $destinatario) {
            $mail->addAddress($destinatario);
        }

        $mail->isHTML(true);
        $titulo_correo = "Nueva Solicitud de Soporte - Usuario: " . $usuario_soporte;
        $message  = "<html><body>";

        $message .= '
        <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
            <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
                <h1>Solicitud de Soporte</h1>
            </div>
            <div style="padding: 20px;">
                <p>Se ha generado una nueva solicitud de soporte:</p>
                <ul>
                    <li>Correo del solicitante: ' . $correo_soporte . '</li>
                    <li>Usuario solicitante: ' . $usuario_soporte . '</li>
                    <li>Proceso relacionado: ' . $proceso_soporte . '</li>
                    <li>Descripción del problema: ' . $descripcion_soporte . '</li>
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
?>
