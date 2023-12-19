<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("admin/php/conexion.php");
// Obtener ACPMs que están a punto de vencer en 10 días
$fechaLimite = date('Y-m-d', strtotime('+10 days'));
//SE VERIFICA SI YA SE LE ENVIO EL RECORDATORIO

try {
    //SE CONSULTAN LAS ACPM PROXIMAS A VENCER
    $stmt = $conn->prepare('SELECT * FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE a.fecha_finalizacion="' . $fechaLimite . '"');
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
            //SE VERIFICA SI YA SE LE ENVIO EL RECORDATORIO
            $id_acpm = $row['id_consecutivo'];
            $fecha_finalizacion = $row['fecha_finalizacion'];
            $id_usuario_fk = $row['id_usuario_fk'];
            $nombre_usuario = $row['nombre_usuario'];
            $apellidos_usuario = $row['apellidos_usuario'];
            $descripcion_acpm = $row['descripcion_acpm'];
            $correo_destinatario = $row['correo_usuario'];

            $stmt2 = $conn->prepare('SELECT * FROM vencimiento_acpm WHERE id_acpm_fk = :id_acpm AND fecha_vencimiento = :fechaLimite');
            $stmt2->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
            $stmt2->bindParam(':fechaLimite', $fechaLimite, PDO::PARAM_STR);

            $stmt2->execute();
            if ($stmt2->rowCount() > 0) {
                echo "<script> 
                window.location.href='./index.php'; </script>";
            } else {
                // SI NO SE LE HA ENVIADO ENTONCES AQUI LO VAMOS A HACCER EN UN WHILE PARA QUE SE HAGAN TODAS EN GENERAL
                // Correo destinatario (esto después lo vamos a configurar desde la app)
                $email = "ymontoyag@zonafrancadepereira.com";

                // Librería
                require 'admin/mail/autoload.php';
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'info@zonafrancadepereira.com';
                $mail->Password = 'svmzgjdkntzpkjln';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->CharSet = 'UTF-8';
                $mail->setFrom('info@zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');

                // Lista de destinatarios
                $destinatarios = array($email, $correo_destinatario);
                foreach ($destinatarios as $destinatario) {
                    $mail->addAddress($destinatario);
                }

                $mail->isHTML(true);
                $titulo_correo = "URGENTE ACPM A PUNTO DE VENCER ! " . $fecha_finalizacion;
                $message  = "<html><body>";

                $message .= '
			<div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
				<div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
					<img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
					<h1>TÚ ACPM VENCE EN 10 DIAS 😥 <h1/>
				</div>
				<div style="padding: 20px;">
					<p>Hola, ' . $nombre_usuario . ' ' . $apellidos_usuario . ' </p>
					<p>Te informamos que la ACPM # ' . $id_acpm . ' vence el día ' . $fecha_finalizacion . '</p>
					<p><b>Descripción ACPM : </b> ' . $descripcion_acpm . '</p>
					<p>Si no cierras esta ACPM en los proximos 5 dias, sera redirigida al SIG y a la Gerencia 😐</p>
					<p>Por favor, inicia sesión en nuestro sistema para culminar tus pendientes. <br>
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

                try {
                    $stmt = $conn->prepare('INSERT INTO vencimiento_acpm(id_acpm_fk,fecha_vencimiento) VALUES(?,?)');
                    $stmt->bindParam(1, $id_acpm);
                    $stmt->bindParam(2, $fecha_finalizacion);


                    if ($stmt->execute()) {
                        //CORRECTO
                    } else {
                        echo "ERROR";
                    }
                } catch (PDOException $e) {
                    echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
                }
            }
        }
    } else {
       // echo "Revisar";
    }
   
} catch (PDOException $e) {
    echo "Error en el servidor";
}
