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
$origen_acpm = $_POST["origen_acpm"];
$fuente_acpm = $_POST["fuente_acpm"];
$descripcion_fuente = $_POST["descripcion_fuente"];
$tipo_acpm = $_POST["tipo_acpm"];
$descripcion_acpm = $_POST["descripcion_acpm"];
$causa_acpm = $_POST["causa_acpm"];
$nc_similar = $_POST["nc_similar"];
$descripcion_nsc = $_POST["descripcion_nsc"];
$correccion_acpm = $_POST["correccion_acpm"];
$fecha_correccion = $_POST["fecha_correccion"];
$estado_acpm = "Verificacion";
$riesgo_acpm = $_POST["riesgo_acpm"];
$justificacion_riesgo = $_POST["justificacion_riesgo"];
$fecha_estado = date("Y-m-d");
$fecha_finalizacion = $_POST["fecha_finalizacion"];
$id_usuario_fk = $_POST["id_usuario_fk"];
$nombre_usuario = $_SESSION['nombre_usuario'];
$apellidos_usuario = $_SESSION['apellidos_usuario'];
$nombre_proceso = $_SESSION['nombre_proceso'];


try {
	$stmt = $conn->prepare('INSERT INTO acpm(origen_acpm,fuente_acpm,descripcion_fuente,tipo_acpm,descripcion_acpm,causa_acpm, nc_similar,descripcion_nsc,estado_acpm,riesgo_acpm,justificacion_riesgo,fecha_estado, fecha_finalizacion,id_usuario_fk) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $origen_acpm);
	$stmt->bindParam(2, $fuente_acpm);
	$stmt->bindParam(3, $descripcion_fuente);
	$stmt->bindParam(4, $tipo_acpm);
	$stmt->bindParam(5, $descripcion_acpm);
	$stmt->bindParam(6, $causa_acpm);
	$stmt->bindParam(7, $nc_similar);
	$stmt->bindParam(8, $descripcion_nsc);
	$stmt->bindParam(9, $estado_acpm);
	$stmt->bindParam(10, $riesgo_acpm);
	$stmt->bindParam(11, $justificacion_riesgo);
	$stmt->bindParam(12, $fecha_estado);
	$stmt->bindParam(13, $fecha_finalizacion);
	$stmt->bindParam(14, $id_usuario_fk);

	if ($stmt->execute()) {
		// Obtener el último ID insertado
		$id_acpm_fk = $conn->lastInsertId();
		if ($tipo_acpm == "AC" || $tipo_acpm == "AP") {
			$tipo_actividad = "Correccion";
			$estado_actividad = "Incompleta";
		
			try {
				$stmt2 = $conn->prepare('INSERT INTO actividades_acpm( fecha_actividad, descripcion_actividad, tipo_actividad, estado_actividad, id_usuario_fk, id_acpm_fk) VALUES(?,?,?,?,?,?)');
				$stmt2->bindParam(1, $fecha_correccion);
				$stmt2->bindParam(2, $correccion_acpm);
				$stmt2->bindParam(3, $tipo_actividad);
				$stmt2->bindParam(4, $estado_actividad);
				$stmt2->bindParam(5, $id_usuario_fk);
				$stmt2->bindParam(6, $id_acpm_fk);
		
				if ($stmt2->execute()) {
					// El código para el caso de éxito
					echo "La inserción de la actividad fue exitosa.";
				} else {
					// El código para el caso de error
					echo "Error al insertar la actividad.";
				}
			} catch (PDOException $e) {
				// Manejo de excepciones
				echo "Error en el servidor: " . $e->getMessage();
			}
		}

		
	
		//CORREO DESTINATARIO (ESTO DESPUES LO VAMOS A CONFIGURAR DESDE LA APP)
		$email = "ygarciaz@zonafrancadepereira.com";
		//$email = "yrios@zonafrancadepereira.com";
		//LIBRERIA
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
		$mail->addAddress($email);
		$mail->isHTML(true);
		$titulo_correo = "Nueva ACPM del Proceso de " . $nombre_proceso . " / " . $fecha_finalizacion;
		$message  = "<html><body>";

		$message .= '
		  <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
		<div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
			<img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
			<h1>ACPM Radicada Por : #' . $nombre_usuario . ' ' . $apellidos_usuario . ' <h1/>
		</div>
		<div style="padding: 20px;">
			<p>Hola, Yuli Viviana Rios 😊</p>
			<p>Te informamos que hay una nueva ACPM, radicada por ' . $nombre_usuario . ' ' . $apellidos_usuario . ' esperando tu revision para poder ser ejecutada la cual vence el dia ' . $fecha_finalizacion . '
			</p>
			<p><B>Descripción ACPM : </B> ' . $descripcion_acpm . '</p>
			<p>Por favor, inicia sesión en nuestro sistema para revisar la ACPM. <br>
			<center>
			<a href="https://app.zonafrancadepereira.com/" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesion</button></p><a><center>
			<p>¡Gracias!</p>
		</div>
		<div style=" text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;">
			<p>Este es un mensaje automático, por favor no respondas a este correo.</p>
		</div>
	</div>
	  ';
		//CIERRE FINAL 
		$message .= "</body></html>";
		$mail->isHTML(true);
		$mail->Subject =  $titulo_correo;
		$mail->Body =  $message;
		$mail->send();
		echo "1";
	} else {
		echo "ERROR";
	}
} catch (PDOException $e) {
	echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
}
