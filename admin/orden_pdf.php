<?php
require('php/conexion.php');
ob_start();
$id_orden = $_GET['id_orden'];
try {
	$stmt = $conn->prepare('SELECT u.Id_usuario, u.correo_usuario,
                                  u.contrasena_usuario, u.nombre_usuario,u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario,
                                  u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk,p.id_proveedor,p.nombre_proveedor,p.contacto_proveedor,p.telefono_proveedor,p.id_usuario_fk,
								  o.id_orden, o.fecha_orden, o.proveedor_recurrente, o.forma_pago, o.tiempo_pago, o.porcentaje_anticipo, o.condiciones_negociacion, o.comentario_orden, o.tiempo_entrega, o.total_orden, 
								  o.analisis_cotizacion, o.estado_orden, o.descripcion_declinado, o.fecha_aprobacion, o.id_cotizante, o.id_proveedor_fk, o.id_gerente,
								  d.id_orden_detalle, d.articulo_compra, d.cantidad_orden, d.valor_neto, d.valor_iva, d.valor_total, d.observaciones_articulo, d.id_orden_compra,car.id_cargo, car.nombre_cargo
                                  FROM orden_compra o
                                  INNER JOIN detalle_orden d
                                  ON o.id_orden= d.id_orden_compra
								  INNER JOIN proveedor_compras p
								  ON p.id_proveedor=o.id_proveedor_fk
								  INNER JOIN usuarios u
								  ON u.Id_usuario=o.id_cotizante
								  INNER JOIN cargos car
								  ON car.id_cargo=u.id_cargo_fk
								  WHERE o.id_orden="' . $id_orden . '"
								  ');
	$stmt->execute();
	$registros = 1;
	if ($stmt->rowCount() > 0) {

		while ($row = $stmt->fetch()) {
			$fecha_orden = $row["fecha_orden"];
			$id_proveedor = $row["id_proveedor"];
			$nombre_proveedor = $row["nombre_proveedor"];
			$correo_proveedor = $row["contacto_proveedor"];
			$telefono_proveedor = $row["telefono_proveedor"];
			$forma_pago = $row["forma_pago"];
			$tiempo_pago = $row["tiempo_pago"];
			$porcentaje_anticipo = $row["porcentaje_anticipo"];
			$condiciones_negociacion = $row["condiciones_negociacion"];
			$comentario_orden = $row["comentario_orden"];
			$tiempo_entrega = $row["tiempo_entrega"];
			$nombre_usuario = $row["nombre_usuario"];
			$apellidos_usuario = $row["apellidos_usuario"];
			$nombre_cargo = $row["nombre_cargo"];
			$firma_usuario = $row["firma_usuario"];
			$id_gerente = $row["id_gerente"];
			$fecha_aprobacion = $row["fecha_aprobacion"];
		}
	}
} catch (PDOException $e) {
	echo "Error en el servidor";
}
try {
	$stmt = $conn->prepare('SELECT u.Id_usuario, u.correo_usuario,
                                  u.contrasena_usuario, u.nombre_usuario,u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario,
                                  u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk,o.id_orden,o.id_gerente,car.id_cargo, car.nombre_cargo
                                  FROM orden_compra o
    
								  INNER JOIN usuarios u
								  ON u.Id_usuario=o.id_gerente
								  INNER JOIN cargos car
								  ON car.id_cargo=u.id_cargo_fk
								  WHERE o.id_gerente="' . $id_gerente . '"
								  ');
	$stmt->execute();
	$registros = 1;
	if ($stmt->rowCount() > 0) {

		while ($row = $stmt->fetch()) {
			$nombre_gerente = $row["nombre_usuario"];
			$apellidos_gerente = $row["apellidos_usuario"];
			$nombre_cargog = $row["nombre_cargo"];
			$firma_gerente = $row["firma_usuario"];
		}
	}
} catch (PDOException $e) {
	echo "Error en el servidor";
}
$fecha = date("d/m/Y", strtotime($fecha_orden));
$nombreImagen = "img/zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
$firma = "firmas/" . $firma_usuario;
$firma_cotizante = "data:image/png;base64," . base64_encode(file_get_contents($firma));
if ($firma_gerente == "") {
	$firmag = "firmas/noautorizado.png";
	$gerente = "data:image/png;base64," . base64_encode(file_get_contents($firmag));
} else {
	$firmag = "firmas/" . $firma_gerente;
	$gerente = "data:image/png;base64," . base64_encode(file_get_contents($firmag));
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Orden de Compra # <?php echo $id_orden; ?></title>

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
			font-size: 8;
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
					<center>ORDEN DE COMPRA Nº <?php echo $id_orden; ?></center>
				</h3>
			</th>
		</tr>
	</table>

	<table border="1" whidth="100">
		<tr>
			<td colspan="4">
				<center><B> Datos Proveedor</B></center>
			</td>
		</tr>
		<tr>
			<td>Fecha</td>
			<td><?php echo $fecha; ?></td>
			<td>Proveedor</td>
			<td><?php echo $nombre_proveedor; ?></td>
		</tr>
		<tr>
			<td>Contacto</td>
			<td><?php echo $correo_proveedor; ?></td>
			<td>Telefono</td>
			<td><?php echo $telefono_proveedor; ?></td>
		</tr>
	</table>
	<br>
	<table>
		<tr>
			<th colspan="6">
				<center><B>Detalle Orden de Compra</B></center>
			</th>
		</tr>
		<tr>
			<th>Articulo</th>
			<th>Cantidad</th>
			<th>Valor Unitario</th>
			<th>Valor Iva</th>
			<th>Total</th>
			<th>Descripción</th>
		</tr>
		<?php
		try {
			$stmt = $conn->prepare('SELECT u.Id_usuario, u.correo_usuario,
										  u.contrasena_usuario, u.nombre_usuario,u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario,
										  u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk,p.id_proveedor,p.nombre_proveedor,p.contacto_proveedor,p.telefono_proveedor,p.id_usuario_fk,
										  o.id_orden, o.fecha_orden, o.proveedor_recurrente, o.forma_pago, o.tiempo_pago, o.porcentaje_anticipo, o.condiciones_negociacion, o.comentario_orden, o.tiempo_entrega, o.total_orden, 
										  o.analisis_cotizacion, o.estado_orden, o.descripcion_declinado, o.fecha_aprobacion, o.id_cotizante, o.id_proveedor_fk, o.id_gerente,
										  d.id_orden_detalle, d.articulo_compra, d.cantidad_orden, d.valor_neto, d.valor_iva, d.valor_total, d.observaciones_articulo, d.id_orden_compra
										  FROM orden_compra o
										  INNER JOIN detalle_orden d
										  ON o.id_orden= d.id_orden_compra
										  INNER JOIN proveedor_compras p
										  ON p.id_proveedor=o.id_proveedor_fk
										  INNER JOIN usuarios u
										  ON u.Id_usuario=o.id_cotizante
										  WHERE o.id_orden="' . $id_orden . '"
										  ');
			$stmt->execute();
			$registros = 1;
			if ($stmt->rowCount() > 0) {

				while ($row = $stmt->fetch()) {
					$articulo_compra = $row["articulo_compra"];
					$cantidad_orden = $row["cantidad_orden"];
					$valor_neto = $row["valor_neto"];
					$valor_iva = $row["valor_iva"];
					$valor_total = $row["valor_total"];
					$total_orden = $row["total_orden"];
					$observaciones_articulo = $row["observaciones_articulo"];
					echo "
					<tr >
					<td>" . $articulo_compra . "</td>
					<td>" . $cantidad_orden . "</td>
					<td>$ " . number_format($valor_neto) . "</td>
					<td>$ " . number_format($valor_iva) . "</td>
					<td>$ " . number_format($valor_total) . "</td>
					<td>" . $observaciones_articulo . "</td>
					</tr>";
				}
			}
		} catch (PDOException $e) {
			echo "Error en el servidor";
		}

		?>
		<tr>
			<td colspan="4">Total</td>
			<td colspan="2">$ <?php echo number_format($total_orden); ?></td>
		</tr>

	</table>
	
	<table whidth="100">
		<tr>
			<td colspan="3">
				<center><B>Detalles Forma de Pago</B></center>
			</td>
		</tr>
		<tr>
			<td><B>Forma de Pago : </B> <?php echo $forma_pago; ?></td>
			<td><B>Tiempo (Dias) </B> <?php echo $tiempo_pago; ?></td>
			<td><B>Porcentaje Anticipo : </B> <?php echo $porcentaje_anticipo; ?> %</td>
		</tr>
		<tr>
			<td><B>Otras condiciones de negociación</B></td>
			<td colspan="2"><?php echo $porcentaje_anticipo; ?></td>
		</tr>
	</table>

	<table whidth="100">
		<tr>
			<td>
				<center><B>Comentarios</B></center>
			</td>
		</tr>
		<tr>
			<td><?php echo $comentario_orden; ?></td>
		</tr>
	</table>
	<br>
	<table whidth="100">
		<tr>
			<td colspan="3">
				<center><B>Cotizado por :</B></center>
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Tiempo de Entrega :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B></td>
			<td colspan="2">
				<center><?php echo $tiempo_entrega; ?></center>
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Firma :</B></td>
			<td colspan="2">
				<center><img src="<?php echo $firma_cotizante; ?>" alt="" width="100">
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Cotizado por :</B></td>
			<td colspan="2">
				<center><?php echo $nombre_usuario . " " . $apellidos_usuario; ?>
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Cargo :</B></td>
			<td colspan="2">
				<center><?php echo $nombre_cargo; ?>
			</td>
		</tr>
	</table>
	
	<table whidth="100">
		<tr>
			<td colspan="3">
				<center><B>Autorizado por :</B></center>
			</td>
		</tr>

		<tr>
			<td colspan="1"><B>Firma :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B></td>
			<td colspan="2">
				<center><img src="<?php echo $gerente; ?>" alt="" width="80">
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Aprobo :</B></td>
			<td colspan="2">
				<center><?php echo $nombre_gerente . " " . $apellidos_gerente; ?>
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Cargo :</B></td>
			<td colspan="2">
				<center><?php echo $nombre_cargog; ?>
			</td>
		</tr>
		<tr>
			<td colspan="1"><B>Fecha Aprobación :</B></td>
			<td colspan="2">
				<center><?php echo $fecha_aprobacion; ?>
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