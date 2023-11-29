<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();

if ($_SESSION['ingreso'] == true) {
  require('php/conexion.php');
  require('plantilla.php');

  require 'qr/barcode.php';
  $generator = new barcode_generator();
  header('Content-Type: image/svg+xml');
  //ciclo


}
?>

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a data-toggle="tab" href="#panela" class="nav-link active">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Panel de Control
        </p>
      </a>
    </li>
    <?php if ($_SESSION['ingresar_activos'] == "Si") { ?>
      <li class="nav-item">
        <a data-toggle="tab" href="#ingresar" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Nuevo Activo
          </p>
        </a>
      </li>
    <?php  } ?>
    <?php if ($_SESSION['admin_activos'] == "Si") { ?>
      <li class="nav-item">
        <a data-toggle="tab" href="#inventario" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Nuevo Inventario
            <span class="right badge badge-success">Crear</span>
          </p>
        </a>
      </li>
    <?php  } ?>
    <?php if ($_SESSION['consultar_activos'] == "Si") { ?>
      <li class="nav-item">
        <a data-toggle="tab" href="#consultar" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Consultar Activos
          </p>
        </a>
      </li>
    <?php  } ?>


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
                      $svg = $generator->render_svg("qr", "https://app.zonafrancadepereira.com/admin/mis_activos.php?id_activo='" .$_SESSION['Id']. "'", "");
                      $qr = $svg;
                      ?>
                      <li class="col-md-4" style=" border: 1px solid black;">
                                <div class="product-img">
                                  <a href="javascript:void(0)" class="product-title"><?php echo $_SESSION['siglas_usuario']; ?></a>
                                  <?= $qr ?>
                                </div>
                                <div class="product-info">
                                  <img src="img/logo_zf.png" width="25%"><br>
                                  <a href="javascript:void(0)" class="product-title">INVENTARIO GENERAL</a>
                                  <p>Consulta todos los activos que tienes asignados aqui.</p>
                                </div>
                              
                              </li>
                              
                    
                  
                        <?php
                        try {
                          $stmt = $conn->prepare('SELECT * FROM activos WHERE id_usuario_fk="'.$_SESSION['Id'].'"');
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

                              <li class="col-md-4" style=" border: 1px solid black;">
                                <div class="product-img">
                                  <a href="javascript:void(0)" class="product-title"><?php echo $_SESSION['siglas_usuario']; ?></a>
                                  <?= $qr ?>
                                </div>
                                <div class="product-info">
                                  <img src="img/logo_zf.png" width="25%"><br>
                                  <a href="javascript:void(0)" class="product-title"><?= $nombre_articulo ?></a>
                                  <span class="product-description"><?= $id_activo ?></span>
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
            <form action="" class="formularioCompra" method="POST">
              <div class="card card-navy">
                <div class="card-header">
                  <center>
                    <h4>Nueva Orden de Compra</h4>
                  </center>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                      <label>Id Usuario</label>
                      <input type="text" name="id_usuario_fk" id="id_usuario_fk" value="<?php echo $_SESSION['Id'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Cotizado Por :</label>
                      <input type="text" name="" value="<?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-6 col-xs-6 col-sm-6">
                      <label>Cargo</label>
                      <input type="text" name="" value="<?php echo $_SESSION['nombre_cargo'] ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label>Fecha</label>
                      <input type="date" name="fecha_orden" class="form-control" id="fecha_orden" required>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label for="exampleDataList" class="form-label">Proveedor</label>
                      <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Identificacion de Proveedor" name="id_proveedor_fk" required>
                      <datalist id="datalistOptions">

                        <?php
                        try {
                          $stmt = $conn->prepare('SELECT * FROM  proveedor_compras');
                          $stmt->execute();
                          $registros = 1;
                          if ($stmt->rowCount() > 0) {

                            while ($row = $stmt->fetch()) {
                              $id_proveedor = $row["id_proveedor"];
                              $nombre_proveedor = $row["nombre_proveedor"];
                              echo "<option value=" . $id_proveedor . ">" . $nombre_proveedor . "</option>";
                            }
                          } else {
                            echo '<option value="0">No existen proveedores</option>';
                          }
                        } catch (PDOException $e) {
                          echo "Error en el servidor";
                        }
                        ?>
                      </datalist>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                      <label>¿Es un Proveedor recurrente?</label>
                      <select name="proveedor_recurrente" id="" class="form-control">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12 pt-2">
                      <table class="table pt-2" id="tabla">
                        <thead>
                          <tr>
                            <th>Articulo</th>
                            <th>Cantidad</th>
                            <th>Valor Unitario</th>
                            <th>Valor Iva</th>
                            <th>Total</th>
                            <th>Observaciones</th>
                            <th>X</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="fila-fija ">
                            <td class="col-md-2">
                              <textarea name="articulo_compra[]" id="articulo_compra" class="form-control" cols="10" rows="5"></textarea>
                            </td>
                            <td class=" col-md-2">
                              <input type="number" name="cantidad_orden[]" class="cantidad_orden form-control" placeholder="Unidades" step="any">
                            </td>
                            <td class=" col-md-2">
                              <input type="number" class="valor_neto form-control" placeholder="Valor sin Iva" value="" name="valor_neto[]" onkeyup="myFunction()">
                            </td>
                            <td class=" col-md-2">
                              <input type="number" class="valor_iva form-control" placeholder="Valor Iva" value="" name="valor_iva[]">
                            </td>
                            <td class=" col-md-2">
                              <input type="number" class="valor_total form-control" placeholder="Toltal" value="" name="valor_total[]" step="any">
                            </td>
                            <td class="col-md-2">
                              <textarea name="observaciones_articulo[]" id="observaciones_articulo" class=" form-control" cols="10" rows="5"></textarea>
                            </td>
                            <td class="eliminar col-md-1">
                              <input type="button" class="btn btn-danger" value="X" />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-md-6">
                          <label for=""><B>TOTAL ORDEN</B></label>
                          <input type="number" class="form-control input-lg" id="totalOrden" name="total_orden" total="0" value="0" placeholder="0" readonly>
                        </div>
                        <div class="col-md-6">
                          <label for=""><B>Añade más articulos a la Orden de Compra</B></label>
                          <button id="adicional" name="adicional" type="button" class="adicional btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                      <center>
                        <h5>Forma de Pago</h5>
                      </center>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Selecciona una Forma de Pago, dependiendo la seleccion deberas llenar lo restante</label>
                      <select class="form-control" id="forma_pago" name="forma_pago" required>
                        <option>Selecciona una Opcion</option>
                        <option value="Contado">Contado</option>
                        <option value="Credito">Credito</option>
                        <option value="Anticipo">Anticipo</option>
                        <option value="Otros">Otros</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="tiempo">
                      <label>Tiempo de pago en dias</label>
                      <input type="number" class="form-control input-lg" id="tiempo_pago" name="tiempo_pago">
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="porcentaje">
                      <label>Porcentaje del Anticipo</label>
                      <input type="number" class="form-control input-lg" id="porcentaje_anticipo" name="porcentaje_anticipo">
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="otros">
                      <label>Otras condiciones de la negociación</label>
                      <textarea class="form-control" id="condiciones_negociacion" name="condiciones_negociacion" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Comentarios</label>
                      <textarea class="form-control textarea" id="comentario_orden" name="comentario_orden" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="tiempo">
                      <label>Tiempo de entrega en dias</label>
                      <input type="number" class="form-control input-lg" id="tiempo_entrega" name="tiempo_entrega">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <button type="submit" class="btn btn-success btn-block " id="enviar_orden" name="enviar_orden">Enviar Orden</button>
                </div>
              </div>

            </form>
            <!-- /.card -->
          </div>
          <!-- DIV DONDE SE PUEDE REALIZAR UN NUEVO INVENTARIO DE ACTIVOS-->
          <div id="inventario" class="tab-pane ">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-navy">
                    <h3 class="card-title">Consulta Tus Ordenes de Compra</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="display table table-striped table-valign-middle " width="100%">
                      <thead>
                        <tr>
                          <th># Orden</th>
                          <th>Fecha</th>
                          <th>Nit</th>
                          <th>Proveedor</th>
                          <th>Recurrente</th>
                          <th>Forma de Pago</th>
                          <th>Valor</th>
                          <th>Estado</th>
                          <th>Ver</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        try {
                          $stmt = $conn->prepare('SELECT c.id_orden,c.fecha_orden,c.proveedor_recurrente,c.forma_pago,
                                  c.tiempo_pago,c.porcentaje_anticipo,c.condiciones_negociacion,c.comentario_orden,c.tiempo_entrega,
                                  c.total_orden,c.analisis_cotizacion,c.estado_orden,c.id_cotizante,c.id_proveedor_fk,u.Id_usuario, u.correo_usuario,
                                  u.contrasena_usuario, u.nombre_usuario,u.apellidos_usuario, u.salario_usuario, u.estado_usuario, u.firma_usuario,
                                  u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk,p.id_proveedor,p.nombre_proveedor,p.contacto_proveedor,p.telefono_proveedor,p.id_usuario_fk
                                  FROM  orden_compra c
                                  INNER JOIN usuarios u
                                  ON c.id_cotizante=u.Id_usuario
                                  INNER JOIN proveedor_compras p
                                  ON c.id_proveedor_fk= p.id_proveedor
                                  WHERE  u.Id_usuario="' . $_SESSION['Id'] . '"');
                          $stmt->execute();
                          $registros = 1;
                          if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch()) {
                              $id_orden = $row["id_orden"];
                              $nombre_usuario = $row["nombre_usuario"];
                              $apellidos_usuario = $row["apellidos_usuario"];
                              $estado_orden = $row["estado_orden"];
                              echo "<tr>";
                              echo "<td >" . $id_orden . "</td>";
                              echo "<td >" . $row["fecha_orden"] . "</td>";
                              echo "<td>" . $row["id_proveedor"] . "</td>";
                              echo "<td>" . $row["nombre_proveedor"] . "</td>";
                              echo "<td>" . $row["proveedor_recurrente"] . "</td>";
                              echo "<td>" . $row["forma_pago"] . "</td>";
                              echo "<td>$ " . number_format($row["total_orden"]) . "</td>";
                              switch ($estado_orden) {
                                case "Analisis de Cotizacion":
                                  echo "<td><center><span class='badge badge-warning'>" . $estado_orden . "</span></center></td>";
                                  break;
                                case "Proceso":
                                  echo "<td><center><span class='badge bg-teal'>" . $estado_orden . "</span></center></td>";
                                  break;
                                case "Aprobada":
                                  echo "<td><center><span class='badge bg-olive'>" . $estado_orden . "</span></center></td>";
                                  break;
                                case "Denegada":
                                  echo "<td><center><span class='badge badge-danger'>" . $estado_orden . "</span></center></td>";
                                  break;
                                case "Pendiente de Pago":
                                  echo "<td><center><span class='badge bg-navy'>" . $estado_orden . "</span></center></td>";
                                  break;
                                case "Ejectutada":
                                  echo "<td><center><span class='badge-success'>" . $estado_orden . "</span></center></td>";
                                  break;
                              }
                              echo "<td><a href='orden_pdf.php?id_orden=$id_orden' target='_blank'> <button class='btn btn-primary'><i class='fas fa-eye'></i> </button></a></td>";
                              echo "</tr>";
                              $registros++;
                            }
                          }
                        } catch (PDOException $e) {
                          echo "Error en el servidor";
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- DIV DONDE SE PUEDEN CONSULTAR Y DAR DE BAJA LOS ACTIVOS-->
          <div id="consultar" class="tab-pane">
            <div class="row">
              <div class="col-lg-12 ">
                <div class="card">
                  <div class="card-header border-0 bg-navy">
                    <h3 class="card-title">Administra tus Proveedores</h3>
                  </div>
                  <!-- Button trigger modal -->
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button type="button" class="btn btn-primary col-md-12 btn-block" data-toggle="modal" data-target="#exampleModal">
                          Agregar Proveedor
                        </button>
                      </h5>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header bg-teal">
                      <i class="fas fa-list-alt"></i>
                      Lista Actual de Proveedores
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="display table table-striped table-valign-middle " width="100%">
                        <thead>
                          <tr>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Telefono</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          try {
                            $stmt = $conn->prepare('SELECT u.Id_usuario, u.correo_usuario,
                                  u.contrasena_usuario, u.nombre_usuario,u.apellidos_usuario, u.salario_usuario, u.estado_usuario, u.firma_usuario,
                                  u.proceso_usuario_fk, u.id_cargo_fk, u.tipo_usuario_fk,p.id_proveedor,p.nombre_proveedor,p.contacto_proveedor,p.telefono_proveedor,p.id_usuario_fk
                                  FROM proveedor_compras p
                                  INNER JOIN usuarios u
                                  ON u.Id_usuario= p.id_usuario_fk');
                            $stmt->execute();
                            $registros = 1;
                            if ($stmt->rowCount() > 0) {
                              while ($row = $stmt->fetch()) {
                                $id_proveedor = $row["id_proveedor"];
                                $nombre_proveedor = $row["nombre_proveedor"];
                                $correo_proveedor = $row["contacto_proveedor"];
                                $telefono_proveedor = $row["telefono_proveedor"];
                                echo "<tr>";
                                echo "<td >" . $id_proveedor . "</td>";
                                echo "<td >" . $nombre_proveedor . "</td>";
                                echo "<td>" . $correo_proveedor . "</td>";
                                echo "<td>" . $telefono_proveedor . "</td>";
                                echo '<td> 	<a class="btn btn-warning" href="#editProveedorModal" data-toggle="modal"  data-id_proveedor="' . $id_proveedor . '"  data-nombre_proveedor="' . $nombre_proveedor . '"  data-correo_proveedor="' . $correo_proveedor . '"  data-telefono_proveedor="' . $telefono_proveedor . '"><i class="fas fa-edit"></i> </a></td>';
                                echo "<td>  <button class='btn btn-danger'><i class='fas fa-trash'></i> </button></td>";

                                echo "</tr>";
                                $registros++;
                              }
                            }
                          } catch (PDOException $e) {
                            echo "Error en el servidor";
                          } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
              </div>
            </div>
          </div>
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