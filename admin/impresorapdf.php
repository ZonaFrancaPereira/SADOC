<?php

require('php/conexion.php');
ob_start();
$id_mantenimiento_impresora = $_GET['id_mantenimiento_impresora'];

try {
    $stmt = $conn->prepare('SELECT * FROM mantenimiento_impresora a 
    INNER JOIN proceso b ON b.id_proceso = a.id_proceso_fk_2
    INNER JOIN usuarios d ON d.Id_usuario = a.Id_usuario_fk2
    INNER JOIN cargos e ON e.id_cargo = a.id_cargo_fk2
    WHERE a.id_impresora = "' . $id_mantenimiento_impresora . '" ');
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {

        while ($row = $stmt->fetch()) {
            $id_cargo_fk = $row["nombre_cargo"];
            $id_proceso_fk = $row["nombre_proceso"];
            $nombre_usuario = $row["nombre_usuario"];
            $apellidos_usuario = $row["apellidos_usuario"];
            $id_proceso_fk_2 = $row["id_proceso_fk_2"];
            $fecha_mantenimiento_impresora = $row["fecha_mantenimiento_impresora"];
            $Id_usuario_fk2 = $row["Id_usuario_fk2"];
            $id_cargo_fk2 = $row["id_cargo_fk2"];
            $correo_destinatario1 = $row["correo_destinatario1"];
            $nombre_impresora = $row["nombre_impresora"];
            $marca_impresora = $row["marca_impresora"];
            $modelo_impresora = $row["modelo_impresora"];
            $serial_impresora = $row["serial_impresora"];
            $soplar_exterior = $row["soplar_exterior"];
            $isopropilico = $row["isopropilico"];
            $toner = $row["toner"];
            $alinear = $row["alinear"];
            $verificar_cableado = $row["verificar_cableado"];
            $rodillos = $row["rodillos"];
            $reemplazar = $row["reemplazar"];
            $limpiar = $row["limpiar"];
            $imprimir = $row["imprimir"];
            $verificar = $row["verificar"];
            $estado_mantenimiento_impresora = $row["estado_mantenimiento_impresora"];
        }
    }
} catch (PDOException $e) {
    echo "Error en el servidor acpm";
}

$fecha = date("d/m/Y", strtotime($fecha_mantenimiento_impresora));
$nombreImagen = "img/zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FORMATO # <?php echo $id_mantenimiento_impresora; ?></title>

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
                    <center>FORMATO # <?php echo $id_mantenimiento_impresora; ?></center>
                </h3>
            </th>
        </tr>
    </table>

    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> RESPONSABLE DE LA IMPRESORA</B></center>
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
            <td><?php echo $fecha_mantenimiento_impresora; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> IMPRESORA</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Marca</td>
            <td><?php echo $marca_impresora; ?></td>
            <td>Modelo</td>
            <td><?php echo $modelo_impresora; ?></td>
        </tr>
        <tr>
            <td>Serie</td>
            <td><?php echo $serial_impresora; ?></td>
            <td>Nombre Impresora</td>
            <td><?php echo $nombre_impresora; ?></td>
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
            <td colspan="1"><B>Soplar y limpiar el exterior de la impresora:</B></td>
            <td colspan="3">
                <?php echo $soplar_exterior; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Limpiar el interior de la impresora con alcohol isopropilico:</B></td>
            <td colspan="3">
                <?php echo $isopropilico; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Revisar los niveles de tinta o tóner. :</B></td>
            <td colspan="3">
                <?php echo $toner; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Alinear el cabezal de impresión y ajustar la calidad de impresión :</B></td>
            <td colspan="3">
                <?php echo $alinear; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar que todos los cables estén correctamente conectados y en buen estado:</B></td>
            <td colspan="3">
                <?php echo $verificar_cableado; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Limpiar los rodillos de alimentación del papel con un paño húmedo :</B></td>
            <td colspan="3">
                <?php echo $rodillos; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Reemplazar los cartuchos de tinta o tóner según sea necesario :</B></td>
            <td colspan="3">
                <?php echo $reemplazar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Ejecutar la función de limpieza del cabezal de impresión para eliminar posibles obstrucciones.:</B></td>
            <td colspan="3">
                <?php echo $limpiar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Imprimir una página de prueba para verificar que la impresora funcione correctamente. :</B></td>
            <td colspan="3">
                <?php echo $imprimir; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar el funcionamiento de las funciones adicionales de la impresora, como la escaneo o la copia, si están disponibles en los equipos:</B></td>
            <td colspan="3">
                <?php echo $verificar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Estado :</B></td>
            <td colspan="3">
                <?php echo $estado_mantenimiento_impresora; ?>
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