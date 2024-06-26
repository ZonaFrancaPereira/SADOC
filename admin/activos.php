<?php
 require('seguridad.php');
?>

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panela" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>

        <p>
          Panel de Control
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a data-toggle="tab" href="#qr" class="nav-link ">
        <i class="nav-icon fas fa-qrcode"></i>
        <p>
          QR
        </p>
      </a>
    </li>
    <?php if ($_SESSION['admin_contable'] == "Si" || $_SESSION['aux_contable'] == "Si") { ?>
      <li class="nav-item" hidden>
        <a data-toggle="tab" href="#ingresar" class="nav-link ">
          <i class="nav-icon fas fa-cart-plus"></i>
          <p>
            Nuevo Activo
          </p>
        </a>
      </li>
    <?php  } ?>
    <?php if ($_SESSION['admin_contable'] == "Si") { ?>
      <li class="nav-item" hidden>
        <a data-toggle="tab" href="#inventario" class="nav-link ">
          <i class="nav-icon fas fa-boxes"></i>
          <p>
            Nuevo Inventario
            <span class="right badge badge-success">Crear</span>
          </p>
        </a>
      </li>
    <?php  } ?>

    <li class="nav-item">
      <a data-toggle="tab" href="#consultar" class="nav-link ">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Consultar Activos
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a data-toggle="tab" href="#manual" class="nav-link ">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Manual
        </p>
      </a>

    </li>

  </ul>
</nav>
<footer>
  <small class="bg-teal">SADOC 3.0 &copy; Copyright 2022, ZFIP SAS</small>
