<?php

require('php/conexion.php');
ob_start();
$id_mantenimiento_equipo = $_GET['id_mantenimiento_equipo'];

try {
    $stmt = $conn->prepare('SELECT m.*, p.nombre_proceso, u.*, c.nombre_cargo
    FROM mantenimientos m
    INNER JOIN proceso p ON m.id_proceso_fk = p.id_proceso
    INNER JOIN usuarios u ON m.Id_usuario_fk = u.Id_usuario
    INNER JOIN cargos c ON m.id_cargo_fk = c.id_cargo
    WHERE m.id_mantenimiento = "' . $id_mantenimiento_equipo . '" ');
    $stmt->execute();
    $registros = 1;
    if ($stmt->rowCount() > 0) {

        while ($row = $stmt->fetch()) {

            $id_proceso_fk = $row["nombre_proceso"];
            $fecha_mantenimiento = $row["fecha_mantenimiento"];
            $nombre_usuario = $row["nombre_usuario"];
            $apellidos_usuario = $row["apellidos_usuario"];
            $id_cargo_fk = $row["nombre_cargo"];
            $marca = $row["marca"];
            $modelo = $row["modelo"];
            $serie = $row["serie"];
            $usuario_equipo = $row["usuario_equipo"];
            $soplar_partes_externas = $row["soplar_partes_externas"];
            $verificar_usuario = $row["verificar_usuario"];
            $liberar_espacio = $row["liberar_espacio"];
            $actualizar_logos = $row["actualizar_logos"];
            $lubricar_puertos = $row["lubricar_puertos"];
            $verificar_contraseñas = $row["verificar_contraseñas"];
            $desinstalar_programas = $row["desinstalar_programas"];
            $organizar_cableado = $row["organizar_cableado"];
            $limpieza_equipo = $row["limpieza_equipo"];
            $formato_asignacion_equipo = $row["formato_asignacion_equipo"];
            $desfragmentar = $row["desfragmentar"];
            $limpiar_partes_interna = $row["limpiar_partes_interna"];
            $depurar_temporales = $row["depurar_temporales"];
            $verificar_actualizaciones = $row["verificar_actualizaciones"];
            $usuario = $row["usuario"];
            $clave = $row["clave"];
            $estandar = $row["estandar"];
            $administrador = $row["administrador"];
            $analisis_completo = $row["analisis_completo"];
            $bloqueo_usb = $row["bloqueo_usb"];
            $dominio_zfip = $row["dominio_zfip"];
            $apagar_pantalla = $row["apagar_pantalla"];
            $estado_suspension = $row["estado_suspension"];
            $firma = $_POST["firma"];
            $estado_mantenimiento_equipo = $row["estado_mantenimiento_equipo"];
            $firma_usuario = $row["firma_usuario"];
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
    <title>FORMATO # <?php echo $id_mantenimiento_equipo; ?></title>

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
                    <center>FORMATO # <?php echo $id_mantenimiento_equipo; ?></center>
                </h3>
            </th>
        </tr>
    </table>

    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> RESPONSABLE DEL EQUIPO DE COMPUTO</B></center>
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
            <td><?php echo $fecha_mantenimiento; ?></td>
        </tr>
    </table>
    <br>
    <table border="1" whidth="100">
        <tr>
            <td colspan="4">
                <center><B> EQUIPO DE COMPUTO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td>Marca</td>
            <td><?php echo $marca; ?></td>
            <td>Modelo</td>
            <td><?php echo $modelo; ?></td>
        </tr>
        <tr>
            <td>Serie</td>
            <td><?php echo $serie; ?></td>
            <td>Nombre Usuario</td>
            <td><?php echo $usuario_equipo; ?></td>
        </tr>
    </table>
    <br>
    <table whidth="100">
        <tr>
            <td colspan="4">
                <center><B>EQUIPO DE COMPUTO</B></center>
                <br>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Soplar partes externas, equipo completo y área de trabajo, telefono. :</B></td>
            <td colspan="3">
                <?php echo $soplar_partes_externas; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar usuario estandar y administrador. :</B></td>
            <td colspan="3">
                <?php echo $verificar_usuario; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Liberar espacio en disco :</B></td>
            <td colspan="3">
                <?php echo $liberar_espacio; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Actualizar logos de perfil de usuarios y cambiar fondos, sincronizar logos y fondos :</B></td>
            <td colspan="3">
                <?php echo $actualizar_logos; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Lubricar puertos, conectores, contactos y bisagras con CRC o 3 en 1, isopropilico :</B></td>
            <td colspan="3">
                <?php echo $lubricar_puertos; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar contraseñas guardadas en los navegadores :</B></td>
            <td colspan="3">
                <?php echo $verificar_contraseñas; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Desinstalar programas innecesarios y no licenciados :</B></td>
            <td colspan="3">
                <?php echo $desinstalar_programas; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar y organizar cableado de red y otros.:</B></td>
            <td colspan="3">
                <?php echo $organizar_cableado; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Limpieza de equipo completo, cables y accesorios :</B></td>
            <td colspan="3">
                <?php echo $limpieza_equipo; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar y constatar elementos del formato asignación de equipos:</B></td>
            <td colspan="3">
                <?php echo $formato_asignacion_equipo; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Desfragmentar todas las unidades de disco :</B></td>
            <td colspan="3">
                <?php echo $desfragmentar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Soplar y limpiar partes interna equipo completo. :</B></td>
            <td colspan="3">
                <?php echo $limpiar_partes_interna; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Depurar temporales, vaciar Visor de Eventos (temp/ %temp%):</B></td>
            <td colspan="3">
                <?php echo $depurar_temporales; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Verificar actualizaciones pendientes e instalarlas, reiniciar sistema :</B></td>
            <td colspan="3">
                <?php echo $verificar_actualizaciones; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Usuario :</B></td>
            <td colspan="3">
                <?php echo $usuario; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Clave :</B></td>
            <td colspan="3">
                <?php echo $clave; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Estandar :</B></td>
            <td colspan="3">
                <?php echo $estandar; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Administrador :</B></td>
            <td colspan="3">
                <?php echo $administrador; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Analisis Completo :</B></td>
            <td colspan="3">
                <?php echo $analisis_completo; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Bloqueo de memorias USB :</B></td>
            <td colspan="3">
                <?php echo $bloqueo_usb; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Dentro del Dominio de ZFIP :</B></td>
            <td colspan="3">
                <?php echo $dominio_zfip; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Apagar pantalla a los 3 min :</B></td>
            <td colspan="3">
                <?php echo $apagar_pantalla; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Poner el equipo en estado de suspensión 10 minutos :</B></td>
            <td colspan="3">
                <?php echo $estado_suspension; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1"><B>Estado :</B></td>
            <td colspan="3">
                <?php echo $estado_mantenimiento_equipo; ?>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <center><B>FIRMA</B></center>
                <br>
            </td>
           <td colspan="3"><br><br><br><br>
           
				<center><img src="<?php echo $firmar; ?>" alt="" width="180"></center>
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