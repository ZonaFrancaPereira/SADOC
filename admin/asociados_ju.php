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
                    <h2>Formulario de Evaluación</h2>
                    <form id="evaluationForm">
            <div class="form-group">
                <label for="proceso">PROCESO</label>
                <input class="form-control" list="procesos" id="proceso" placeholder="Seleccione un proceso">
                <datalist id="procesos">
                    <option value="G-TI">
                    <option value="SIG">
                </datalist>
            </div>
            <div class="form-group">
                <label for="actividad">ACTIVIDAD</label>
                <input type="text" class="form-control" id="actividad" placeholder="Ingrese la actividad">
            </div>
            <div class="form-group">
                <label for="razonSocial">RAZÓN SOCIAL</label>
                <input type="text" class="form-control" id="razonSocial" placeholder="Ingrese la razón social">
            </div>
            <div class="form-group">
                <label for="nit">NIT</label>
                <input type="text" class="form-control" id="nit" placeholder="Ingrese el NIT">
            </div>

            <h4>SEGURIDAD FÍSICA</h4>
            <div class="form-group">
                <label for="contactoCarga">CONTACTO CON LA CARGA (20%)</label>
                <select class="form-control" id="contactoCarga">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoAreasCriticas">ACCESO A ÁREAS CRÍTICAS (20%)</label>
                <select class="form-control" id="accesoAreasCriticas">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoInfoConfidencial">ACCESO A INFORMACIÓN CONFIDENCIAL (20%)</label>
                <select class="form-control" id="accesoInfoConfidencial">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="supervisionInterior">REQUIERE DE SUPERVISIÓN AL INTERIOR DE LA EMPRESA (10%)</label>
                <select class="form-control" id="supervisionInterior">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="laborInstalaciones">SU LABOR SE REALIZA EN TODO MOMENTO AL INTERIOR DE LAS INSTALACIONES (10%)</label>
                <select class="form-control" id="laborInstalaciones">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="relacionProductoExportacion">SU ACTIVIDAD O FUNCIÓN TIENE RELACIÓN CON EL PRODUCTO EXPORTACIÓN (20%)</label>
                <select class="form-control" id="relacionProductoExportacion">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ponderacionSeguridadFisica">PONDERACIÓN SEGURIDAD FÍSICA</label>
                <input type="text" class="form-control" id="ponderacionSeguridadFisica" readonly>
            </div>

            <h4>SEGURIDAD INFORMÁTICA</h4>
            <div class="form-group">
                <label for="accesoRedTelecomunicaciones">ACCESO A LA RED DE TELECOMUNICACIONES (20%)</label>
                <select class="form-control" id="accesoRedTelecomunicaciones">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoAntivirus">ACCESO A MANIPULAR EL ANTIVIRUS (10%)</label>
                <select class="form-control" id="accesoAntivirus">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoDispositivoSeguridad">ACCESO A DISPOSITIVO DE SEGURIDAD (20%)</label>
                <select class="form-control" id="accesoDispositivoSeguridad">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoHostingDominio">ACCESO A HOSTING Y DOMINIO (10%)</label>
                <select class="form-control" id="accesoHostingDominio">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoCopiasSeguridad">ACCESO A COPIAS DE SEGURIDAD (10%)</label>
                <select class="form-control" id="accesoCopiasSeguridad">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoEquiposComputo">ACCESO A MANIPULAR EQUIPOS DE CÓMPUTO (10%)</label>
                <select class="form-control" id="accesoEquiposComputo">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="accesoCuartoTelecomunicaciones">ACCESO AL CUARTO PRINCIPAL DE TELECOMUNICACIONES (20%)</label>
                <select class="form-control" id="accesoCuartoTelecomunicaciones">
                    <option value="1">Sin impacto relevante.</option>
                    <option value="3">Bajo impacto.</option>
                    <option value="7">Impacto moderado pero no crítico.</option>
                    <option value="10">Impacto crítico.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ponderacionSeguridadInformatica">PONDERACIÓN SEGURIDAD INFORMÁTICA</label>
                <input type="text" class="form-control" id="ponderacionSeguridadInformatica" readonly>
            </div>
        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
