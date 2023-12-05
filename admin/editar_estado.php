<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include "php/conexion.php";
$id_orden = $_GET['id_orden'];
$estado_orden = $_GET['estado_orden'];
$nombre_usuario = $_GET['nombre_usuario'];
$apellidos_usuario = $_GET['apellidos_usuario'];
$fecha_orden = $_GET['fecha_orden'];
$total_orden = $_GET['total_orden'];
$correo_usuario = $_GET['correo_usuario'];
try {


    // Construye y ejecuta la consulta UPDATE con parámetros
    $stmt = $conn->prepare("UPDATE orden_compra SET estado_orden = :estado_orden WHERE id_orden = :id_orden");
    $stmt->bindParam(':estado_orden', $estado_orden, PDO::PARAM_STR);
    $stmt->bindParam(':id_orden', $id_orden, PDO::PARAM_INT);
    $stmt->execute();

    $registros = $stmt->rowCount();

    if ($registros > 0) {
        switch ($estado_orden) {
            case "Proceso":
                $email = "ymontoyag@zonafrancadepereira.com";
                require 'mail/autoload.php';
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
                $titulo_correo = "NUEVA ORDEN DE COMPRA #" . $id_orden . " / " . $fecha_orden;
                $message  = "<html><body>";

                $message .= '
                  <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                    <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
                    <h1>Nueva Orden de Compra #' . $id_orden . ' <h1/>
                </div>
                <div style="padding: 20px;">
                    <p>Hola, Andrea Galan</p>
                    <p>Te informamos que hay una nueva orden de compra de ' . $nombre_usuario . ' ' . $apellidos_usuario . ' por un valor de $' . number_format($total_orden) . ' esperando tu aprobación</p>
                    <p>Por favor, inicia sesión en nuestro sistema para revisar y procesar la orden. <br>
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
                echo 'Correo enviado';
                echo "<script> 
                  window.location.href='./index.php'; </script>";

                break;

            case "Aprobada":
                $email = "facturacion@zonafrancadepereira.com";
                require 'mail/autoload.php';
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
                $titulo_correo = "NUEVA ORDEN DE COMPRA APROBADA #" . $id_orden . " / " . $fecha_orden;
                $message  = "<html><body>";

                $message .= '
                  <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                    <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
                    <h1>Nueva Orden de Compra #' . $id_orden . ' <h1/>
                </div>
                <div style="padding: 20px;">
                    <p>Hola, Contabilidad 😊</p>
                    <p>Te informamos que hay una nueva orden de compra de ' . $nombre_usuario . ' ' . $apellidos_usuario . ' por un valor de $' . number_format($total_orden) . ' esperando a ser procesada</p>
                    <p>Por favor, inicia sesión en nuestro sistema para revisar y procesar la orden. <br>
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
                echo 'Correo enviado';
                echo "<script> 
                  window.location.href='./index.php'; </script>";
                break;

                case "Denegada":
                    
                    require 'mail/autoload.php';
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
                    $mail->addAddress($correo_usuario);
                    $mail->isHTML(true);
                    $titulo_correo = "ORDEN DE COMPRA RECHAZADA #" . $id_orden . " / " . $fecha_orden;
                    $message  = "<html><body>";
    
                    $message .= '
                      <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                    <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                        <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
                        <h1> Orden de Compra #' . $id_orden . ' <h1/>
                    </div>
                    <div style="padding: 20px;">
                        <p>Hola, ' . $nombre_usuario . ' ' . $apellidos_usuario . ' 😥</p>
                        <p>Te informamos que la orden de compra de  por un valor de $' . number_format($total_orden) . ' ha sido rechazada </p>
                        <br>
                       
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
                    echo 'Correo enviado';
                    echo "<script> 
                      window.location.href='./index.php'; </script>";
                    break;
            default:
            echo "<script> 
            window.location.href='./index.php'; </script>";
        }
    } else {
        echo "No se encontraron registros para actualizar";
    }
} catch (PDOException $e) {
    echo "Error en el servidor: " . $e->getMessage();
}
