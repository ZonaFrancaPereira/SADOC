<?php
session_start();
if ($_SESSION['ingreso'] == true) {
  require('php/conexion.php');
  require('plantilla.php');
?>


  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a data-toggle="tab" href="#panelc" class="nav-link active">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Panel de Control
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a data-toggle="tab" href="#orden" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Nueva Orden
            <span class="right badge badge-success">Nueva</span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>
            Consultar Ordenes
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a data-toggle="tab" href="#pendientes" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Pendientes</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#aprobadas" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Aprobadas</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#ejecuccion" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>En Ejecucion</p>
            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="tab" href="#ejecutadas" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Ejecutadas</p>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item">
        <a data-toggle="tab" href="#proveedores" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Proveedores
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
<?php
  //require('include/footer.php');

} else {
  session_unset();
  session_destroy();
  header('location: index.php');
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div id="wrapper" class="toggled">

    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content card">
          <!-- DIV DONDE SE MUESTRA TODA LA INFORMACION DE INTERES DE LAS ACPM PARA CADA USUARIO -->
          <div class="tab-pane  show active" id="panelc">
            Pendientes por aprobar / en procesoa
          </div>
          <!-- DIV DONDE SE MOSTRARA EL FORMULARIO PARA UNA NUEVA ACPM -->
          <div class="tab-pane " id="orden">
            <form action="php/insertarOrden.php" class="formularioCompra" method="POST">
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
                    <div class="col-md-6 col-xs-12 col-sm-6">
                      <label>Fecha</label>
                      <input type="date" name="fecha_orden" class="form-control" id="fecha_orden" required>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <label for="exampleDataList" class="form-label">Proveedor</label>
                      <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Identificacion de Proveedor">
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
                        <tr class="fila-fija ">
                          <td class="col-md-2">
                            <textarea name="articulo_compra[]" id="articulo_compra" class="form-control" cols="10" rows="5"></textarea>
                          </td>
                          <td class=" col-md-2">
                            <input type="number" name="cantidad_orden[]" class="cantidad_orden form-control" placeholder="Unidades" required step="any">
                          </td>
                          <td class=" col-md-2">
                            <input type="number" class="valor_neto form-control" placeholder="Valor sin Iva" value="" name="valor_neto[]"  onkeyup="myFunction()" >
                          </td>
                          <td class=" col-md-2">
                            <input type="number" class="valor_iva form-control" placeholder="Valor Iva" value="" name="valor_iva[]" required >
                          </td>
                          <td class=" col-md-2">
                            <input type="number" class="valor_total form-control" placeholder="Toltal" value="" name="valor_total[]" step="any" required  >
                          </td>
                          <td class="col-md-2">
                            <textarea name="articulo_compra[]" id="observaciones_articulo" class="form-control" cols="10" rows="5"></textarea>
                          </td>
                          <td class="eliminar col-md-1">
                            <input type="button" class="btn btn-danger" value="X" />
                          </td>
                        </tr>

                      </table>
                      <div class="row">
                        <div class="col-md-6">
                          <label for=""><B>TOTAL ORDEN</B></label>
                          <input type="number" class="form-control input-lg" id="totalOrden" name="totalOrden" total="0" value="0" placeholder="0" readonly>
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
                      <select class="form-control" id="tipo_pago" name="tipo_pago" required>
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
                      <input type="number" class="form-control input-lg" id="tiempo_pago" name="tiempo_pago">
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="otros">
                      <label>Otras condiciones de la negociación</label>
                      <textarea class="form-control" id="condiciones_negociacion" name="condiciones_negociacion" rows="3" required></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Comentarios</label>
                      <textarea class="form-control" id="comentario_orden" name="comentario_orden" rows="3" required></textarea>
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
          <!-- DIV DONDE SE MUESTRAN LAS ORDENES PENDIENTES DE CADA USUARIO-->
          <div id="pendientes" class="tab-pane ">
            PENDIENTES
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ORDENES APROBADAS DE CADA USUARIO-->
          <div id="aprobadas" class="tab-pane ">
            APROBADAS
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ORDENES EN EJECUCCION DE CADA USUARIO-->
          <div id="ejecuccion" class="tab-pane ">
            EJECUCCION
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ORDENES EJECUTADS DE CADA USUARIO-->
          <div id="ejecutadas" class="tab-pane ">
            ORDENES EJECUTADAS
          </div>
          <!-- DIV DONDE SE MUESTRAN LOS PROVEEDORES DE CADA USUARIO-->
          <div id="proveedores" class="tab-pane ">
                    <!-- CIERRE DEL TAB -->
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
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
  $(document).ready(function() {
    $("#tiempo").hide();
    $("#porcentaje").hide();
    $("#otros").hide();

    $("#tipo_pago").change(function() {
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
</script>

</body>

</html>