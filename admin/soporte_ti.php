<?php
session_start();
if ($_SESSION['ingreso'] == true) {
    require('php/conexion.php');
    require('plantilla.php');
?>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php
            if ($_SESSION['rol_usuario'] == "admin_sig" || $_SESSION['rol_usuario'] == "directivo" || $_SESSION['rol_usuario'] == "admin_contable" || $_SESSION['rol_usuario'] == "gerencia") {
            ?>

            <?php
            }
            ?>
            <li class="nav-item" name="">
                <a data-toggle="tab" href="#principal" class="nav-link">
                    <i class="fas fa-th-large"></i>
                    <p>Principal</p>
                </a>
            </li>
            <?php
    if ($_SESSION['nombre_cargo'] == "Auxiliar Tecnologia e Informatica" || $_SESSION['nombre_cargo'] == "Coordinadora Tecnologia e Informatica") {
    ?>
            <li class="nav-item" name="">
                        <a data-toggle="tab" href="#solicitudes_soporte" class="nav-link">
                            <i class="nav-icon fas fa-sync-alt"></i>
                            <p>Solicitudes de Soporte</p>
                        </a>
                    </li>
                    <?php
    }
    ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-search-plus"></i>
                    <p>
                        Acciones
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    
                    <li class="nav-item">
                        <a data-toggle="tab" href="#realizar_solicitud" class="nav-link">
                            <i class="nav-icon far fa-question-circle"></i>
                            <p>Realizar Solicitud</p>
                        </a>
                    </li>
                </ul>
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

<div class="content-wrapper">
    <div id="wrapper" class="toggled">
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="tab-content card">
                    <!-- /.panel principal -->
                    <div id="principal" class="tab-pane">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-danger">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-bullhorn mr-2"></i>
                                            Escala de Urgencia
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="alert bg-danger text-center">
                                                    <h4 class="mb-0">1</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert bg-danger">
                                                    <p class="mb-0">Urgente: se tendrá máximo un día para ser atendidas</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="alert bg-warning text-center">
                                                    <h4 class="mb-0">2</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert bg-warning">
                                                    <p class="mb-0">Urgencia media: tendrán 2 días para ser cerradas</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="alert bg-success text-center">
                                                    <h4 class="mb-0">3</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="alert bg-success">
                                                    <p class="mb-0">Prioridad baja: tendrán 4 días para su cierre</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-warning">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Respuesta
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert bg-danger">
                                            <h5 class="mb-3"><i class="icon fas fa-ban"></i> Urgente!</h5>
                                            <p>Solicitudes que requieren atención inmediata debido a que afectan significativamente la productividad del proceso y pueden causar interrupciones graves si no se abordan de inmediato.</p>
                                        </div>
                                        <div class="alert bg-warning">
                                            <h5 class="mb-3"><i class="icon fas fa-info"></i> Urgencia media!</h5>
                                            <p>Solicitudes que son importantes para mantener la eficiencia del proceso y que, si no se atienden oportunamente, podrían generar problemas a medio plazo.</p>
                                        </div>
                                        <div class="alert bg-success">
                                            <h5 class="mb-3"><i class="icon fas fa-exclamation-triangle"></i> Prioridad baja!</h5>
                                            <p>Solicitudes que tienen cierta importancia pero que no tienen un impacto inmediato en la productividad del proceso. Se pueden abordar en un plazo razonable sin causar grandes inconvenientes.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header bg-gradient-warning">
                                        <h3 class="card-title text-white">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Solicitudes Realizadas
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Descripción de la Solicitud</th>
                                                        <th>Fecha</th>
                                                        <th>Escala de Urgencia</th>
                                                        <th>Solución</th>
                                                        <th>Fecha Solución</th>
                                                        <th>Usuario quien da respuesta</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($conn->query("SELECT * FROM soporte where Id_usuario_fk = $_SESSION[Id]") as $row) {
                                                        $urgencia = $row["urgencia"]; // Obtener el valor de urgencia
                                                        // Determinar el color de fondo de la fila
                                                        $colorFondo = determinarColor($urgencia);
                                                    ?>
                                                        <tr style="text-align:center" class="<?php echo $colorFondo; ?>">
                                                            <td><?php echo $row["descripcion_soporte"] ?></td>
                                                            <td><?php echo $row["fecha_soporte"] ?></td>
                                                            <td><?php echo $row["urgencia"] ?></td>
                                                            <td><?php echo $row["solucion_soporte"] ?></td>
                                                            <td><?php echo $row["fecha_solucion"] ?></td>
                                                            <td><?php echo $row["usuario_respuesta"] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.SOLICITUDES REALIZADAS-->
                    <div id="solicitudes_soporte" class="tab-pane">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Solicitudes Realizadas
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="card-body table-responsive p-0">
                                        <table class="display table table-striped table-valign-middle " width="100%">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>Nombre del Usuario</th>
                                                    <th>Descripción de la Solicitud</th>
                                                    <th>Fecha</th>
                                                    <th>Escala de Urgencia</th>
                                                    <th>Solución</th>
                                                    <th>Fecha Solucion</th>
                                                    <th>Asignar Urgencia</th>
                                                    <th>Responder</th>
                                                    <th>Usuario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Definir una función para determinar el color basado en la escala de urgencia
                                                function determinarColor($urgencia)
                                                {
                                                    switch ($urgencia) {
                                                        case 1:
                                                            return 'bg-danger'; //Rojo para alta urgencia 
                                                            break;
                                                        case 2:
                                                            return 'bg-warning'; // Amarillo para media urgencia
                                                            break;
                                                        case 3:
                                                            return 'bg-success'; // Verde para baja urgencia
                                                            break;
                                                        default:
                                                            return ''; // Por defecto no se aplica ningún color
                                                            break;
                                                    }
                                                }
                                                foreach ($conn->query("SELECT * FROM soporte") as $row) {
                                                    $id_soporte = $row["id_soporte"];
                                                    $id_soporte1 = $row["id_soporte"];
                                                    $urgencia = $row["urgencia"];
                                                    // Determinar el color de fondo de la fila
                                                    $colorFondo = determinarColor($urgencia);
                                                ?>
                                                    <tr style="text-align:center" class="<?php echo $colorFondo; ?>">
                                                        <td><?php echo $row["usuario_soporte"] ?></td>
                                                        <td><?php echo $row["descripcion_soporte"] ?></td>
                                                        <td><?php echo $row["fecha_soporte"] ?></td>
                                                        <td><?php echo $row["urgencia"] ?></td>
                                                        <td><?php echo $row["solucion_soporte"] ?></td>
                                                        <td><?php echo $row["fecha_solucion"] ?></td>
                                                        <td><button class="btn bg-orange" data-toggle="modal" data-target="#modal-urgencia" data-id_soporte="<?php echo $row['id_soporte'] ?>"><i class="fas fa-hourglass-half"></i></button></td>
                                                        <td><button class="btn  bg-orange" data-toggle="modal" data-target="#modal-solicitud" data-id_soporte1="<?php echo $row['id_soporte'] ?>"><i class="fas fa-file-signature"></i></button></td>
                                                        <td><?php echo $row["usuario_respuesta"] ?></td>
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
                        <section class="content">
                            <div class="modal fade" id="modal-urgencia">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h4 class="modal-title">Asignar el tipo de Urgencia a la Solicitud</h4>
                                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form_soporte_urgencia" method="POST">
                                                <div class="card border-danger">
                                                    <div class="card-header bg-danger text-white" hidden>
                                                        <h5 class="card-title mb-0">ID de Soporte:</h5>
                                                        <input type="text" class="form-control mb-3" value="" id="id_soporte" name="id_soporte" readonly>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons" id="grupo_urgencia">
                                                            <label class="btn btn-outline-danger active">
                                                                <input type="radio" name="urgencia" value="1" autocomplete="off" checked> 1
                                                            </label>
                                                            <label class="btn btn-outline-warning">
                                                                <input type="radio" name="urgencia" value="2" autocomplete="off"> 2
                                                            </label>
                                                            <label class="btn btn-outline-success">
                                                                <input type="radio" name="urgencia" value="3" autocomplete="off"> 3
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-transparent border-top-0">
                                                        <button type="button" class="btn bg-info text-white btn-block" id="responder_urgencia" name="responder_urgencia">Asignar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="content">
                            <div class="modal fade" id="modal-solicitud">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                            <h4 class="modal-title text-white">Responder Solicitud de Soporte</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form_soporte_respuesta" method="POST">
                                                <div class="form-group" hidden>
                                                    <label>Desea Darle Respuesta a esta Solicitud de Soporte:</label><input type="text" class="form-control" value="" name="id_soporte1" id="id_soporte1" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="solucion_soporte">Solución</label>
                                                    <textarea class="form-control" id="solucion_soporte" name="solucion_soporte" rows="3" placeholder="Escribe aquí la solución"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_solucion">Fecha Solución</label>
                                                    <input type="date" name="fecha_solucion" class="form-control" id="fecha_solucion" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="usuario_respuesta">Nombre de Usuario quien da respuesta a la solicitud</label>
                                                    <input list="usuario_respuesta_browsers" class="form-control" id="usuario_respuesta" name="usuario_respuesta" placeholder="Nombre de Usuario">
                                                    <datalist id="usuario_respuesta_browsers">
                                                        <?php
                                                        try {
                                                            $stmt = $conn->prepare('SELECT * FROM  usuarios WHERE proceso_usuario_fk = 2 ');
                                                            $stmt->execute();
                                                            if ($stmt->rowCount() > 0) {
                                                                while ($row = $stmt->fetch()) {
                                                                    $id_usuario = $row["Id_usuario"];
                                                                    $nombre_usuario = $row["nombre_usuario"];
                                                                    $apellidos_usuario = $row["apellidos_usuario"];
                                                                    echo '<option value="' . $nombre_usuario . ' ' . $apellidos_usuario . '"></option>';
                                                                }
                                                            }
                                                        } catch (PDOException $e) {
                                                            echo "Error en el servidor";
                                                        }
                                                        ?>
                                                    </datalist>
                                                </div>
                                                <button type="button" class="btn btn-info btn-block" id="responder_solicitud" name="responder_solicitud">Responder</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- /.FORMULARIO PARA REALIZAR SOLICITUD DE SOPORTE -->
                    <div id="realizar_solicitud" class="tab-pane">
                        <div class="card card-custom">
                            <div class="card-header bg-warning">
                                <center>
                                    <h3 class="card-title">¡Haz tu Solicitud de Soporte Aquí!</h3>
                            </div>
                            <form id="soporte_ti" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="correo">Correo</label>
                                            <input list="correo_soporte_browsers" class="form-control" id="correo_soporte" name="correo_soporte" placeholder="Correo">
                                            <datalist id="correo_soporte_browsers">
                                                <?php
                                                try {
                                                    $stmt = $conn->prepare('SELECT * FROM usuarios');
                                                    $stmt->execute();
                                                    if ($stmt->rowCount() > 0) {
                                                        while ($row = $stmt->fetch()) {
                                                            $correo_usuario = $row["correo_usuario"];
                                                            $Id_usuario_soporte = $row["Id_usuario"];
                                                            $nombre_usuario = $row["nombre_usuario"];
                                                            $apellidos_usuario = $row["apellidos_usuario"];
                                                            $proceso_usuario_fk = $row["proceso_usuario_fk"];
                                                            echo '<option value="' . $correo_usuario . '" data-nombreusuario="' . $nombre_usuario . ' ' .  $apellidos_usuario . '" data-procesousuario="' . $proceso_usuario_fk . '" data-idusuario="' . $Id_usuario_soporte . '">' . $nombre_usuario . ' ' .  $apellidos_usuario . '</option>';
                                                        }
                                                    }
                                                } catch (PDOException $e) {
                                                    echo "Error en el servidor";
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                        <div class="col-md-6 mb-3" hidden>
                                            <label for="id_usuario_soporte">id usuario</label>
                                            <input type="text" class="form-control" id="id_usuario_soporte" name="id_usuario_soporte" placeholder="ID de Usuario" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="usuario_soporte">Nombre de Usuario</label>
                                            <input type="text" class="form-control" id="usuario_soporte" name="usuario_soporte" placeholder="Nombre de Usuario" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="proceso_soporte">Proceso</label>
                                            <input type="text" class="form-control" id="proceso_soporte" name="proceso_soporte" placeholder="Proceso" readonly>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="textarea">Descripción de la solicitud</label>
                                            <textarea class="form-control" id="descripcion_soporte" name="descripcion_soporte" rows="3" placeholder="Descripción"></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div id="actions">
                                            <div class="col-lg-6">
                                                <div class="btn-group w-100">
                                                    <input type="file" class="btn btn-success col" id="imagenes_soporte" name="imagenes_soporte">
                                                    <button type="submit" class="btn btn-primary col start" hidden>
                                                        <i class="fas fa-upload"></i>
                                                        <span>Start upload</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-warning col cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Cancelar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-outline-warning btn-block" id="enviar_soporte" name="enviar_soporte"><i class="fas fa-paper-plane"></i>Enviar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('footer.php'); ?>
<script>
    $('#modal-urgencia').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_soporte = button.data('id_soporte'); // Extract info from data-* attributes

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #id_soporte').val(id_soporte);
    });
    $('#modal-solicitud').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_soporte1 = button.data('id_soporte1'); // Extract info from data-* attributes

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #id_soporte1').val(id_soporte1);
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtenemos todos los botones de urgencia
        const urgenciaButtons = document.querySelectorAll(".btn-group .btn");

        // Agregamos un listener de clic a cada botón
        urgenciaButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Obtenemos el valor de urgencia del atributo data-value del botón
                const urgenciaValue = this.getAttribute("data-value");

                // Asignamos el valor de urgencia al campo de entrada oculto
                document.getElementById("urgencia").value = urgenciaValue;
            });
        });
    });
</script>
</body>

</html>