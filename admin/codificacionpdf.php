<?php

require('php/conexion.php');
ob_start();
$id_codificacion = $_GET['id_codificacion'];

try {
    $stmt = $conn->prepare("SELECT m.*, u.*
    FROM solicitud_codificacion m
    INNER JOIN detalle_codificacion u ON m.id_codificacion = u.id_codificacion_fk
    WHERE m.id_codificacion = '" . $id_codificacion . "'");
    $stmt->execute();
    $registros = 1;
    
    if ($stmt->rowCount() > 0) {

        while ($row = $stmt->fetch()) {

            $vigencia = $row["vigencia"];
            $fecha_solicitud_cod = $row["fecha_solicitud_cod"];
            $usuario_solicitud_cod = $row["usuario_solicitud_cod"];
            $cargo_solicitud_cod = $row["cargo_solicitud_cod"];
            $nombre_documento = $row["nombre_documento"];
            $codigo = $row["codigo"];
            $descripcion_cambio = $row["descripcion_cambio"];
            $link_formato_codificacion = $row["link_formato_codificacion"];
            $elabora_nombre = $row["elabora_nombre"];
            $elabora_correo = $row["elabora_correo"];
            $revisa_nombre = $row["revisa_nombre"];
            $revisa_correo = $row["revisa_correo"];
            $aprueba_nombre = $row["aprueba_nombre"];
            $aprueba_correo = $row["aprueba_correo"];
            $codigo_doc_afectado = $row["codigo_doc_afectado"];
            $nombre_doc_afectado = $row["nombre_doc_afectado"];
            $afecta = $row["afecta"];
            $todos_colaboradores = $row["todos_colaboradores"];
            $solo_lider =  $row["solo_lider"];
            $miembros_proceso =  $row["miembros_proceso"];
            $colaborador_especifico = $row["colaborador_especifico"];
            $nombre_interna = $row["nombre_interna"];
            $correo_interna = $row["correo_interna"];
            $nombre_externa = $row["nombre_externa"];
            $correo_externa = $row["correo_externa"];
            $enviar_copia = $row["enviar_copia"];
            $estado_sig_codificacion = $row['estado_sig_codificacion'];
            $fecha_sig_codificacion = $row['fecha_sig_codificacion'];
            $responsable_sig_codificacion = $row['responsable_sig_codificacion'];
            $causa_rechazo_codificacion = $row['causa_rechazo_codificacion'];
            $evidencia_difucion = $row['evidencia_difucion'];
        }
    }
} catch (PDOException $e) {
    echo "Error en el servidor acpm";
}

$fecha = date("d/m/Y", strtotime($fecha_mantenimiento));
$nombreImagen = "img/zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
//FIRMA DEL USUARIO AL QUE PERTENECE EL EQUIPO
$firmaUsuario = "firmas/" . $firma_usuario;
$firmar = "data:image/png;base64," . base64_encode(file_get_contents($firmaUsuario));
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FORMATO # <?php echo $id_codificacion; ?></title>

</head>

<body>
    <style>
        body {
            font-family: "Gill Sans", sans-serif;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;

        }

        td,
        th,
        p {
            border: 1px solid #ccc;
            text-align: left;
            padding: 8px;
            font-size: 10;
            word-wrap: break-word;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .sinBorde th {
            border: 0;
        }

        .sinBorde tr {
            border: 1px solid #ccc
        }
    </style>
    <table>
        <tr class="sinBorde">
            <th><img src="<?php echo $imagenBase64; ?>" alt="" width="140"></th>
            <th>
                <h3>
                    <center>FORMATO # <?php echo $id_codificacion; ?></center>
                </h3>
            </th>
        </tr>
    </table>

    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> SOLICITUD DE MODIFICACIÓN / CREACIÓN DE DOCUMENTO O FORMATO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Vigencia</td>
            <td><?php echo  $vigencia; ?></td>
            <td>Fecha (DD-MM-AA)</td>
            <td><?php echo $fecha_solicitud_cod; ?></td>
        </tr>
        <tr>
            <td>Solcitado por:</td>
            <td><?php echo $usuario_solicitud_cod; ?></td>
            <td>Cargo</td>
            <td><?php echo $cargo_solicitud_cod; ?></td>
        </tr>
        <tr>
            <td>Nombre del Documento</td>
            <td><?php echo $nombre_documento; ?></td>
            <td>Codigo</td>
            <td><?php echo $codigo; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B>DESCRIPCIÓN DEL CAMBIO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="4"><?php echo  $descripcion_cambio; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B>LINK DEL FORMATO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="4"><?php echo  $link_formato_codificacion; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="3">
                <center><B>POLÍTICA DE ELABORACIÓN, REVISIÓN Y APROBACIÓN</B></center>
                <br>
            </td>
        </tr>
        <tr >
            <td>Elabora</td>
            <td>Revisa</td>
            <td>Aprueba</td>
        </tr>
        <tr>
            <td>Nombre: <?php echo $elabora_nombre; ?></td>
            <td>Nombre:<?php echo $revisa_nombre; ?></td>
            <td>Nombre:<?php echo $aprueba_nombre; ?></td>
        </tr>
        <tr>
            <td>Cargo: <?php echo $elabora_correo; ?></td>
            <td>Cargo: <?php echo $revisa_nombre; ?></td>
            <td>Cargo: <?php echo $aprueba_nombre; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="3">
                <center><B>DOCUMENTOS RELACIONADOS O ANEXOS</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="3">Enliste a continuación los documentos relacionados o anexos del documento en modificación y determine si el cambio los afecta. En caso positivo, proceda con la actualización adicional aplicable al documento identificado, siguiendo los lineamientos del procedimiento de control de documentos. Anexe tantas celdas como sea necesario y evalúe conscientemente cada documento que cita a continuación</td>
        </tr>
        <tr >
            <td>Codigo</td>
            <td>Nombre</td>
            <td>¿Se afecta? (SI / NO)</td>
        </tr>
        <?php
            foreach ($conn->query("SELECT * from detalle_codificacion WHERE id_codificacion_fk = $id_codificacion") as $row) { {
            ?>
        <tr>
            <td><?php echo $row["codigo_doc_afectado"] ?></td>
            <td><?php echo $row["nombre_doc_afectado"] ?></td>
            <td><?php echo $row["afecta"] ?></td>
        </tr>
        <?php }
         } ?>
    </table>
    <br>
    <table whidth="100">
        <tr>
            <td colspan="4">
                <center><B>DIFUSIONES - Interna</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Todos Colaboradores: <?php echo $todos_colaboradores; ?></td>
            <td>Sólo Líderes de Proceso: <?php echo $solo_lider; ?></td>
            <td>Sólo Miembros de un Proceso: <?php echo $miembros_proceso; ?></td>
            <td>Colaborador (s) Específico: <?php echo $colaborador_especifico; ?></td>
        </tr>
        <?php
            foreach ($conn->query("SELECT * from detalle_codificacion WHERE id_codificacion_fk = $id_codificacion") as $row) { {
            ?>
        <tr>
            <td colspan="2">Nombre: <?php echo $nombre_interna; ?></td>
            <td colspan="4">Correo: <?php echo $correo_interna; ?></td>
        </tr>
        <?php }
         } ?>
        
    </table>
    <br>

    <table whidth="100">
        <tr>
            <td colspan="4">
                <center><B>DIFUSIONES - Externa</B></center>
                <br>
            </td>
        </tr>
        <?php
            foreach ($conn->query("SELECT * from detalle_codificacion WHERE id_codificacion_fk = $id_codificacion") as $row) { {
            ?>
        <tr>
            <td colspan="2">Nombre: <?php echo $nombre_externa; ?></td>
            <td colspan="4">Correo: <?php echo $correo_externa; ?></td>
        </tr>
        <?php }
         } ?>
    </table>
    <table whidth="100">
        <tr>
            <td colspan="2">¿Se requiere envío de copia NO controlada del Documento, a las partes externas?: <?php echo $enviar_copia; ?></td>
        </tr>
    </table>
    <br>
    <table whidth="100">
        <tr>
            <td colspan="3">
                <center><B>Espacio reservado para el SIG</B></center>
                <br>
            </td>
        </tr>
        <tr >
            <td>Estado: <?php echo $estado_sig_codificacion; ?> </td>
            <td>Fecha: <?php echo $fecha_sig_codificacion; ?> </td>
            <td>Responsable: <?php echo $responsable_sig_codificacion; ?> </td>
        </tr>
    </table>
    <table whidth="100">
    <tr >
            <td>Causa de Rechazo: <?php echo $causa_rechazo_codificacion; ?> </td>
            <td>Evidencia de Difusión: <?php echo $evidencia_difucion; ?> </td>
        </tr>
    </table>

</body>

</html>
<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=documento.pdf");
echo $dompdf->output();
?>