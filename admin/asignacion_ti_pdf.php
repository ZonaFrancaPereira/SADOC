<?php
require('php/conexion.php');
ob_start();
$id_usuario = $_GET['id_usuario'];


try {
	$stmt = $conn->prepare("SELECT u.*,r.*,p.*,c.*,ti.nombre_usuario AS nombre_ti, ti.apellidos_usuario AS apellidos_ti,ti.firma_usuario AS firma_ti
        FROM  asignacion_equipos r
        INNER JOIN usuarios u
        ON r.id_usuario_fk=u.Id_usuario
        INNER JOIN proceso p
        ON p.id_proceso=u.proceso_usuario_fk
        INNER JOIN cargos c
        ON c.id_cargo=u.id_cargo_fk
        INNER JOIN usuarios ti
        ON r.id_ti_fk=ti.Id_usuario                             
        WHERE  r.estado_asignacion = 'Activa' AND r.id_usuario_fk= '.$id_usuario.'");
	$stmt->execute();
	$registros = 1;
	if ($stmt->rowCount() > 0) {

		while ($row = $stmt->fetch()) {
			$id_usuario = $row["Id_usuario"];
			$id_asignacion = $row["id_asignacion"];
			$fecha_asignacion = $row["fecha_asignacion"];
			$nombre_ti = $row["nombre_ti"];
			$apellidos_ti = $row["apellidos_ti"];
			$nombre_usuario = $row["nombre_usuario"];
			$apellidos_usuario = $row["apellidos_usuario"];
			$observaciones_asignacion = $row["observaciones_asignacion"];
			$nombre_cargo = $row["nombre_cargo"];
			$siglas_usuario = $row["siglas_usuario"];
			$nombre_proceso = $row["nombre_proceso"];
			$firma_usuario = $row["firma_usuario"];
			$firma_ti = $row["firma_ti"];
			$observaciones_asignacion = $row["observaciones_asignacion"];
			$registros++;
		}
	}
} catch (PDOException $e) {
	echo "Error en el servidor";
}

$fecha = date("d/m/Y", strtotime($fecha_orden));
$nombreImagen = "img/logo_pdf.jpg";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
$firmati = "firmas/" . $firma_ti;
$firma_entrega = "data:image/png;base64," . base64_encode(file_get_contents($firmati));
$firmau = "firmas/" . $firma_usuario;
$firma_recibe = "data:image/png;base64," . base64_encode(file_get_contents($firmau));


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>ASIGNACIÓN DE EQUIPOS TECNOLÓGICOS # <?php echo $id_asignacion; ?></title>

</head>

<body>
	<style>
		body {
			font-family: arial, sans-serif;
		}

		table {

			border-collapse: collapse;
			width: 100%;
		}

		td {
			border: 1px solid #ccc;
			text-align: left;
			padding: 8px;
			font-size: 9;
		}

		th {
			border: 1px solid #ccc;
			text-align: center;
			padding: 8px;
			font-size: 10;
		}

		.encabezado {
			background-color: #9DC066;
			color: white;
			font-weight: bold;
		}
		.subtitulo{
			background-color: #1E95B9;
			color: white;
			font-weight: bold;
		}

		.sinBorde {
			border: 0;
		
			text-align: left;
		}

		.titulo {
			border: 0;
			text-align: right;
			font-weight: bold;
		
		}

		.sinBorde tr {
			border: 1px solid #ccc;
			text-align: left;
		}
		.texto{
			font-weight: bold;
		}
		.respuesta{
			text-align: center;
		}
	</style>
	<table>
		<tr >
			<td class="sinBorde"><img src="<?php echo $imagenBase64; ?>" alt="" width="140" ></td>
			<td class="titulo">
				<h3>
					ASIGNACIÓN DE EQUIPOS TECNOLÓGICOS Nº <?php echo $id_asignacion; ?>
				</h3>
			</td>
		</tr>
	</table>

	<table>

		<tr class="texto">
			<td>Datos</td>
			<td>Nombre de Usuario</td>
			<td><?php echo $siglas_usuario; ?></td>
			<td>DD-MM-AA</td>
			<td><?php echo $fecha_asignacion; ?></td>
		</tr>
		<tr>
			<td class="texto">Proceso</td>
			<td class="respuesta" colspan="4"><?php echo $nombre_proceso; ?></td>
		</tr>
		<tr>
			<td class="texto">Responsable</td>
			<td class="respuesta" colspan="4"><?php echo $nombre_usuario . " " . $apellidos_usuario; ?></td>
		</tr>
		<tr>
			<td class="texto">Cargo Funcionario</td>
			<td class="respuesta" colspan="4"><?php echo $nombre_cargo; ?></td>
		</tr>
	</table>
	<br>
	<table>

		<tr class="encabezado">
			<th># Activo</th>
			<th>Elemento</th>
			<th>Serial</th>
			<th>Marca</th>
			<th>Estado</th>
		</tr>
		<?php
		try {
			$stmt = $conn->prepare("
    SELECT  
        u.Id_usuario, u.correo_usuario, u.contrasena_usuario, u.nombre_usuario, u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario, u.dia_backup, u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk, 
        a.id_activo, a.fecha_asignacion, a.nombre_articulo, a.descripcion_articulo, a.modelo_articulo, a.referencia_articulo, a.marca_articulo, a.tipo_articulo, a.ip, a.windows, a.office, a.factura_office, a.lugar_articulo, a.observaciones_articulo, a.numero_factura, a.fecha_garantia, a.valor_articulo, a.condicion_articulo, a.id_proveedor_fk, a.descripcion_proveedor, a.id_usuario_fk, a.estado_activo, 
        a.recurso_tecnologico, -- Se eliminó la coma redundante
        p.id_proveedor, p.nombre_proveedor, p.contacto_proveedor, p.telefono_proveedor, p.id_usuario_fk
    FROM 
        activos a
    INNER JOIN 
        usuarios u ON u.Id_usuario = a.id_usuario_fk
    INNER JOIN 
        proveedor_compras p ON a.id_proveedor_fk = p.id_proveedor 
    WHERE  
        a.id_usuario_fk = '$id_usuario' AND a.recurso_tecnologico <> 'No aplica'
");
			$stmt->execute();
			$registros = 1;
			if ($stmt->rowCount() > 0) {

				while ($row = $stmt->fetch()) {

		?>
					<tr>
						<td><?php echo $row["id_activo"]; ?></td>
						<td><?php echo $row["nombre_articulo"];  ?></td>
						<td><?php echo $row["referencia_articulo"] ?></td>
						<td><?php echo $row["marca_articulo"] ?></td>
						<td><?php echo $row["estado_activo"] ?></td>
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


	<table>
		<tr class="encabezado">
			<th>
				Observaciones
			</th>
		</tr>
		<tr>
			<td><?php echo $observaciones_asignacion; ?></td>
		</tr>
	</table>
	<br>
	<?php
	try {
		$stmt = $conn->prepare("SELECT u.*,a.*,e.*
              FROM  detalles_equipos e
              INNER JOIN activos a
              ON a.id_activo=e.id_activo_fk  
              INNER JOIN usuarios u
              ON a.id_usuario_fk=u.Id_usuario                            
              WHERE  u.id_usuario = '$id_usuario '");
		$stmt->execute();
		$registros = 1;
		if ($stmt->rowCount() > 0) {

			while ($row = $stmt->fetch()) {
				$id_usuario = $row["Id_usuario"];
	?>
				<table>
					<tr class="encabezado">
						<th colspan="2"><?php echo $row["id_activo"];  ?> <?php echo $row["nombre_articulo"];  ?></th>
					</tr>
				</table>
				<table>
					<tr class="subtitulo">
						<th colspan="4">Software</th>
					</tr>
					<tr class="texto">
						<td>Elemento</td>
						<td>Licencia</td>
						<td>Elemento</td>
						<td>Licencia</td>
					</tr>
					<tr>
						<td class="texto">MSD</td>
						<td><?php echo $row["msd"];  ?></td>
						<td class="texto">AutoCAD LT</td>
						<td><?php echo $row["autocad"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Antivirus</td>
						<td><?php echo $row["antivirus"];  ?></td>
						<td class="texto">Microsoft Office</td>
						<td><?php echo $row["office"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Visio Pro</td>
						<td><?php echo $row["visio_pro"];  ?></td>
						<td class="texto">Appolo ZF</td>
						<td><?php echo $row["appolo"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Mac OSX</td>
						<td><?php echo $row["mac_osx"];  ?></td>
						<td class="texto">Zeus Tecnología </td>
						<td><?php echo $row["zeus"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Windows</td>
						<td><?php echo $row["windows"];  ?></td>
						<td class="texto">Otros </td>
						<td><?php echo $row["otros"];  ?></td>
					</tr>
				</table>
				<br>
				<table>
					<tr class="subtitulo">
						<th colspan="4">Hardware</th>
					</tr>
					<tr class="texto">
						<td>Elemento</td>
						<td>Característica</td>
						<td>Elemento</td>
						<td>Característica</td>
					</tr>
					<tr>
						<td class="texto">Procesador</td>
						<td><?php echo $row["procesador"];  ?></td>
						<td class="texto">CD-DVD</td>
						<td><?php echo $row["cd_dvd"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Disco Duro</td>
						<td><?php echo $row["disco_duro"];  ?></td>
						<td class="texto">Tarjeta Video </td>
						<td><?php echo $row["tarjeta_video"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Memoria RAM</td>
						<td><?php echo $row["memoria_ram"];  ?></td>
						<td class="texto">Tarjeta Red </td>
						<td><?php echo $row["tarjeta_red"];  ?></td>
					</tr>
				</table>
				<br>

				<table>
					<tr class="subtitulo">
						<th colspan="4">Seguridad Básica de Equipos</th>
					</tr>
					
					<tr>
						<td class="texto">Tipo de Red</td>
						<td><?php echo $row["tipo_red"];  ?></td>
						<td class="texto">¿Cuenta con Tiempo de Bloqueo? </td>
						<td><?php echo $row["tiempo_bloqueo"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Usuario</td>
						<td><?php echo $row["usuario"];  ?></td>
						<td class="texto">Contraseña </td>
						<td><?php echo $row["clave"];  ?></td>
					</tr>
					<tr>
						<td class="texto">Dentro de Zona Franca </td>
						<td><?php echo $row["zfip"];  ?></td>
						<td class="texto">Privilegios</td>
						<td><?php echo $row["privilegios"];  ?></td>
					</tr>
				</table>
				<br>
	
				<table>
					<tr class="subtitulo">
						<th colspan="4">Copias de Seguridad</th>
					</tr>
					
					<tr>
						<td class="texto">Carpeta en Red</td>
						<td><?php echo $row["backup"];  ?></td>
						<td class="texto">¿Realiza copias de seguridad en otro equipo? </td>
						<td><?php echo $row["realiza_backup"];  ?></td>
					</tr>
					<tr>
						<td class="texto">¿Donde y porque?</td>
						<td><?php echo $row["justificacion_backup"];  ?></td>
						<td class="texto">Dia Asignado </td>
						<td><?php echo $row["dia_backup"];  ?></td>
					</tr>
					
				</table>
				
	
				<br>
	<?php
				$registros++;
			}
		}
	} catch (PDOException $e) {
		echo "Error en el servidor";
	}

	?>
	<table>
		<tr class="encabezado">
			<th colspan="3">
				Quien Entrega :
			</th>
		</tr>

		</table>
		
	<table>
		<tr>
			<td colspan="1">Nombre :</td>
			<td colspan="2">
				<?php echo $nombre_ti . " " . $apellidos_ti; ?>

			</td>
		</tr>
		<tr>
			<td colspan="1">Firma :</td>
			<td colspan="2">
				<img src="<?php echo $firma_entrega; ?>" alt="" width="80">
			</td>
		</tr>

	</table>
	<br>
	<table>
		<tr class="encabezado">
			<th colspan="3">
				Quien Recibe :
			</th>
		</tr>

		</table>
		
	<table>
		<tr>
			<td colspan="1">Nombre :</td>
			<td colspan="2">
				<?php echo $nombre_usuario . " " . $apellidos_usuario; ?>

			</td>
		</tr>
		<tr>
			<td colspan="1">Firma :</td>
			<td colspan="2">
				<img src="<?php echo $firma_recibe; ?>" alt="" width="80">
			</td>
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