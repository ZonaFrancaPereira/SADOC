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
                    <i class="nav-icon fas fa-tachometer-alt"></i>

                    <p>
                        Panel de Control
                    </p>
                </a>
            </li>
            <?php
            if ($_SESSION['proceso_fk'] == "JR" || $_SESSION['proceso_fk'] == "TI" || $_SESSION['proceso_fk'] == "GR") {
            ?>
                <li class="nav-item">
                    <a data-toggle="tab" href="#asociados" class="nav-link ">
                        <i class="nav-icon fas fa-search-plus"></i>
                        <p>
                            Nuevo Asociado

                        </p>
                    </a>

                </li>
            <?php
            }
            ?>
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
<!-- /TABLA  -->
<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">
                    <!-- /ACTUALIZAR USUARIO -->
                    <div id="asociados" class="tab-pane">
                        <form id="formulario_accionistas" method="post" action="procesar_formulario.php">
                            <div class="card mb-3 accionista_empresa">
                                <div class="card-body">
                                    <h5 class="card-title">Datos del Asociado</h5><br>
                                    <div class="form-group">
                                        <label for="nombre_empresa">En este apartado se debe realizar la configuración previa antes de revisar y adjuntas documentación se debe contar con la composición accionaria completa.</label>
                                    </div>
                                    <div class="form-group empresas_container">
                                        <!-- Espacio para agregar empresas -->
                                    </div>
                                    <button type="button" class="btn bg-primary agregar_accionista">Crear Asociado de Negocio</button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
<script>
    $(document).ready(function() {




        $(document).on("click", ".agregar_empresa", function() {
            agregarAccionistaEmpresa($(this).siblings(".empresas_container"));
        });

        $(document).on("click", ".agregar_accionista", function() {
            agregarAccionistaEmpresa($(this).siblings(".empresas_container"));
        });

        $(document).on("click", ".eliminar_accionista", function() {
            $(this).closest("fieldset").remove();
        });

        $(document).on("click", ".eliminar_empresa", function() {
            $(this).closest("fieldset").remove();
        });

        $(document).on("input", "[id^=num_accionistas_empresa]", function() {
            var empresasContainer = $(this).closest("fieldset").find(".empresas_container");
            agregarAccionistasDentroDeEmpresa(empresasContainer, $(this).val());
        });
    });



    function agregarAccionistaEmpresa(empresasContainer) {
        var empresaFieldset = $("<fieldset class='border p-2 mt-2'>");
        var numEmpresas = empresasContainer.children().length + 1;

        empresaFieldset.html(`
    <legend class='text-primary'>Asociado de Negocio ${numEmpresas}</legend>
    <div class="form-group">
      <label for="nombre_empresa_accionista${numEmpresas}">Nombre de la Empresa:</label>
      <input type="text" class="form-control" name="nombre_empresa_accionista${numEmpresas}" id="nombre_empresa_accionista${numEmpresas}" required>
    </div>

    <div class="form-group">
      <label for="num_accionistas_empresa${numEmpresas}">Número de Accionistas (Personas Naturales):</label>
      <input type="number" class="form-control" name="num_accionistas_empresa${numEmpresas}" id="num_accionistas_empresa${numEmpresas}" required>
    </div>

    <div class="empresas_container">
      <!-- Espacio para agregar empresas -->
    </div>

    <button type="button" class="btn btn-success agregar_accionista mt-2">Agregar Empresa Accionistas ${numEmpresas}</button>
    <button type="button" class="btn btn-danger eliminar_empresa mt-2">Eliminar Empresa</button>
  `);

        empresasContainer.append(empresaFieldset);
    }

    function agregarAccionistasDentroDeEmpresa(empresasContainer, numAccionistas) {
        empresasContainer.empty(); // Limpiar los campos anteriores

        for (var i = 0; i < numAccionistas; i++) {
            var accionistaFieldset = $("<fieldset class='border p-2 mt-2'>");
            accionistaFieldset.html(`
      <legend class='text-success'>Accionista ${i + 1}</legend>
      <div class="form-group">
        <label for="nombre_accionista${i + 1}">Nombre del Accionista:</label>
        <input type="text" class="form-control" name="nombre_accionista${i + 1}" id="nombre_accionista${i + 1}" required>
      </div>
      <button type="button" class="btn btn-danger eliminar_accionista mt-2">Eliminar Accionista</button>
    `);
            empresasContainer.append(accionistaFieldset);
        }
    }
</script>

</body>

</html>