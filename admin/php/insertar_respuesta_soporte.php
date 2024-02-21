<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

    //CORREO DESTINATARIO (ESTO DESPUÉS LO VAMOS A CONFIGURAR DESDE LA APP)
    $email1 = "ygarciaz@zonafrancadepereira.com";
    //$email2 = "ymontoyag@zonafrancadepereira.com";
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
        <h1>Urgencia de la Solicitud: '. $urgencia . '</h1>
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
        } catch(PDOException $e) {
            echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
        }
    }
    // Verificar si se envió el formulario de respuesta de solicitud
    elseif(isset($_POST["responder_solicitud"])) {
        // Obtener los datos del formulario de respuesta de solicitud
        $id_soporte1 = $_POST["id_soporte1"];
        $solucion_soporte = $_POST["solucion_soporte"];
        $fecha_solucion = $_POST["fecha_solucion"];
    
        try {
            // Preparar la consulta de actualización con el ID de soporte en la cláusula WHERE
            $stmt = $conn->prepare("UPDATE soporte SET solucion_soporte = ?, fecha_solucion = ? WHERE id_soporte = ?");
    
            // Asignar los parámetros y ejecutar la consulta
            $stmt->bindParam(1, $solucion_soporte);
            $stmt->bindParam(2, $fecha_solucion);
            $stmt->bindParam(3, $id_soporte1); 
    
            if ($stmt->execute()) {
                echo "1"; // Éxito
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "ERROR al ejecutar la consulta de actualización: " . $errorInfo[2];
            }
        } catch(PDOException $e) {
            echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
        }
    } else {
        echo "No se ha recibido ningún formulario válido.";
    }
} else {
    echo "Acceso no permitido.";
}
?>

