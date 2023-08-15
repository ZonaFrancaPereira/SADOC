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
            <span class="right badge badge-success">Nueva</span>
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
          <div class="tab-pane " id="acpm">
            <form id="form_acpm" method="POST">
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
                        } catch (PDOExeption $e) {
                          echo "Error en el servidor";
                        }
                        ?>
                      </datalist>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Origen ACPM</label>
                      <textarea class="form-control" id="origen_acpm" name="origen_acpm" rows="3" required></textarea>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                      <label>Descripcion Fuente</label>
                      <textarea class="form-control" id="descripcion_fuente" name="descripcion_fuente" rows="3"></textarea>
                    </div>
                    <div class="col-2 col-xs-12 col-sm-12">
                      <label>Tipo de Reporte</label>
                      <select class="form-control" id="tipo_acpm" name="tipo_acpm" required>
                        <option value="AC">Accion Correctiva</option>
                        <option value="AP">Accion Preventiva</option>
                        <option value="AM">Accion de Mejora</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Descripción ACPM</label>
                      <textarea class="form-control" id="descripcion_acpm" name="descripcion_acpm" rows="3" required></textarea>
                    </div>
                    <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                      <center>
                        <h5>Analisis del Hallazgo</h5>
                      </center>

                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Analisis de Causa (Técnicas de los por ques, espina de pescado, lluvia de ideas, etc)</label>
                      <textarea class="form-control" id="causa_acpm" name="causa_acpm" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>¿Se identifican No Conformidades similares o que potencialmente puedan ocurrir en otro proceso?</label>
                      <select class="form-control" id="nc_similar" name="nc_similar" required>
                        <option>Selecciona una Opcion</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="similares">
                      <label>Describe cuales y en que proceso</label>
                      <textarea class="form-control" id="descripcion_nsc" name="descripcion_nsc" rows="3"></textarea>
                    </div>
                    <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                      <center>
                        <h5>Plan de Mejora</h5>
                      </center>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Corrección ACPM</label>
                      <textarea class="form-control" id="correccion_acpm" name="correccion_acpm" rows="3" required></textarea>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                      <label>Se identificó peligros de SST nuevos o que han cambiado, o la necesidad de generar controles nuevos o modificar los existentes</label>
                      <select class="form-control" id="riesgo_acpm" name="riesgo_acpm" required>
                        <option>Selecciona una Opcion</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12" id="riesgos">
                      <label>Describa cuales son los riegos</label>
                      <textarea class="form-control" id="justificacion_riesgo" name="justificacion_riesgo" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="col-md-12 col-xs-12 col-sm-12">
                  <button type="button" class="btn btn-success btn-block " id="enviar_acpm" name="enviar_acpm">Radicar ACPM</button>
                </div>
              </div>

            </form>
            <!-- /.card -->
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES ABIERTAS DE CADA USUARIO-->
          <div id="pendientes" class="tab-pane ">
            aBIERTAS
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES CERRADAS DE CADA USUARIO-->
          <div id="aprobadas" class="tab-pane ">
            CERRADAS
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES CERRADAS DE CADA USUARIO-->
          <div id="ejecuccion" class="tab-pane ">
            CERRADAS
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES CERRADAS DE CADA USUARIO-->
          <div id="ejecutadas" class="tab-pane ">
            CERRADAS
          </div>
          <!-- DIV DONDE SE MUESTRAN LAS ACCIONES CERRADAS DE CADA USUARIO-->
          <div id="proveedores" class="tab-pane ">
            CERRADAS
          </div>
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
    $("#similares").hide();
    $("#fuente").hide();
    $("#riesgos").hide();

    $("#nc_similar").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#similares").show();
      } else {
        $("#similares").hide();
      }
    });
    $("#fuente_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Otros") {
        $("#fuente").show();
      } else {
        $("#fuente").hide();
      }
    });
    $("#riesgo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#riesgos").show();
      } else {
        $("#riesgos").hide();
      }
    });
  });
</script>

</body>

</html>