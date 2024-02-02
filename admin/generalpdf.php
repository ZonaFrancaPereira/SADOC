<?php

require('php/conexion.php');
ob_start();
$id_mantenimiento_general = $_GET['id_mantenimiento_general'];

try {
    $stmt = $conn->prepare('SELECT * FROM mantenimiento_general f
    INNER JOIN proceso g ON g.id_proceso = f.id_proceso_fk_3
    INNER JOIN usuarios h ON h.Id_usuario = f.Id_usuario_fk3
    INNER JOIN cargos i ON i.id_cargo = f.id_cargo_fk3
    WHERE f.id_general = "' . $id_mantenimiento_general . '" ');
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {

        while ($row = $stmt->fetch()) {
            $id_cargo_fk = $row["nombre_cargo"];
            $id_proceso_fk = $row["nombre_proceso"];
            $nombre_usuario = $row["nombre_usuario"];
            $apellidos_usuario = $row["apellidos_usuario"];
            $id_proceso_fk_3 = $row["id_proceso_fk_3"];
            $fecha_mantenimiento3 = $row["fecha_mantenimiento3"];
            $Id_usuario_fk3 = $row["Id_usuario_fk3"];
            $id_cargo_fk3 = $row["id_cargo_fk3"];
            $correo_destinatario2 = $row["correo_destinatario2"];
            $articulo = $row["articulo"];
            $marca_general = $row["marca_general"];
            $modelo_general = $row["modelo_general"];
            $serial_general = $row["serial_general"];
            $partes_externas = $row["partes_externas"];
            $condiciones_fisicas = $row["condiciones_fisicas"];
            $cableado_verificar = $row["cableado_verificar"];
            $dispositivo = $row["dispositivo"];
            $estado_general = $row["estado_general"];
        }
    }
} catch (PDOException $e) {
    echo "Error en el servidor acpm";
}

$fecha = date("d/m/Y", strtotime($fecha_mantenimiento3));
$nombreImagen = "img/zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FORMATO # <?php echo $id_mantenimiento_general; ?></title>

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
                    <center>FORMATO # <?php echo $id_mantenimiento_general; ?></center>
                </h3>
            </th>
        </tr>
    </table>

    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> RESPONSABLE DEL ARTICULO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $nombre_usuario; ?> <?php echo $apellidos_usuario; ?></td>
            <td>Proceso</td>
            <td><?php echo $id_proceso_fk; ?></td>
        </tr>
        <tr>
            <td>Cargo</td>
            <td><?php echo $id_cargo_fk; ?></td>
            <td>Fecha (DD-MM-AA)</td>
            <td><?php echo $fecha_mantenimiento3; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> ARTICULO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Marca</td>
            <td><?php echo $marca_general; ?></td>
            <td>Modelo</td>
            <td><?php echo $modelo_general; ?></td>
        </tr>
        <tr>
            <td>Serie</td>
            <td><?php echo $serial_general; ?></td>
            <td>Nombre del Articulo</td>
            <td><?php echo $articulo; ?></td>
        </tr>
    </table>
    <br>
    <table whidth="100">
        <tr>
            <td colspan="4">
                <center><B>MANTENIMIENTO A REALIZAR</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Soplar y limpiar partes externas (Utilizar insumos adecuadados para el dispositivo / articulo):</B></td>
            <td colspan="3">
                <?php echo $partes_externas; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar las condiciones fisicas del dispositivo / articulo:</B></td>
            <td colspan="3">
                <?php echo $condiciones_fisicas; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Dependiendo del dispositivo si cuenta con cableado verificar su estado, limpiar y organizar cableado.:</B></td>
            <td colspan="3">
                <?php echo $cableado_verificar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Soplar y limpiar lugar donde se encuentra ubicado el dispositivo / articulo :</B></td>
            <td colspan="3">
                <?php echo $dispositivo; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Estado:</B></td>
            <td colspan="3">
                <?php echo $estado_general; ?>
            </td>
        </tr>
    </table>


    <br>
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