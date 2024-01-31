<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("conexion.php");

$id_proceso_fk_2=$_POST["id_proceso_fk_2"];
$fecha_mantenimiento_impresora=$_POST["fecha_mantenimiento_impresora"];
$Id_usuario_fk2=$_POST["Id_usuario_fk2"];
$id_cargo_fk2=$_POST["id_cargo_fk2"];
$correo_destinatario1=$_POST["correo_destinatario1"];
$nombre_impresora=$_POST["nombre_impresora"];
$marca_impresora=$_POST["marca_impresora"];
$modelo_impresora=$_POST["modelo_impresora"];
$serial_impresora=$_POST["serial_impresora"];
$soplar_exterior=$_POST["soplar_exterior"];
$isopropilico=$_POST["isopropilico"];
$toner=$_POST["toner"];
$alinear=$_POST["alinear"];
$verificar_cableado=$_POST["verificar_cableado"];
$rodillos=$_POST["rodillos"];
$reemplazar=$_POST["reemplazar"];
$limpiar=$_POST["limpiar"];
$imprimir=$_POST["imprimir"];
$verificar=$_POST["verificar"];
$estado_mantenimiento_impresora=$_POST["estado_mantenimiento_impresora"];

try {
	// Remove the binding for id_impresora
$stmt = $conn->prepare('INSERT INTO mantenimiento_impresora(id_proceso_fk_2, fecha_mantenimiento_impresora, Id_usuario_fk2, id_cargo_fk2, correo_destinatario1, nombre_impresora, marca_impresora, modelo_impresora, serial_impresora, soplar_exterior, isopropilico, toner, alinear, verificar_cableado, rodillos, reemplazar, limpiar, imprimir, verificar, estado_mantenimiento_impresora) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

// Adjust the parameter binding indices accordingly (remove 1st binding)
$stmt->bindParam(1, $id_proceso_fk_2);
$stmt->bindParam(2, $fecha_mantenimiento_impresora);
$stmt->bindParam(3, $Id_usuario_fk2);
$stmt->bindParam(4, $id_cargo_fk2);
$stmt->bindParam(5, $correo_destinatario1);
$stmt->bindParam(6, $nombre_impresora);
$stmt->bindParam(7, $marca_impresora);
$stmt->bindParam(8, $modelo_impresora);
$stmt->bindParam(9, $serial_impresora);
$stmt->bindParam(10, $soplar_exterior);
$stmt->bindParam(11, $isopropilico);
$stmt->bindParam(12, $toner);
$stmt->bindParam(13, $alinear);
$stmt->bindParam(14, $verificar_cableado);
$stmt->bindParam(15, $rodillos);
$stmt->bindParam(16, $reemplazar);
$stmt->bindParam(17, $limpiar);
$stmt->bindParam(18, $imprimir);
$stmt->bindParam(19, $verificar);
$stmt->bindParam(20, $estado_mantenimiento_impresora);


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
   $destinatarios = array($correo_destinatario1);
   foreach ($destinatarios as $destinatario1) {
       $mail->addAddress($destinatario1);
   }
    $mail->isHTML(true);
    $titulo_correo = "Mantenimiento realizado " . $Id_usuario_fk2 . " / " . $fecha_mantenimiento_impresora;
    $message  = "<html><body>";

    $message .= '
    <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
    <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
        <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
        <h1>Mantenimiento realizado a la impresora:' . $nombre_impresora . ', modelo: ' . $modelo_impresora . ' <h1/>
    </div>
    <div style="padding: 20px;">
        <p>Te informamos que se ha realizado un mantenimiento en la impresora. A continuación, se detallan algunos aspectos relevantes:</p>
        <ul>
            <li>Fecha de mantenimiento:' . $fecha_mantenimiento_impresora .'</li>
            <li>Marca:' . $marca_impresora .'</li>
            <li>Serie: '. $serial_impresora .'</li>
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