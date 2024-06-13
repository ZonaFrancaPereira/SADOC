<?php
require('php/conexion.php');
ob_start();
$id_usuario = $_GET['id_usuario'];


try {
  $stmt = $conn->prepare('SELECT u.*,r.*,p.*,c.*,ti.nombre_usuario AS nombre_ti, ti.apellidos_usuario AS apellidos_ti,ti.firma_usuario AS firma_ti
        FROM  asignacion_equipos r
        INNER JOIN usuarios u
        ON r.id_usuario_fk=u.Id_usuario
        INNER JOIN proceso p
        ON p.id_proceso=u.proceso_usuario_fk
        INNER JOIN cargos c
        ON c.id_cargo=u.id_cargo_fk
        INNER JOIN usuarios ti
        ON r.id_ti_fk=ti.Id_usuario                             
        WHERE  r.estado_asignacion = "Activa" ');
  $stmt->execute();
  $registros = 1;
  if ($stmt->rowCount() > 0) {

    while ($row = $stmt->fetch()) {
      $id_usuario= $row["Id_usuario"];
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

		td{
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

		tr:nth-child(even) {
			background-color: #dddddd;
		}

		.sinBorde{
			border: 0;
		}
		.titulo{
			border: 0;
			text-align: center;
			
		
		}

		.sinBorde tr {
			border: 1px solid #ccc
		}
	</style>
	<table>
		<tr class="sinBorde">
			<td class="sinBorde"><img src="<?php echo $imagenBase64; ?>" alt="" width="140"></td>
			<td class="titulo">
				<h3>
					ASIGNACIÓN DE EQUIPOS TECNOLÓGICOS Nº <?php echo $id_asignacion; ?>
				</h3>
			</td>
		</tr>
	</table>

	<table >
		
		<tr>
		<td>Datos</td>
			<td>Nombre de Usuario</td>
			<td><?php echo $siglas_usuario; ?></td>
            <td>DD-MM-AA</td>
			<td><?php echo $fecha_asignacion; ?></td>
		</tr>
		<tr>
			<td>Proceso</td>
			<td colspan="4"><?php echo $nombre_proceso; ?></td>
		</tr>
        <tr>
			<td>Responsable</td>
			<td colspan="4"><?php echo $nombre_usuario ." ".$apellidos_usuario; ?></td>
		</tr>
        <tr>
			<td>Cargo Funcionario</td>
			<td colspan="4"><?php echo $nombre_cargo; ?></td>
		</tr>
	</table>
	<br>
	<table>
	
		<tr>
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
					<tr >
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
		<tr>
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
            $id_usuario= $row["Id_usuario"];
            ?>
     <table>
        <tr>   
            <th colspan="4"><?php echo $row["id_activo"];  ?> <?php echo $row["nombre_articulo"];  ?></th>
        </tr>
        <tr>
            <th colspan="4">Software</th>
        </tr>
        <tr>
         <th colspan="2">Elemento</th>
         <th colspan="2">Licencia</th>
        </tr>
        <tr>
            <td colspan="2">MSD</td>
            <td colspan="2"><?php echo $row["msd"];  ?></td>
        </tr>
        <tr>
            <td colspan="2">AutoCAD LT</td>
            <td colspan="2"><?php echo $row["autocad"];  ?></td>
        </tr>
        <tr>
            <td colspan="2">Antivirus</td>
            <td colspan="2"><?php echo $row["antivirus"];  ?></td>
        </tr>
     </table>
  <?php
            $registros++;
          }
        }
      } catch (PDOException $e) {
        echo "Error en el servidor";
      }
      
    ?>
	<table >
		<tr>
			<th colspan="3">
				Quien Entrega :
	</th>
		</tr>

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
	<table >
		<tr>
			<th colspan="3">
				Quien Recibe :
	</th>
		</tr>

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