<?php

require('php/conexion.php');
ob_start();
$id_acpm = $_GET['id_acpm'];


try {
    $stmt = $conn->prepare('SELECT * FROM acpm a
     INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
     INNER JOIN proceso p ON p.id_proceso = u.proceso_usuario_fk
     INNER JOIN cargos c ON c.id_cargo = u.id_cargo_fk
      WHERE a.id_consecutivo="' . $id_acpm . '" ');
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {

        while ($row = $stmt->fetch()) {
            $nombre_usuario = $row["nombre_usuario"];
            $apellidos_usuario = $row["apellidos_usuario"];
            $fecha_acpm = $row["fecha_acpm"];
            $nombre_proceso = $row["nombre_proceso"];
            $nombre_cargo = $row["nombre_cargo"];
            $siglas_usuario = $row["siglas_usuario"];
            $origen_acpm = $row["origen_acpm"];
            $fuente_acpm = $row["fuente_acpm"];
            $descripcion_fuente = $row["descripcion_fuente"];
            $tipo_acpm = $row["tipo_acpm"];
            $fecha_acpm = $row["fecha_acpm"];
            $descripcion_acpm = $row["descripcion_acpm"];
            $causa_acpm = $row["causa_acpm"];
            $nc_similar = $row["nc_similar"];
            $descripcion_nsc = $row["descripcion_nsc"];
            $correccion_acpm = $row["correccion_acpm"];
            $fecha_correccion = $row["fecha_correccion"];
            $estado_acpm = $row["estado_acpm"];
            $riesgo_acpm = $row["riesgo_acpm"];
            $justificacion_riesgo = $row["justificacion_riesgo"];
            $cambios_sig = $row["cambios_sig"];
            $justificacion_sig = $row["justificacion_sig"];
            $conforme_sig = $row["conforme_sig"];
            $justificacion_conforme_sig = $row["justificacion_conforme_sig"];
            $fecha_estado = $row["fecha_estado"];
            $fecha_finalizacion = $row["fecha_finalizacion"];
        }
    }
} catch (PDOException $e) {
    echo "Error en el servidor acpm";
}

$fecha = date("d/m/Y", strtotime($fecha_acpm));
$nombreImagen = "img/zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ACPM # <?php echo $id_acpm; ?></title>

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
        th {
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
                    <center>ACPM Nº <?php echo $id_acpm; ?></center>
                </h3>
            </th>
        </tr>
    </table>

    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> RESPONSABLE DE LA ACPM</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Siglas</td>
            <td><?php echo $siglas_usuario; ?></td>
            <td>Nombre</td>
            <td><?php echo $nombre_usuario; ?> <?php echo $apellidos_usuario; ?></td>
        </tr>
        <tr>
            <td>Cargo</td>
            <td><?php echo $nombre_cargo; ?></td>
            <td>Proceso</td>
            <td><?php echo $nombre_proceso; ?></td>
        </tr>
    </table>
    <br>

    <table whidth="100">
        <tr>
            <td colspan="4">
                <center><B>DETALLES ACPM</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Origen :</B></td>
            <td colspan="3">
                <?php echo $origen_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Fuente :</B></td>
            <td colspan="3">
                <?php echo $fuente_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Descripción Fuente :</B></td>
            <td colspan="3">
                <?php echo $descripcion_fuente; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Tipo :</B></td>
            <td colspan="3">
                <?php echo $tipo_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Fecha de Creación :</B></td>
            <td colspan="3">
                <?php echo $fecha_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Descripción ACPM :</B></td>
            <td colspan="3">
                <?php echo $descripcion_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Causa ACPM :</B></td>
            <td colspan="3">
                <?php echo $causa_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>No Conformidad Similar :</B></td>
            <td colspan="3">
                <?php echo $nc_similar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Descripción No Conformidad:</B></td>
            <td colspan="3">
                <?php echo $descripcion_nsc; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Corrección Inmediata:</B></td>
            <td colspan="3">
                <?php echo $correccion_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Fecha Corrección :</B></td>
            <td colspan="3">
                <?php echo $fecha_correccion; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Estado :</B></td>
            <td colspan="3">
                <?php echo $estado_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Riesgo ACPM :</B></td>
            <td colspan="3">
                <?php echo $riesgo_acpm; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Justificación del Riesgo :</B></td>
            <td colspan="3">
                <?php echo $justificacion_riesgo; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Cambios al SIG :</B></td>
            <td colspan="3">
                <?php echo $cambios_sig; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Justificación Cambios SIG:</B></td>
            <td colspan="3">
                <?php echo $justificacion_sig; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Conforme :</B></td>
            <td colspan="3">
                <?php echo $conforme_sig; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Justificación Conforme SIG :</B></td>
            <td colspan="3">
                <?php echo $justificacion_conforme_sig; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Fecha de Finalizacion :</B></td>
            <td colspan="3">
                <?php echo $fecha_finalizacion; ?>
            </td>
        </tr>

    </table>


    <br>
    <table>
        <tr>
            <th colspan="4">
                <center><B>DETALLE DE LAS ACTIVIDADES</B></center>
                <br>
            </th>
        </tr>

        <?php
        try {
            $stmt2 = $conn->prepare('SELECT * FROM actividades_acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario WHERE a.id_acpm_fk="' . $id_acpm . '"');
            $stmt2->execute();
            $registros = 1;
            if ($stmt2->rowCount() > 0) {

                while ($row2 = $stmt2->fetch()) {
                    $id_actividad = $row2['id_actividad'];
                    $fecha_actividad = $row2["fecha_actividad"];
                    $descripcion_actividad = $row2["descripcion_actividad"];
                    $estado_actividad = $row2["estado_actividad"];
                    $responsable = $row2["nombre_usuario"];
                    $apellido_responsable = $row2["apellidos_usuario"];
        ?>
                    <tr>
                        <td colspan="2">
                            <B>Fecha Finalización :</B> <br><?php echo $fecha_actividad; ?><br>
                            <B>Descripción : </B><br><?php echo $descripcion_actividad; ?><br>
                            <B>Responsable : </B><br><?php echo $responsable; ?> <?php echo $apellido_responsable; ?> <br>
                            <B>Estado : </B><br><?php echo $estado_actividad; ?><br>
                        </td>

                        <td colspan="2">
                            <?php

                            $query = 'SELECT * FROM detalle_actividad a INNER JOIN actividades_acpm u ON a.id_actividad_fk = u.id_actividad WHERE u.id_actividad = "' . $id_actividad . '"';
                            $result = $conn->query($query);
                            // Verificar si hay resultados
                            if ($result->rowCount() > 0) {
                                foreach ($result as $fila) {


                            ?>
                            <B>Fecha Finalización :</B><br> <?php echo $fila["fecha_evidencia"] ?><br>
                            <B>Recursos : </B><br><?php echo $fila["recursos"] ?><br>
                            <B>Descripción : </B><br><?php echo $fila['evidencia'] ?><br>
                            <hr>
                            <?php
                                }
                            }

                            ?>
                        </td>
                    </tr>
        <?php
                }
            }
        } catch (PDOException $e) {
            echo "Error en el servidor";
        }

        ?>


    </table>
<br>
    


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