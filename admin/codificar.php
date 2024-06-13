<?php
require('seguridad.php');
//INICIALIZAR VARIABLE
$id_actividad = 0;
?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        if ($_SESSION['nombre_cargo'] == "Coordinador SIG") {
        ?>
            <li class="nav-item" name="">
                <a data-toggle="tab" href="#respuesta_solicitud_sig" class="nav-link">
                    <i class="nav-icon fas fa-sync-alt"></i>
                    <p>Responder Solicitud</p>
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="tab" href="#solicitudes_solucionadas" class="nav-link">
                    <i class="nav-icon far fa-question-circle"></i>
                    <p>Solicitudes Terminadas</p>
                </a>
            </li>
        <?php
        }
        ?>
        <li class="nav-item">
            <a data-toggle="tab" href="#codificar_solicitud_sig" class="nav-link">
                <i class="nav-icon far fa-question-circle"></i>
                <p>Realizar Solicitud</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#solicitudes_rechazadas" class="nav-link">
                <i class="nav-icon far fa-question-circle"></i>
                <p>Solicitudes Rechazadas</p>
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" href="#solicitudes_realizadas" class="nav-link">
                <i class="nav-icon far fa-question-circle"></i>
                <p>Solicitudes Realizadas</p>
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
                <div class="tab-content card">
                    <!-- FORMULARIO DE SOLICITUD DE CODIFICACION DE DOCUMENTOS -->
                    <div id="codificar_solicitud_sig" class="tab-pane">
                        <div class="tab-pane  show active" id="panelc">
                            <div id="" class="tab-pane">
                                <div class="card-body">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">General Elements</h3>
                                        </div>
                                        <div class="card-body">

                                            <form id="codificar" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Vigencia</label>
                                                            <select class="form-control select2" style="width: 100%;" id="vigencia" name="vigencia">
                                                                <option value="Nuevo">Nuevo</option>
                                                                <option value="Antiguo">Antiguo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="fecha_solicitud_cod">Fecha </label>
                                                            <input type="date" name="fecha_solicitud_cod" class="form-control" id="fecha_solicitud_cod" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="usuario_solicitud_cod">Solicitado por</label>
                                                        <input type="text" class="form-control" id="usuario_solicitud_cod" value="<?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario'] ?>" name="usuario_solicitud_cod" readonly>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="cargo_solicitud_cod">Cargo</label>
                                                        <input type="text" class="form-control" id="cargo_solicitud_cod" value="<?php echo $_SESSION['nombre_cargo'] ?>" name="cargo_solicitud_cod" placeholder="Proceso" readonly>
                                                    </div>
                                                    <div class="col-sm-3" hidden>
                                                        <label for="correo_solicitante">Correo</label>
                                                        <input type="text" class="form-control" id="correo_solicitante" value="<?php echo $_SESSION['correo_usuario'] ?>" name="correo_solicitante" readonly>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="nombre_documento">Nombre del Documento</label>
                                                        <input type="text" class="form-control" id="nombre_documento" name="nombre_documento" placeholder="Nombre del Documento">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="codigo">Código</label>
                                                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="textarea">Descripción del Cambio </label>
                                                        <textarea class="form-control" id="descripcion_cambio" name="descripcion_cambio" rows="3" placeholder="Descripción"></textarea>
                                                    </div>
                                                    <div class="container col-md-12">
                                                        <div class="col-md-12">
                                                            <label for="textarea">Link Documento Modificado</label>
                                                            <textarea class="editor" id="link_formato_codificacion" name="link_formato_codificacion" style="display: none;"></textarea>
                                                            <!-- Contenedor para el contenido de Quill -->
                                                            <div class="quill-content"></div>
                                                        </div>
                                                        <!-- Asegurarse de que el siguiente contenedor esté fuera del anterior -->
                                                    </div>
                                                    <div class="col-md-12 bg-info pt-2 mt-3">
                                                            <center>
                                                                <h5>POLÍTICA DE ELABORACIÓN, REVISIÓN Y APROBACIÓN</h5>
                                                            </center>
                                                        </div>
                                                    <div class="col-sm-4 border-right"><br>
                                                        <label for="elabora" style="text-align: center; display: block; margin: auto;" class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">ELABORA</label>
                                                        <br>
                                                        <label for="elabora_nombre">Nombre</label>
                                                        <input type="text" class="form-control" id="elabora_nombre" name="elabora_nombre" placeholder="Nombre">
                                                        <label for="elabora_correo">Cargo</label>
                                                        <input type="text" class="form-control" id="elabora_correo" name="elabora_correo" placeholder="Cargo">
                                                    </div>
                                                    <div class="col-sm-4 border-right"><br>
                                                        <label for="elabora" style="text-align: center; display: block; margin: auto;" class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">REVISA</label>
                                                        <br>
                                                        <label for="revisa_nombre">Nombre</label>
                                                        <input type="text" class="form-control" id="revisa_nombre" name="revisa_nombre" placeholder="Nombre">
                                                        <label for="revisa_correo">Cargo</label>
                                                        <input type="text" class="form-control" id="revisa_correo" name="revisa_correo" placeholder="Cargo">
                                                    </div>
                                                    <div class="col-sm-4 border-right"><br>
                                                        <label for="elabora" style="text-align: center; display: block; margin: auto;" class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">APRUEBA</label>
                                                        <br>
                                                        <label for="aprueba_nombre">Nombre</label>
                                                        <input type="text" class="form-control" id="aprueba_nombre" name="aprueba_nombre" placeholder="Nombre">
                                                        <label for="aprueba_correo">Cargo</label>
                                                        <input type="text" class="form-control" id="aprueba_correo" name="aprueba_correo" placeholder="Cargo">
                                                    </div>
                                                    <div class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">
                                                        <center>
                                                            <h5>DOCUMENTOS RELACIONADOS O ANEXOS</h5>
                                                        </center>
                                                    </div>
                                                    <h8>Enliste a continuación los documentos relacionados o anexos del documento en modificación y determine si el cambio los afecta. En caso positivo, proceda con la actualización adicional aplicable al documento identificado, siguiendo los lineamientos del procedimiento de control de documentos. Anexe tantas celdas como sea necesario y evalúe conscientemente cada documento que cita a continuación</h8>
                                                    <div class="col-md-12 col-xs-12 col-sm-12 pt-2">
                                                        <table class="table pt-2" id="tabla">
                                                            <thead>
                                                                <tr>
                                                                    <th>Código</th>
                                                                    <th>Nombre</th>
                                                                    <th>¿Se afecta? (SI / NO)</th>
                                                                    <th>X</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="fila-fija ">
                                                                    <td class="col-md-2">
                                                                        <input type="text" id="codigo_doc_afectado[]" name="codigo_doc_afectado[]" class="codigo_doc_afectado form-control" placeholder="Código" step="any">
                                                                    </td>
                                                                    <td class=" col-md-2">
                                                                        <input type="text" id="nombre_doc_afectado[]" name="nombre_doc_afectado[]" class="nombre_doc_afectado form-control" placeholder="Nombre" step="any">
                                                                    </td>
                                                                    <td class=" col-md-2">
                                                                        <select class="form-control select2" id="afecta[]" name="afecta[]">
                                                                            <option value=""></option>
                                                                            <option value="Si">Si</option>
                                                                            <option value="No">No</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="eliminar col-md-1">
                                                                        <input type="button" class="btn btn-danger" value="X" />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for=""><B>Añade más campos</B></label>
                                                                <button id="adicional" name="adicional" type="button" class="adicional btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">
                                                        <center>
                                                            <h5>DIFUSIONES</h5>
                                                        </center>
                                                    </div> 
                                                    <div class="col-sm-5 border-right"><br>
                                                        <label for="elabora" style="text-align: center; display: block; margin: auto;" class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">INTERNA</label>
                                                        <div class="form-group clearfix"><br>
                                                            <label for="">Todos los Colaboradores</label>
                                                            <div class="icheck-success d-inline">
                                                                <input type="radio" id="radioPrimary1" name="todos_colaboradores" value="Si">
                                                                <label for="radioPrimary1">Sí, enviar </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group clearfix"><br>
                                                            <label for="">Sólo Líderes de Proceso</label>
                                                            <div class="icheck-success d-inline">
                                                                <input type="radio" id="radioPrimary3" name="solo_lider" value="Si">
                                                                <label for="radioPrimary3">Sí, enviar </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group clearfix"><br>
                                                            <label for="">Sólo Miembros de un Proceso</label>
                                                            <div class="icheck-success d-inline">
                                                                <input type="radio" id="radioPrimary5" name="miembros_proceso" value="Si">
                                                                <label for="radioPrimary5">Sí, enviar </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group clearfix"><br>
                                                            <label for="">Colaborador (s) Específico</label>
                                                            <div class="icheck-success d-inline">
                                                                <input type="radio" id="radioPrimary7" name="colaborador_especifico" value="Si">
                                                                <label for="radioPrimary7">Sí, enviar </label>
                                                            </div>
                                                        </div>
                                                        <table class="table pt-2" id="tabla3">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Correo</th>
                                                                    <th>X</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="fila-fija3 ">
                                                                    <td class="col-md-2">
                                                                        <input type="text" name="nombre_interna[]" class="nombre_interna form-control" placeholder="Nombre" step="any">
                                                                    </td>
                                                                    <td class=" col-md-2">
                                                                        <input type="text" name="correo_interna[]" class="correo_interna form-control" placeholder="Correo" step="any">
                                                                    </td>
                                                                    <td class="eliminar col-md-1">
                                                                        <input type="button" class="btn btn-danger" value="X" />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for=""><B>Añade más campos</B></label>
                                                                <button id="adicional3" name="adicional3" type="button" class="adicional3 btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-6"><br>
                                                        <label for="elabora" style="text-align: center; display: block; margin: auto;" class="col-12 bg-info pt-2 mt-3 col-xs-12 col-sm-12">Externa</label>
                                                        <table class="table pt-2" id="tabla2">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Correo</th>
                                                                    <th>X</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="fila-fija2 ">
                                                                    <td class="col-md-2">
                                                                        <input type="text" name="nombre_externa[]" class="nombre_externa form-control" placeholder="Nombre" step="any">
                                                                    </td>
                                                                    <td class=" col-md-2">
                                                                        <input type="text" name="correo_externa[]" class="correo_externa form-control" placeholder="Correo" step="any">
                                                                    </td>
                                                                    <td class="eliminar col-md-1">
                                                                        <input type="button" class="btn btn-danger" value="X" />
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for=""><B>Añade más campos</B></label>
                                                                <button id="adicional2" name="adicional2" type="button" class="adicional2 btn btn-info btn-block"> <i class="fas fa-plus"></i> Agregar</button>
                                                            </div>
                                                        </div>

                                                        <div class="form-group clearfix"><br>
                                                            <div class="icheck-success d-inline">
                                                                ¿Se requiere envío de copia NO controlada del Documento, a las partes externas?
                                                                <input type="radio" id="radioPrimary9" name="enviar_copia" value="Si">
                                                                <label for="radioPrimary9">Sí, enviar copia</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div><br>
                                                Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, usted declara que conoce nuestra política de tratamiento de datos personales disponible en: www.politicadeprivacidad.co/politica/zfipusuariooperador, también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS con NIT 900311215 para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 col-sm-12"><br>
                                                        <button type="button" class="btn btn-info btn-block " id="enviar_solicitud_codificacion" name="enviar_solicitud_codificacion">Enviar Solicitud</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- respuesta-->
                    <div id="respuesta_solicitud_sig" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive p-0">
                                        <table class="display table table-striped table-valign-middle " width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Solicitado por</th>
                                                    <th>Cargo</th>
                                                    <th>Nombre del Documento</th>
                                                    <th>Codigo</th>
                                                    <th>Descripcion Cambio</th>
                                                    <th>Informe</th>
                                                    <th>Responder</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($conn->query("SELECT * from solicitud_codificacion WHERE fecha_sig_codificacion IS NULL OR fecha_sig_codificacion = ''") as $row) { {
                                                        $id_codificacion = $row["id_codificacion"];
                                                ?>
                                                        <tr style=text-align:center>
                                                            <td><?php echo $row["id_codificacion"] ?></td>
                                                            <td><?php echo $row["usuario_solicitud_cod"] . " " . $row["apellidos_usuario"] ?></td>
                                                            <td><?php echo $row["cargo_solicitud_cod"] ?></td>
                                                            <td><?php echo $row["nombre_documento"] ?></td>
                                                            <td><?php echo $row["codigo"] ?></td>
                                                            <td>
                                                                <p class="text-break" style="width: 10rem">
                                                                    <?php
                                                                    $descripcion_cambio = $row["descripcion_cambio"];
                                                                    $max_caracteres = 200; // Cambia esto al número máximo de caracteres que deseas mostrar
                                                                    echo strlen($descripcion_cambio) > $max_caracteres ? substr($descripcion_cambio, 0, $max_caracteres) . "..." : $descripcion_cambio;
                                                                    ?>
                                                                </p>
                                                            </td>
                                                            <td><a href='codificacionpdf.php?id_codificacion=<?php echo $id_codificacion; ?>' target='_blank'> <button class='btn bg-info'><i class="far fa-file-pdf"></i> </button></a></td>
                                                            <td><button class="btn  bg-info" data-toggle="modal" data-target="#modal-codificar" data-id_codificacion="<?php echo $row['id_codificacion'] ?>"><i class="fas fa-rocket"></i></button></td>
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
                    <!-- /RESPUESTA CODIFICACION -->
                    <section class="content">
                        <div class="modal fade" id="modal-codificar">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header btn bg-info btn-block">
                                        <h4 class="modal-title">RESPUESTA</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <form id="form_modificar_sig" method="POST" action="php/insertar_respuesta_codificacion.php">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <label>Desea dar respuesta a la siguiente solicitud de codificacion:</label>
                                                        <input type="text" class="form-control" value="" name="id_codificacion" id="id_codificacion" readonly>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                                <label for="">Estado</label>
                                                                <select class="form-control select2" style="width: 100%;" id="estado_sig_codificacion" name="estado_sig_codificacion">
                                                                    <option value="Aprobado">Aprobado</option>
                                                                    <option value="Rechazado">Rechazado</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                                <label for="fecha">Fecha</label>
                                                                <input type="date" name="fecha_sig_codificacion" class="form-control" id="fecha_sig_codificacion" required>
                                                            </div>
                                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                                <label for="responsable">Responsable</label>
                                                                <input type="text" name="responsable_sig_codificacion" class="form-control" id="responsable_sig_codificacion" value="Yuli Viviana Rios" readonly>
                                                            </div>
                                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                                <label for="textarea">Descripción del Rechazo</label>
                                                                <textarea class="form-control" id="causa_rechazo_codificacion" name="causa_rechazo_codificacion" rows="3" placeholder="Descripción"></textarea>
                                                            </div>
                                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                                <br>
                                                                <label for="textarea" >Evidencia de Difusion</label>
                                                                <textarea class="editor2" id="evidencia_difucion" name="evidencia_difucion" style="display: none;"></textarea>
                                                                <!-- Contenedor para el contenido de Quill -->
                                                                <div class="quill-content" id="editor1" ></div>
                                                            </div>
                                                            
                                                            <br>
                                                            <div class="col-md-12 col-xs-12 col-sm-12"><br><br><br><br><br>
                                                                <br>
                                                                <button type="button" class="btn bg-info btn-block" id="respuesta_codificacion_sig" name="respuesta_codificacion_sig">Responder</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                    <!-- /SOLICITUDES SOLUCIONADAS -->
                    <div id="solicitudes_solucionadas" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive p-0">
                                        <table class="display table table-striped table-valign-middle " width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Solicitado por</th>
                                                    <th>Cargo</th>
                                                    <th>Nombre del Documento</th>
                                                    <th>Codigo</th>
                                                    <th>Descripcion Cambio</th>
                                                    <th>Informe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($conn->query("SELECT * from solicitud_codificacion where fecha_sig_codificacion IS NOT NULL AND fecha_sig_codificacion != ''") as $row) { {
                                                        $id_codificacion = $row["id_codificacion"];
                                                ?>
                                                        <tr style=text-align:center>
                                                            <td><?php echo $row["id_codificacion"] ?></td>
                                                            <td><?php echo $row["usuario_solicitud_cod"] . " " . $row["apellidos_usuario"] ?></td>
                                                            <td><?php echo $row["cargo_solicitud_cod"] ?></td>
                                                            <td><?php echo $row["nombre_documento"] ?></td>
                                                            <td><?php echo $row["codigo"] ?></td>
                                                            <td>
                                                                <p class="text-break" style="width: 10rem">
                                                                    <?php
                                                                    $descripcion_cambio = $row["descripcion_cambio"];
                                                                    $max_caracteres = 200; // Cambia esto al número máximo de caracteres que deseas mostrar
                                                                    echo strlen($descripcion_cambio) > $max_caracteres ? substr($descripcion_cambio, 0, $max_caracteres) . "..." : $descripcion_cambio;
                                                                    ?>
                                                                </p>
                                                            </td>
                                                            <td><a href='codificacionpdf.php?id_codificacion=<?php echo $id_codificacion; ?>' target='_blank'> <button class='btn bg-info'><i class="far fa-file-pdf"></i> </button></a></td>
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
                    <!-- /SOLICITUDES RECHAZADAS DE CADA USUARIO -->
                    <div id="solicitudes_rechazadas" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive p-0">
                                        <table class="display table table-striped table-valign-middle" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Solicitado por</th>
                                                    <th>Cargo</th>
                                                    <th>Nombre del Documento</th>
                                                    <th>Código</th>
                                                    <th>Descripción Rechazo</th>
                                                    <th>Informe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM solicitud_codificacion WHERE estado_sig_codificacion = 'Rechazado' AND cargo_solicitud_cod = '{$_SESSION['nombre_cargo']}'";
                                                foreach ($conn->query($query) as $row) {
                                                    $id_codificacion = $row["id_codificacion"];
                                                ?>
                                                    <tr style="text-align:center">
                                                        <td><?php echo $row["id_codificacion"]; ?></td>
                                                        <td><?php echo $row["usuario_solicitud_cod"] . " " . $row["apellidos_usuario"]; ?></td>
                                                        <td><?php echo $row["cargo_solicitud_cod"]; ?></td>
                                                        <td><?php echo $row["nombre_documento"]; ?></td>
                                                        <td><?php echo $row["codigo"]; ?></td>
                                                        <td>
                                                            <p class="text-break" style="width: 10rem">
                                                                <?php
                                                                $causa_rechazo_codificacion = $row["causa_rechazo_codificacion"];
                                                                $max_caracteres = 200; // Cambia esto al número máximo de caracteres que deseas mostrar
                                                                echo strlen($causa_rechazo_codificacion) > $max_caracteres ? substr($causa_rechazo_codificacion, 0, $max_caracteres) . "..." : $causa_rechazo_codificacion;
                                                                ?>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <a href='codificacionpdf.php?id_codificacion=<?php echo $id_codificacion; ?>' target='_blank'>
                                                                <button class='btn bg-info'><i class="far fa-file-pdf"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /SOLICITUDES REALIZADAS DE CADA USUARIO -->
                    <div id="solicitudes_realizadas" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-body table-responsive p-0">
                                        <table class="display table table-striped table-valign-middle" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Solicitado por</th>
                                                    <th>Cargo</th>
                                                    <th>Nombre del Documento</th>
                                                    <th>Código</th>
                                                    <th>Informe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM solicitud_codificacion WHERE cargo_solicitud_cod = '{$_SESSION['nombre_cargo']}'";
                                                foreach ($conn->query($query) as $row) {
                                                    $id_codificacion = $row["id_codificacion"];
                                                ?>
                                                    <tr style="text-align:center">
                                                        <td><?php echo $row["id_codificacion"]; ?></td>
                                                        <td><?php echo $row["usuario_solicitud_cod"] . " " . $row["apellidos_usuario"]; ?></td>
                                                        <td><?php echo $row["cargo_solicitud_cod"]; ?></td>
                                                        <td><?php echo $row["nombre_documento"]; ?></td>
                                                        <td><?php echo $row["codigo"]; ?></td>
                                                        <td>
                                                            <a href='codificacionpdf.php?id_codificacion=<?php echo $id_codificacion; ?>' target='_blank'>
                                                                <button class='btn bg-info'><i class="far fa-file-pdf"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require('footer.php'); ?>
            <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            </aside>
        </div>
    </div>
</div>
<style>
    .ql-toolbar {
        background-color: white;
        /* Cambiar el color de fondo de la barra de herramientas */
        color: white;
        /* Cambiar el color del texto en la barra de herramientas */
    }
    

</style>
</body>
<script>
    $('#modal-codificar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_codificacion = button.data('id_codificacion'); // Extract info from data-* attributes

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #id_codificacion').val(id_codificacion);
    });
   
</script>

</html>