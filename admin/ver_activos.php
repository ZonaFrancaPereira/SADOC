<?php
$id_activo = $_GET['id_activo'];
require('php/conexion.php');

try {
    $stmt = $conn->prepare("SELECT u.Id_usuario, u.correo_usuario, u.contrasena_usuario, u.nombre_usuario, u.apellidos_usuario, u.siglas_usuario, u.estado_usuario, u.firma_usuario, u.dia_backup, u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk, 
    a.id_activo, a.cod_renta, a.fecha_asignacion, a.nombre_articulo, a.descripcion_articulo, a.modelo_articulo, a.referencia_articulo, a.marca_articulo, a.tipo_articulo, a.ip, a.windows, a.office, a.factura_office, a.lugar_articulo, a.observaciones_articulo, a.numero_factura, a.fecha_garantia, a.valor_articulo, a.condicion_articulo, a.id_proveedor_fk, a.descripcion_proveedor, a.id_usuario_fk, a.estado_activo, 
    p.id_proveedor, p.nombre_proveedor, p.contacto_proveedor, p.telefono_proveedor, p.id_usuario_fk
FROM activos a
INNER JOIN usuarios u ON u.Id_usuario = a.id_usuario_fk
INNER JOIN proveedor_compras p ON a.id_proveedor_fk = p.id_proveedor
WHERE a.id_activo = :id_activo OR a.cod_renta = :id_activo");

    $stmt->bindParam(':id_activo', $id_activo, PDO::PARAM_STR);
    $stmt->execute();

    // ¿De dónde viene la variable $registros? No se utiliza en este fragmento.

    if ($stmt->rowCount() > 0) {
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultados as $row) {
            $id_activo = $row["id_activo"];
            $nombre_activo = $row["nombre_articulo"];
            $descripcion_articulo = $row["descripcion_articulo"];
            $modelo_articulo = $row["modelo_articulo"];
            $referencia_articulo = $row["referencia_articulo"];
            $marca_articulo = $row["marca_articulo"];
            $tipo_articulo = $row["tipo_articulo"];
            $ip = $row["ip"];
            $windows = $row["windows"];
            $office = $row["office"];
            $factura_office = $row["factura_office"];

            $lugar_articulo = $row["lugar_articulo"];
            $observaciones_articulo = $row["observaciones_articulo"];
            $numero_factura = $row["numero_factura"];
            $fecha_garantia = $row["fecha_garantia"];
            $valor_articulo = $row["valor_articulo"];
            $condicion_articulo = $row["condicion_articulo"];
            $id_proveedor = $row["id_proveedor"];
            $nombre_proveedor = $row["nombre_proveedor"];
            $contacto_proveedor = $row["contacto_proveedor"];
            $telefono_proveedor = $row["telefono_proveedor"];
            $descripcion_proveedor = $row["descripcion_proveedor"];
            $id_usuario = $row["Id_usuario"];
            $nombre_usuario = $row["nombre_usuario"];
            $apellidos_usuario = $row["apellidos_usuario"];
            $siglas_usuario = $row["siglas_usuario"];
            $estado_activo = $row["estado_activo"];
        }
    }
} catch (PDOException $e) {
    echo "Error en el servidor: " . $e->getMessage();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Activo <?= $id_activo ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0," name="viewport">

    <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <!-- CodeMirror -->
    <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">




</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="row">


        <!-- Main content -->
        <section class="content col-md-12">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-center border-bottom-0">
                                    <h4 class="text-center"><?php echo $siglas_usuario ?> </h4>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-center"><b><?php echo $nombre_usuario . " " . $apellidos_usuario  ?></b></h3>
                                            <div class="card bg-teal pb-0">
                                                <center>
                                                    <h4>Detalles del Activo</h4>
                                                </center>
                                            </div>
                                            <p class=""><b>Activo: </b> <?php echo $nombre_activo ?> </p>
                                            <p class="text-muted text-sm"><b>Descripcion Activo: </b> <?php echo $descripcion_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>Modelo Activo: </b> <?php echo $modelo_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>Referencia Activo: </b> <?php echo $referencia_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>Marca Activo: </b> <?php echo $marca_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>Tipo Activo: </b> <?php echo $tipo_articulo ?> </p>
                                            <div class="card bg-teal pb-0">
                                                <center>
                                                    <h4>Detalles Tecnicos</h4>
                                                </center>
                                            </div>
                                            <p class="text-muted text-sm"><b>IP: </b> <?php echo $ip ?> </p>
                                            <p class="text-muted text-sm"><b>Windows: </b> <?php echo $windows ?> </p>
                                            <p class="text-muted text-sm"><b>Office: </b> <?php echo $office ?> </p>
                                            <p class="text-muted text-sm"><b>Factura Office: </b> <?php echo $factura_office ?> </p>
                                            <div class="card bg-teal pb-0">
                                                <center>
                                                    <h4>Ubicación</h4>
                                                </center>
                                            </div>

                                            
                                            <p class="text-muted text-sm"><b>Lugar: </b> <?php echo $lugar_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>Observaciones: </b> <?php echo $observaciones_articulo ?> </p>
                                            <div class="card bg-teal pb-0">
                                                <center>
                                                    <h4>Facturación</h4>
                                                </center>
                                            </div>

                                            <p class="text-muted text-sm"><b>Factura Activo: </b> <?php echo $numero_factura ?> </p>
                                            <p class="text-muted text-sm"><b>Fecha Garantia: </b> <?php echo $fecha_garantia ?> </p>
                                            <p class="text-muted text-sm"><b>Valor Activo: </b> <?php echo $valor_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>Condicion Activo: </b> <?php echo $condicion_articulo ?> </p>
                                            <p class="text-muted text-sm"><b>ID Proveedor: </b> <?php echo $id_proveedor ?> </p>
                                            <p class="text-muted text-sm"><b>Nombre Proveedor: </b> <?php echo $nombre_proveedor ?> </p>
                                            <p class="text-muted text-sm"><b>Correo Proveedor: </b> <?php echo $contacto_proveedor ?> </p>
                                            <p class="text-muted text-sm"><b>Telefono Proveedor: </b> <?php echo $telefono_proveedor ?> </p>
                                            <p class="text-muted text-sm"><b>Descripcion Proveedor: </b> <?php echo $descripcion_proveedor ?> </p>



                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>
                </div>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</body>

</html>