</footer>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div id="wrapper" class="toggled">
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content ">
          <!-- DIV DONDE SE MUESTRAN TODOS LOS ACTIVOS -->


          <div class="tab-pane  show active" id="panela">
            <div class="row">
              <div class="col-lg-12">
                <!-- /.card -->
                <div class="card">


                  Gestiona tus activos

                  <!-- /.card-footer -->
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE MUESTRAN TODOS QR DE LOS ACTIVOS -->
          <div class="tab-pane  " id="qr">
            <div class="row">
              <div class="col-lg-12">
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Activos Asignados a <?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario']; ?></h3>


                  </div>
                  <!-- /.card-header -->


                  <div class="card">
                    <button onclick="printHTML()" class="btn btn-success">Imprimir QR</button>
                    <br>
                    <!-- /.card-header -->
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                      <div class="row">

                        <?php
                        $Id_usuario = $_SESSION['Id'];
                        $svg = $generator->render_svg("qr", "https://app.zonafrancadepereira.com/admin/mis_activos.php?Id_usuario=$Id_usuario", "");
                        $qr = $svg;
                        ?>
                        <li class="col-md-6" style=" border: 1px solid black; background:white;">
                          <div class="product-img">
                            <a href="javascript:void(0)" class="product-title"><?php echo $_SESSION['siglas_usuario']; ?></a>
                            <?= $qr ?>
                          </div>
                          <div class="product-info">
                            <img src="img/logo_zf.png" width="25%"><br>
                            <a href="javascript:void(0)" class="product-title">INVENTARIO GENERAL</a>
                            <p style="color:black;">Consulta todos los activos que tienes asignados aqui.</p>
                          </div>

                        </li>
                        <?php
                        try {
                          $stmt = $conn->prepare('SELECT * FROM activos WHERE   id_usuario_fk="' . $_SESSION['Id'] . '"');
                          $stmt->execute();
                          $registros = 1;
                          if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                              $id_activo = $row["id_activo"];
                              $nombre_articulo = $row["nombre_articulo"];
                              $descripcion_articulo = $row["descripcion_articulo"];
                              $svg = $generator->render_svg("qr", "https://app.zonafrancadepereira.com/admin/ver_activos.php?id_activo=$id_activo", "");
                              $qr = $svg;
                        ?>

                              <li class="col-md-6" style=" border: 1px solid black; background:white;">
                                <div class="product-img">
                                  <a href="javascript:void(0)" class="product-title"><?php echo $_SESSION['siglas_usuario']; ?></a>
                                  <?= $qr ?>
                                </div>
                                <div class="product-info">
                                  <img src="img/logo_zf.png" width="25%"><br>
                                  <a href="javascript:void(0)" class="product-title"><?= $nombre_articulo ?></a>
                                  <span class="product-description" style="color:black;"><?= $id_activo ?></span>
                                </div>
                              </li>

                        <?php
                            }
                          }
                        } catch (PDOException $e) {
                          echo "Error en el servidor";
                        }
                        ?>
                      </div>
                      <!-- /.item -->
                    </ul>
                    <!-- /.card-body -->
                    <!-- /.card-footer -->
                  </div>



                  <!-- /.card-footer -->
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE PUEDEN INGRESAR Y ASIGNAR NUEVOS ACTIVOS-->
          <div class="tab-pane " id="ingresar">
            FORMULARIO NUEVO ACTIVO
            <!-- /.card -->
          </div>
          <!-- DIV DONDE SE PUEDE REALIZAR UN NUEVO INVENTARIO DE ACTIVOS-->
          <div id="inventario" class="tab-pane ">
            NUEVO INVENTARIO
          </div>
          <!-- DIV DONDE SE PUEDEN CONSULTAR Y DAR DE BAJA LOS ACTIVOS-->
          <div id="consultar" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-primary">
                    <h3 class="card-title">Mis Activos</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th>Cod</th>
                          <th>Fecha</th>
                          <th>Articulo</th>
                          <th>Descripción</th>
                          <th>Modelo</th>
                          <th>Referencia</th>
                          <th>Marca</th>
                          <th>Lugar</th>
                          <th>Observaciones</th>
                          <th>ID Proveedor</th>
                          <th>Proveedor</th>
                          <th>Descripción Proveedor</th>
                          <th>Tecnológico</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $estado_activo = "Inactivo";
         
                        foreach ($conn->query("SELECT u.Id_usuario, u.correo_usuario, u.contrasena_usuario, u.nombre_usuario, u.apellidos_usuario, u.siglas_usuario, u.estado_usuario , u.firma_usuario, u.dia_backup, u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk, 
                        a.id_activo, a.fecha_asignacion, a.nombre_articulo, a.descripcion_articulo, a.modelo_articulo, a.referencia_articulo,a.recurso_tecnologico, a.marca_articulo, a.tipo_articulo, a.ip, a.windows, a.office, a.factura_office, a.lugar_articulo, a.observaciones_articulo, a.numero_factura, a.fecha_garantia, a.valor_articulo, a.condicion_articulo, a.id_proveedor_fk , a.descripcion_proveedor, a.id_usuario_fk, a.estado_activo, 
                        p.id_proveedor, p.nombre_proveedor, p.contacto_proveedor, p.telefono_proveedor, p.id_usuario_fk
                    FROM activos a
                    INNER JOIN usuarios u
                     ON u.Id_usuario = a.id_usuario_fk
                    INNER JOIN proveedor_compras p
                     ON a.id_proveedor_fk = p.id_proveedor WHERE  a.id_usuario_fk ='$Id_usuario'") as $row) { { ?>
                            <tr style=text-align:center>

                              <td><?php echo $row["id_activo"]; ?></td>
                              <td><?php echo $row["fecha_asignacion"];  ?></td>
                              <td><?php echo $row["nombre_articulo"] ?></td>
                              <td><?php echo $row["descripcion_articulo"] ?></td>
                              <td><?php echo $row["modelo_articulo"] ?></td>
                              <td><?php echo $row["referencia_articulo"] ?></td>
                              <td><?php echo $row["marca_articulo"] ?></td>
                              <td><?php echo $row["lugar_articulo"] ?></td>
                              <td><?php echo $row["observaciones_articulo"] ?></td>
                              <td><?php echo $row["id_proveedor"] ?></td>
                              <td><?php echo $row["nombre_proveedor"] ?></td>
                              <td><?php echo $row["descripcion_proveedor"] ?></td>
                              <td><?php echo $row["recurso_tecnologico"] ?></td>
                              <td><?php echo $row["estado_activo"] ?></td>
                            </tr>
                        <?php }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE MUESTRAN LOS PROVEEDORES DE CADA USUARIO-->
          <div id="manual" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">

                  <!-- Button trigger modal -->
                  <div class="card">
                    <!-- /.card-header -->
                    <div style="position: relative; width: 100%; height: 0; padding-top: 56.2225%;
                    padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); margin-top: 1.6em; margin-bottom: 0.9em; overflow: hidden;
                    border-radius: 8px; will-change: transform;">
                      <iframe loading="lazy" style="position: absolute; width: 100%; height: 80%; top: 0; left: 0; border: none; padding: 0;margin: 0;" src="https:&#x2F;&#x2F;www.canva.com&#x2F;design&#x2F;DAF2tA6dWWs&#x2F;view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
                      </iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- CIERRE MANUAL-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->
