<?php
 require('seguridad.php');
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

<!-- /TABLA  -->
<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">
                    <!-- /ACTUALIZAR USUARIO -->
                    <div id="asociados" class="tab-pane">
                        <form id="formulario_accionistas" method="post" action="php/insertar_asociados.php">
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
        var nombreEmpresa = $(this).closest("fieldset").find("[id^=nombre_empresa_accionista]").val();
        agregarAccionistaEmpresa($(this).siblings(".empresas_container"), nombreEmpresa);
    });

    $(document).on("click", ".eliminar_accionista", function() {
        $(this).closest("fieldset").remove();
        actualizarTitulos($(this));
    });

    $(document).on("click", ".eliminar_empresa", function() {
        $(this).closest("fieldset").remove();
        actualizarTitulos($(this));
    });

    $(document).on("input", "[id^=nombre_empresa_accionista]", function() {
        actualizarTitulos($(this));
    });

    $(document).on("input", "[id^=num_accionistas_empresa]", function() {
        var empresasContainer = $(this).closest("fieldset").find(".empresas_container");
        agregarAccionistasDentroDeEmpresa(empresasContainer, $(this).val());
        actualizarTitulos($(this));
    });
});

function agregarAccionistaEmpresa(empresasContainer, nombreEmpresa) {
    var numEmpresas = empresasContainer.children().length + 1;

    var empresaFieldset = $("<fieldset class='border p-2 mt-2'>");
    empresaFieldset.html(`
        <legend class='text-primary titulo_asociado_negocio'>Asociado de Negocio - ${nombreEmpresa || "Empresa sin nombre"}</legend>
        <div class="form-group">
            <label for="num_accionistas_empresa${numEmpresas}">Ingresa el número de accionistas (<B>Personas Naturales</B>):</label>
            <input type="number" class="form-control" name="num_accionistas_empresa[${numEmpresas}]" id="num_accionistas_empresa${numEmpresas}" required placeholder="5">
        </div> <div class="form-group">
            <label for="nit_empresa_accionista">NIT Asociado de Negocio</label>
            <input type="text" class="form-control" name="nit_empresa_accionista[]" id="nit_empresa_accionista${numEmpresas}" value="" required placeholder="900311215">
        </div>
        <div class="form-group">
            <label for="nombre_empresa_accionista${numEmpresas}">Nombre de la Empresa:</label>
            <input type="text" class="form-control" name="nombre_empresa_accionista[${numEmpresas}]" id="nombre_empresa_accionista${numEmpresas}" value="${nombreEmpresa}" required>
        </div>

        <div class="empresas_container">
            <!-- Espacio para agregar empresas -->
        </div>

        <button type="button" class="btn btn-success agregar_accionista mt-2">Agregar Empresa Accionista - ${nombreEmpresa}</button>
        <button type="button" class="btn btn-danger eliminar_empresa mt-2">Eliminar Empresa - ${nombreEmpresa}</button>
    `);

    empresasContainer.append(empresaFieldset);
    actualizarTitulos(empresaFieldset.find("[id^=nombre_empresa_accionista]"));

    empresaFieldset.find(".agregar_accionista").on("click", function() {
        var nombreEmpresa = $(this).closest("fieldset").find("[id^=nombre_empresa_accionista]").val();
        agregarAccionistaEmpresa($(this).siblings(".empresas_container"), nombreEmpresa);
    });
}

function agregarAccionistasDentroDeEmpresa(empresasContainer, numAccionistas) {
    empresasContainer.empty(); // Limpiar los campos anteriores

    for (var i = 0; i < numAccionistas; i++) {
        var accionistaFieldset = $("<fieldset class='border p-2 mt-2'>");
        accionistaFieldset.html(`
            <legend class='text-success'>Accionista ${i + 1}</legend>
            </div> <div class="form-group">
            <label for="id_accionista">Identificación Accionista</label>
            <input type="text" class="form-control" name="id_accionista[]" id="id_accionista[]" value="" required placeholder="900311215">
        </div>
            <div class="form-group">
                <label for="nombre_accionista${i + 1}">Nombre del Accionista:</label>
                <input type="text" class="form-control" name="nombre_accionista[${i + 1}]" id="nombre_accionista${i + 1}" required placeholder="Nombre Completo del Accionista">
            </div>
            <button type="button" class="btn btn-danger eliminar_accionista mt-2">Eliminar Accionista</button>
        `);
        empresasContainer.append(accionistaFieldset);
    }
}

function actualizarTitulos(inputNombreEmpresa) {
    var nombreEmpresa = inputNombreEmpresa.val() || "Empresa sin nombre";
    var numEmpresas = inputNombreEmpresa.closest("fieldset").find(".empresas_container fieldset").length + 1;

    inputNombreEmpresa.closest("fieldset").find(".titulo_asociado_negocio").text(`Asociado de Negocio - ${nombreEmpresa}`);
    inputNombreEmpresa.closest("fieldset").find(".agregar_accionista").text(`Agregar Empresa Accionista - ${nombreEmpresa}`);
    inputNombreEmpresa.closest("fieldset").find(".eliminar_empresa").text(`Eliminar Empresa - ${nombreEmpresa}`);

    // Actualizar también los títulos dentro de las empresas
    inputNombreEmpresa.closest("fieldset").find(".empresas_container fieldset").each(function(index) {
        var nombreEmpresaAccionista = $(this).find("[id^=nombre_empresa_accionista]").val() || `Empresa sin nombre (${index + 1})`;
        $(this).find(".titulo_asociado_negocio").text(`Asociado de Negocio - ${nombreEmpresaAccionista}`);
        $(this).find(".agregar_accionista").text(`Agregar Empresa Accionista - ${nombreEmpresaAccionista}`);
        $(this).find(".eliminar_empresa").text(`Eliminar Empresa - ${nombreEmpresaAccionista}`);
    });
}





</script>

</body>

</html>