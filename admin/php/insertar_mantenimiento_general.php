<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("conexion.php");

$id_proceso_fk_3=$_POST["id_proceso_fk_3"];
$fecha_mantenimiento3 =$_POST["fecha_mantenimiento3"];
$Id_usuario_fk3 =$_POST["Id_usuario_fk3"];
$id_cargo_fk3 =$_POST["id_cargo_fk3"];
$correo_destinatario2 =$_POST["correo_destinatario2"];
$articulo =$_POST["articulo"];
$marca_general =$_POST["marca_general"];
$modelo_general =$_POST["modelo_general"];
$serial_general =$_POST["serial_general"];
$partes_externas =$_POST["partes_externas"];
$condiciones_fisicas =$_POST["condiciones_fisicas"];
$cableado_verificar =$_POST["cableado_verificar"];
$dispositivo=$_POST["dispositivo"];
$estado_general=$_POST["estado_general"];

try {
	$stmt = $conn->prepare('INSERT INTO mantenimiento_general(id_general, id_proceso_fk_3, fecha_mantenimiento3, Id_usuario_fk3, id_cargo_fk3, correo_destinatario2, articulo, marca_general, modelo_general, serial_general, partes_externas, condiciones_fisicas, cableado_verificar, dispositivo, estado_general) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
	$stmt->bindParam(1, $id_general);
	$stmt->bindParam(2, $id_proceso_fk_3);
	$stmt->bindParam(3, $fecha_mantenimiento3);
	$stmt->bindParam(4, $Id_usuario_fk3);
	$stmt->bindParam(5, $id_cargo_fk3);
    $stmt->bindParam(6, $correo_destinatario2);
    $stmt->bindParam(7, $articulo);
    $stmt->bindParam(8, $marca_general);
    $stmt->bindParam(9, $modelo_general);
    $stmt->bindParam(10, $serial_general);
    $stmt->bindParam(11, $partes_externas);
    $stmt->bindParam(12, $condiciones_fisicas);
    $stmt->bindParam(13, $cableado_verificar);
    $stmt->bindParam(14, $dispositivo);
    $stmt->bindParam(15, $estado_general);

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
       $destinatarios = array($correo_destinatario2);
       foreach ($destinatarios as $destinatario2) {
           $mail->addAddress($destinatario2);
       }
        $mail->isHTML(true);
        $titulo_correo = "Mantenimiento realizado " . $Id_usuario_fk3 . " / " . $fecha_mantenimiento3;
        $message  = "<html><body>";
    
        $message .= '
        <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
        <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
            <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
            <h1>Mantenimiento realizado al articulo:' . $articulo . ', modelo: ' . $modelo_general . ' <h1/>
        </div>
        <div style="padding: 20px;">
            <p>Te informamos que se ha realizado un mantenimiento al articulo. A continuación, se detallan algunos aspectos relevantes:</p>
            <ul>
                <li>Fecha de mantenimiento:' . $fecha_mantenimiento3 .'</li>
                <li>Marca:' . $marca_general .'</li>
                <li>Serie: '. $serial_general .'</li>
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