<script>
function formatDecimal(number) {
    // Convertir el número a string y eliminar el cero decimal si existe
    const formatted = parseFloat(number).toFixed(2).replace(/\.?0+$/, '');
    return formatted;
}

function calcularPonderaciones() {
    // Obtener los valores seleccionados de los select y convertir a números
    const contactoCarga = parseFloat(document.getElementById('contactoCarga').value) || 0;
    const accesoAreasCriticas = parseFloat(document.getElementById('accesoAreasCriticas').value) || 0;
    const accesoInfoConfidencial = parseFloat(document.getElementById('accesoInfoConfidencial').value) || 0;
    const supervisionInterior = parseFloat(document.getElementById('supervisionInterior').value) || 0;
    const laborInstalaciones = parseFloat(document.getElementById('laborInstalaciones').value) || 0;
    const relacionProductoExportacion = parseFloat(document.getElementById('relacionProductoExportacion').value) || 0;

    // Calcular ponderación de Seguridad Física
    const ponderacionFisica = (contactoCarga * 0.20) + (accesoAreasCriticas * 0.20) + (accesoInfoConfidencial * 0.20) + 
                              (supervisionInterior * 0.10) + (laborInstalaciones * 0.10) + (relacionProductoExportacion * 0.20);

    // Mostrar la ponderación en el campo correspondiente
    document.getElementById('ponderacionSeguridadFisica').value = formatDecimal(ponderacionFisica);

    // Obtener los valores seleccionados de los select de Seguridad Informática
    const accesoRedTelecomunicaciones = parseFloat(document.getElementById('accesoRedTelecomunicaciones').value) || 0;
    const accesoAntivirus = parseFloat(document.getElementById('accesoAntivirus').value) || 0;
    const accesoDispositivoSeguridad = parseFloat(document.getElementById('accesoDispositivoSeguridad').value) || 0;
    const accesoHostingDominio = parseFloat(document.getElementById('accesoHostingDominio').value) || 0;
    const accesoCopiasSeguridad = parseFloat(document.getElementById('accesoCopiasSeguridad').value) || 0;
    const accesoEquiposComputo = parseFloat(document.getElementById('accesoEquiposComputo').value) || 0;
    const accesoCuartoTelecomunicaciones = parseFloat(document.getElementById('accesoCuartoTelecomunicaciones').value) || 0;

    // Calcular ponderación de Seguridad Informática
    const ponderacionInformatica = (accesoRedTelecomunicaciones * 0.20) + (accesoAntivirus * 0.10) + (accesoDispositivoSeguridad * 0.20) +
                                    (accesoHostingDominio * 0.10) + (accesoCopiasSeguridad * 0.10) + (accesoEquiposComputo * 0.10) +
                                    (accesoCuartoTelecomunicaciones * 0.20);

    // Mostrar la ponderación en el campo correspondiente
    document.getElementById('ponderacionSeguridadInformatica').value = formatDecimal(ponderacionInformatica);
}

// Llamar a la función para calcular las ponderaciones al cargar la página o cuando sea necesario
calcularPonderaciones();

// Agregar eventos 'change' a los select para que se calcule la ponderación automáticamente al cambiar las opciones
document.getElementById('contactoCarga').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoAreasCriticas').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoInfoConfidencial').addEventListener('change', calcularPonderaciones);
document.getElementById('supervisionInterior').addEventListener('change', calcularPonderaciones);
document.getElementById('laborInstalaciones').addEventListener('change', calcularPonderaciones);
document.getElementById('relacionProductoExportacion').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoRedTelecomunicaciones').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoAntivirus').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoDispositivoSeguridad').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoHostingDominio').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoCopiasSeguridad').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoEquiposComputo').addEventListener('change', calcularPonderaciones);
document.getElementById('accesoCuartoTelecomunicaciones').addEventListener('change', calcularPonderaciones);


    </script>