<?php require('footer.php'); ?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- EDITAR PROVEEDOR -->
<div class="modal fade" id="editProveedorModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addItemModalLabel">Editar Datos Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" class="formularioProveedor" method="POST">
          <div class="card ">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>NIT/CC </label>
                  <input type="number" class="form-control input-lg" id="id_proveedor" name="id_proveedor" placeholder="Identificación del Proveedor" required readonly>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>Razón Social</label>
                  <input type="text" class="form-control input-lg" id="nombre_proveedor" name="nombre_proveedor" placeholder="Nombre Proveedor" required>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>Correo</label>
                  <input type="text" class="form-control input-lg" id="correo_proveedor" name="contacto_proveedor" placeholder="Correo Proveedor" required>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>Correo</label>
                  <input type="text" class="form-control input-lg" id="telefono_proveedor" name="telefono_proveedor" placeholder="Telefono Proveedor" required>
                </div>
              </div>
            </div>

          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" form="edititemform" class="btn btn-success" name="btnedit">Editar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal PARA AGREGAR UN NUEVO PROVEEDOR-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-navy">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" class="formularioProveedor" method="POST">
          <div class="card ">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>NIT/CC </label>
                  <input type="number" class="form-control input-lg" id="id_proveedor" name="id_proveedor" placeholder="Identificación del Proveedor" required>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>Razón Social</label>
                  <input type="text" class="form-control input-lg" id="nombre_proveedor" name="nombre_proveedor" placeholder="Nombre Proveedor" required>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>Correo</label>
                  <input type="email" class="form-control input-lg" id="correo_proveedor" name="contacto_proveedor" placeholder="Correo Proveedor" required>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <label>Correo</label>
                  <input type="text" class="form-control input-lg" id="telefono_proveedor" name="telefono_proveedor" placeholder="Telefono Proveedor" required>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success" id="guardarProveedor" name="guardarProveedor">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
  $(document).ready(function() {
    $("#tiempo").hide();
    $("#porcentaje").hide();
    $("#otros").hide()
    $("#forma_pago").change(function() {
      var seleccion = $(this).val();
      switch (seleccion) {
        case "Credito":
          $("#tiempo").show();
          $("#porcentaje").hide();
          $("#otros").hide();
          break;
        case "Anticipo":
          $("#porcentaje").show();
          $("#tiempo").hide();
          $("#otros").hide();
          break;
        case "Otros":
          $("#otros").show();
          $("#tiempo").hide();
          $("#porcentaje").hide();
          break;
        default:
          $("#tiempo").hide();
          $("#porcentaje").hide();
          $("#otros").hide();
      }

    });
  })
  $('#editProveedorModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_proveedor = button.data('id_proveedor'); // Extract info from data-* attributes
    var nombre_proveedor = button.data('nombre_proveedor');
    var correo_proveedor = button.data('correo_proveedor');
    var telefono_proveedor = button.data('telefono_proveedor');
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.modal-body #id_proveedor').val(id_proveedor);
    modal.find('.modal-body #nombre_proveedor').val(nombre_proveedor);
    modal.find('.modal-body #correo_proveedor').val(correo_proveedor);
    modal.find('.modal-body #telefono_proveedor').val(telefono_proveedor);

  });

  function printHTML() {
    if (window.print) {
      window.print();
    }
  }
</script>

</body>

</html>