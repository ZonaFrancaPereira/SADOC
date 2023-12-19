<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include "conexion.php";
$id_acpm = $_POST['id_acpm'];
$estado_acpm = "Proceso";
$nombre_usuario = $_SESSION['nombre_usuario'];
$apellidos_usuario = $_SESSION['apellidos_usuario'];
try {
    // Construye y ejecuta la consulta UPDATE con parámetros
    $stmt = $conn->prepare("UPDATE acpm SET estado_acpm = :estado_acpm WHERE id_consecutivo = :id_acpm");
    $stmt->bindParam(':estado_acpm', $estado_acpm, PDO::PARAM_STR);
    $stmt->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt->execute();

    $registros = $stmt->rowCount();

    if ($registros > 0) {

        $email = "yrios@zonafrancadepereira.com";
        require '../mail/autoload.php';
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
        $mail->addAddress($email);
        $mail->isHTML(true);
        $titulo_correo = "NUEVA ACPM PARA REVISION " . $id_acpm;
        $message  = "<html><body>";

        $message .= '
                  <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                    <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
                    <h1>Nueva ACPM Esperando Revision #' . $id_acpm . ' <h1/>
                </div>
                <div style="padding: 20px;">
                    <p>Hola, Yuly Viviana Rios Castaño</p>
                    <p>Te informamos que hay una ACPM de ' . $nombre_usuario . ' ' . $apellidos_usuario . ' esperando tu aprobación</p>
                    <p>Por favor, inicia sesión en nuestro sistema para revisar y procesar la ACPM <br>
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
        
    } else {
        echo "No se encontraron registros para actualizar";
    }
} catch (PDOException $e) {
    echo "Error en el servidor: " . $e->getMessage();
}
?>