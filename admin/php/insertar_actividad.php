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

$fecha_actividad = $_POST["fecha_actividad"];
$descripcion_actividad = $_POST["descripcion_actividad"];
$estado_actividad = $_POST["estado_actividad"];
$id_usuario_fk_6 = $_POST["id_usuario_fk_6"];
$id_acpm = $_POST["id_acpm_fk"];
$tipo_actividad = $_POST["tipo_actividad"];
$nombre_usuario = $_SESSION['nombre_usuario'];
$apellidos_usuario = $_SESSION['apellidos_usuario'];
$nombre_proceso = $_SESSION['nombre_proceso'];
$correo_remitente = $_SESSION['correo_usuario'];
try {
	$stmt = $conn->prepare('SELECT * FROM  usuarios WHERE Id_usuario="' . $id_usuario_fk_6 . '"');
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		while ($row = $stmt->fetch()) {
			$nombre_destinatario = $row["nombre_usuario"];
			$apellidos_destinatario = $row["apellidos_usuario"];
			$correo_destinatario = $row["correo_usuario"];
		}
	} else {
		echo "Revisar";
	}
} catch (PDOException $e) {
	echo "Error en el servidor";
}

try {
	$stmt = $conn->prepare('INSERT INTO actividades_acpm(fecha_actividad, descripcion_actividad, tipo_actividad,  estado_actividad, id_usuario_fk, id_acpm_fk) VALUES(?,?,?,?,?,?)');
	$stmt->bindParam(1, $fecha_actividad);
	$stmt->bindParam(2, $descripcion_actividad);
	$stmt->bindParam(3, $tipo_actividad);
	$stmt->bindParam(4, $estado_actividad);
	$stmt->bindParam(5, $id_usuario_fk_6);
	$stmt->bindParam(6, $id_acpm);

	if ($stmt->execute()) {
		// Correo destinatario (esto después lo vamos a configurar desde la app)
		$email = "ygarciaz@zonafrancadepereira.com";

		// Librería
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
		$destinatarios = array($email, $correo_remitente, $correo_destinatario);
		foreach ($destinatarios as $destinatario) {
			$mail->addAddress($destinatario);
		}

		$mail->isHTML(true);
		$titulo_correo = "Nueva Actividad Proceso del " . $nombre_proceso . " / " . $fecha_actividad;
		$message  = "<html><body>";

		$message .= '
			<div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
				<div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
					<img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
					<h1>Actividad Asignada Por : ' . $nombre_usuario . ' ' . $apellidos_usuario . ' <h1/>
				</div>
				<div style="padding: 20px;">
					<p>Hola, ' . $nombre_destinatario . ' ' . $apellidos_destinatario . ' 😊</p>
					<p>Te informamos que hay una nueva actividad de la ACPM # ' . $id_acpm . ', radicada por ' . $nombre_usuario . ' ' . $apellidos_usuario . ' la cual vence el día ' . $fecha_actividad . '</p>
					<p><b>Descripción Actividad : </b> ' . $descripcion_actividad . '</p>
					<p>Es de suma importancia que subas las evidencias correspondientes a esta actividad en el tiempo establecido recuerda que "La fuerza del equipo viene de cada miembro"</p>
					<p>Por favor, inicia sesión en nuestro sistema para revisar la Actividad. <br>
					<center>
					<a href="https://app.zonafrancadepereira.com/" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesión</button></a></center>
					<p>¡Gracias!</p>
				</div>
				<div style=" text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;">
					<p>Este es un mensaje automático, por favor no respondas a este correo.</p>
				</div>
			</div>
		';

		// Cierre final
		$message .= "</body></html>";

		$mail->isHTML(true);
		$mail->Subject =  $titulo_correo;
		$mail->Body =  $message;

		// Envío del correo
		$mail->send();
		echo "1";
	} else {
		echo "ERROR";
	}
} catch (PDOException $e) {
	echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}