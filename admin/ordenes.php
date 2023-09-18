        <?php
        session_start();

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        if ($_SESSION['ingreso'] == true) {
          require('php/conexion.php');
          require('plantilla.php');
          if (isset($_POST['enviar_orden'])) {
            $id_cotizante = $_SESSION['Id'];
            $fecha_orden = $_POST['fecha_orden'];
            $id_proveedor_fk = $_POST['id_proveedor_fk'];
            $forma_pago = $_POST['forma_pago'];
            $tiempo_pago = $_POST['tiempo_pago'];
            $porcentaje_anticipo = $_POST['porcentaje_anticipo'];
            $condiciones_negociacion = $_POST['condiciones_negociacion'];
            $comentario_orden = $_POST['comentario_orden'];
            $tiempo_entrega = $_POST['tiempo_entrega'];
            $total_orden = $_POST['total_orden'];
            $proveedor_recurrente = $_POST['proveedor_recurrente'];
            if ($total_orden >= "1000000") {
              $estado_orden = "Analisis de Cotizacion";
              $analisis_cotizacion = "Si";
            } else {
              $estado_orden = "Proceso";
              $analisis_cotizacion = "No";
            }
            //INSERTAR LOS DATOS QUE NO SE REPITEN EN LA ORDEN
            try {
              $stmt = $conn->prepare('INSERT INTO orden_compra(fecha_orden,proveedor_recurrente,forma_pago,tiempo_pago,porcentaje_anticipo,condiciones_negociacion,comentario_orden,tiempo_entrega,total_orden,analisis_cotizacion,estado_orden,id_cotizante,id_proveedor_fk)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
              $stmt->bindParam(1, $fecha_orden);
              $stmt->bindParam(2, $proveedor_recurrente);
              $stmt->bindParam(3, $forma_pago);
              $stmt->bindParam(4, $tiempo_pago);
              $stmt->bindParam(5, $porcentaje_anticipo);
              $stmt->bindParam(6, $condiciones_negociacion);
              $stmt->bindParam(7, $comentario_orden);
              $stmt->bindParam(8, $tiempo_entrega);
              $stmt->bindParam(9, $total_orden);
              $stmt->bindParam(10, $analisis_cotizacion);
              $stmt->bindParam(11, $estado_orden);
              $stmt->bindParam(12, $id_cotizante);
              $stmt->bindParam(13, $id_proveedor_fk);

              if ($stmt->execute()) {
                echo "SI";
                $id_orden_compra = $conn->lastInsertId();
              } else {
                echo "ERROR";
              }
            } catch (PDOException $e) {
              echo "Se ha producido un error al intentar conectar al servidor MySQL: " . $e->getMessage();
            }

            $items1 = ($_POST['articulo_compra']);
            $items2 = ($_POST['cantidad_orden']);
            $items3 = ($_POST['valor_neto']);
            $items4 = ($_POST['valor_iva']);
            $items5 = ($_POST['valor_total']);
            $items6 = ($_POST['observaciones_articulo']);
            $items7 = ($id_orden_compra);

            while (true) {
              //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
              $item1 = current($items1);
              $item2 = current($items2);
              $item3 = current($items3);
              $item4 = current($items4);
              $item5 = current($items5);
              $item6 = current($items6);
              $item7 = $items7;
              ////// ASIGNARLOS A VARIABLES ///////////////////
              $articulo_compra = (($item1 !== false) ? $item1 : ", &nbsp;");
              $cantidad_orden = (($item2 !== false) ? $item2 : ", &nbsp;");
              $valor_neto = (($item3 !== false) ? $item3 : ", &nbsp;");
              $valor_iva = (($item4 !== false) ? $item4 : ", &nbsp;");
              $valor_total = (($item5 !== false) ? $item5 : ", &nbsp;");
              $observaciones_articulo = (($item6 !== false) ? $item6 : ", &nbsp;");
              $id_orden_compra = $item7;
              //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
              $valores = '("' . $articulo_compra . '","' . $cantidad_orden . '","' . $valor_neto . '","' . $valor_iva . '","' . $valor_total . '","' . $observaciones_articulo . '","' . $id_orden_compra . '"),';

              //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
              $valoresQ = substr($valores, 0, -1);

              ///////// QUERY DE INSERCIÓN ////////////////////////////
              $sql = "INSERT INTO detalle_orden (articulo_compra,cantidad_orden,valor_neto,valor_iva,valor_total,observaciones_articulo,id_orden_compra) 
                VALUES $valoresQ";

              $conn->query($sql);
              // Up! Next Value
              $item1 = next($items1);
              $item2 = next($items2);
              $item3 = next($items3);
              $item4 = next($items4);
              $item5 = next($items5);
              $item6 = next($items6);

              // Check terminator
              if ($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false && $item6 === false) break;
            }
            if ($analisis_cotizacion == "Si" && $proveedor_recurrente == "No") {
              $email = "ymontoya@zonafrancadepereira.com";
              $nombre_usuario = $_SESSION['nombre_usuario'];
              $apellidos_usuario = $_SESSION['apellidos_usuario'];
              require 'mail/autoload.php';
              $mail = new PHPMailer(true);
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;
              $mail->isSMTP();
              $mail->Host = 'smtp.hostinger.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'noreply@empleo.zonafrancadepereira.com';
              $mail->Password = 'Az2314zf*';
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;
              $mail->CharSet = 'UTF-8';
              $mail->setFrom('noreply@empleo.zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');
              $mail->addAddress($email);
              $mail->isHTML(true);
              $titulo_correo = "ANALISIS DE COTIZACIÓN #" . $id_orden_compra . " / " . $fecha_orden;
              $message  = "<html><body>";

              $message .= '
                  <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                    <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
                    <h1>Nueva Orden de Compra #' . $id_orden_compra . ' <h1/>
                </div>
                <div style="padding: 20px;">
                    <p>Hola, Isabel Cristina Bustamante</p>
                    <p>Te informamos que hay una nueva orden de compra de ' . $nombre_usuario . ' ' . $apellidos_usuario . ' por un valor de $' . number_format($total_orden) . ' esperando a que revises el análisis de cotización.</p>
                    <p>Por favor, inicia sesión en nuestro sistema para revisar y procesar la orden. <br>
                    <center>
                    <a href="www.google.com" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesion</button></p><a><center>
                    <p>¡Gracias!</p>
                </div>
                <div style=" text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;">
                    <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                </div>
            </div>
              ';
              //CIERRE FINAL 
              $message .= "</body></html>";

              $mail->isHTML(true);
              $mail->Subject =  $titulo_correo;
              $mail->Body =  $message;
              $mail->send();

              echo 'Correo enviado';
              echo "<script> 
                  window.location.href='./index.php'; </script>";
            } else {
              $email = "ymontoya@zonafrancadepereira.com";
              $nombre_usuario = $_SESSION['nombre_usuario'];
              $apellidos_usuario = $_SESSION['apellidos_usuario'];
              require 'mail/autoload.php';
              $mail = new PHPMailer(true);
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;
              $mail->isSMTP();
              $mail->Host = 'smtp.hostinger.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'noreply@empleo.zonafrancadepereira.com';
              $mail->Password = 'Az2314zf*';
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;
              $mail->CharSet = 'UTF-8';
              $mail->setFrom('noreply@empleo.zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');
              $mail->addAddress($email);
              $mail->isHTML(true);
              $titulo_correo = "NUEVA ORDEN DE COMPRA #" . $id_orden_compra . " / " . $fecha_orden;
              $message  = "<html><body>";

              $message .= '
                  <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                    <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png" >  
                    <h1>Nueva Orden de Compra #' . $id_orden_compra . ' <h1/>
                </div>
                <div style="padding: 20px;">
                    <p>Hola, Andrea Galan</p>
                    <p>Te informamos que hay una nueva orden de compra de ' . $nombre_usuario . ' ' . $apellidos_usuario . ' por un valor de $' . number_format($total_orden) . ' esperando tu aprobación</p>
                    <p>Por favor, inicia sesión en nuestro sistema para revisar y procesar la orden. <br>
                    <center>
                    <a href="www.google.com" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesion</button></p><a><center>
                    <p>¡Gracias!</p>
                </div>
                <div style=" text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;">
                    <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                </div>
            </div>
              ';
              //CIERRE FINAL 
              $message .= "</body></html>";
              $mail->isHTML(true);
              $mail->Subject =  $titulo_correo;
              $mail->Body =  $message;
              $mail->send();
              echo 'Correo enviado';
              echo "<script> 
                  window.location.href='./index.php'; </script>";
            }
          }
        }
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
              <a data-toggle="tab" href="#pendientes" class="nav-link ">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Consultar Ordenes
                </p>
              </a>
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
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <div id="wrapper" class="toggled">
            <div id="page-content-wrapper">
              <div class="container-fluid">
                <div class="tab-content card">
                  <!-- DIV DONDE SE MUESTRA TODA LA INFORMACION DE INTERES DE LAS ACPM PARA CADA USUARIO -->
                  <div class="tab-pane  show active" id="panelc">
                    <div class="row">
                      <div class="col-lg-12">
                        <!-- /.card -->
                        <div class="card">
                          <div class="card-header border-0">
                            <h3 class="card-title">Tus Ordenes</h3>
                          </div>
                          <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                              <p class="text-info text-xl">
                                <i class="fas fa-file-signature"></i>
                              </p>
                              <p class="d-flex flex-column text-right">
                                <span class="text-muted"> <B>8</B></span>
                                <span class="text-muted">Esperando Aprobación</span>
                              </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                              <p class="text-danger text-xl">
                                <i class="fas fa-file-pdf"></i>
                              </p>
                              <p class="d-flex flex-column text-right">
                                <span class="text-muted"> <B>8</B></span>
                                <span class="text-muted">Pendiente Analisis de Cotización</span>
                              </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                              <p class="text-success text-xl">
                                <i class="fas fa-money-check-alt"></i>
                              </p>
                              <p class="d-flex flex-column text-right">
                                <span class="text-muted"> <B>8</B></span>
                                <span class="text-muted">Pendientes de pago</span>
                              </p>
                            </div>
                            <!-- /.d-flex -->
                          </div>
                        </div>
                      </div>
                      <!-- /.col-md-6 -->
                      <div class="col-lg-12">
                        <!-- /.card -->
                        <div class="card">
                          <div class="card-header border-0">
                            <h3 class="card-title">Ordenes por Aprobar</h3>
                            <div class="card-tools">
                              <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                              </a>
                              <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-bars"></i>
                              </a>
                            </div>
                          </div>
                          <div class="card-body table-responsive p-0">
                            <table class="display table table-striped table-valign-middle">
                              <thead>
                                <tr>
                                  <th># Orden</th>
                                  <th>Cotizante</th>
                                  <th>Fecha</th>
                                  <th>Valor</th>
                                  <th>Ver</th>
                                  <th>Aprobar</th>
                                  <th>Declinar</th>
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
                                     WHERE  c.estado_orden = "Proceso" ');
                                  $stmt->execute();
                                  $registros = 1;
                                  if ($stmt->rowCount() > 0) {

                                    while ($row = $stmt->fetch()) {

                                      $id_orden = $row["id_orden"];
                                      $nombre_usuario = $row["nombre_usuario"];
                                      $apellidos_usuario = $row["apellidos_usuario"];
                                      echo "<tr>";
                                      echo "<td >" . $id_orden . "</td>";
                                      echo "<td >" . $nombre_usuario . " " . $apellidos_usuario . "</td>";
                                      echo "<td>" . $row["fecha_orden"] . "</td>";
                                      echo "<td>$ " . number_format($row["total_orden"]) . "</td>";
                                      echo "<td>  <button class='btn btn-primary'><i class='fas fa-eye'></i> </button></td>";
                                      echo "<td>  <button class='btn btn-success'><i class='fas fa-thumbs-up'></i> </button></td>";
                                      echo "<td>  <button class='btn btn-danger'><i class='fas fa-thumbs-down'></i> </button></td>";
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
                        <!-- /.card -->
                      </div>
                      <!-- /.col-md-6 -->
                      <div class="col-lg-12">
                        <!-- /.card -->
                        <div class="card">
                          <div class="card-header border-0">
                            <h3 class="card-title">Pendiente Analisis de Cotización</h3>
                            <div class="card-tools">

                            </div>
                          </div>
                          <div class="card-body table-responsive p-0">
                            <table class="display table table-striped table-valign-middle">
                              <thead>
                                <tr>
                                  <th># Orden</th>
                                  <th>Cotizante</th>
                                  <th>Fecha</th>
                                  <th>Valor</th>
                                  <th>Ver</th>
                                  <th>Recibido</th>
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
                                  WHERE  c.estado_orden = "Analisis de Cotizacion" ');
                                  $stmt->execute();
                                  $registros = 1;
                                  if ($stmt->rowCount() > 0) {

                                    while ($row = $stmt->fetch()) {

                                      $id_orden = $row["id_orden"];
                                      $nombre_usuario = $row["nombre_usuario"];
                                      $apellidos_usuario = $row["apellidos_usuario"];
                                      echo "<tr>";
                                      echo "<td >" . $id_orden . "</td>";
                                      echo "<td >" . $nombre_usuario . " " . $apellidos_usuario . "</td>";
                                      echo "<td>" . $row["fecha_orden"] . "</td>";
                                      echo "<td>$ " . number_format($row["total_orden"]) . "</td>";
                                      echo "<td>  <button class='btn btn-primary'><i class='fas fa-eye'></i> </button></td>";
                                      echo "<td>  <button class='btn btn-success'><i class='fas fa-thumbs-up'></i> </button></td>";

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
                        <!-- /.card -->
                      </div>
                      <div class="col-lg-12">
                        <!-- /.card -->
                        <div class="card">
                          <div class="card-header border-0">
                            <h3 class="card-title">Pendiente Analisis de Cotización</h3>
                            <div class="card-tools">

                            </div>
                          </div>
                          <div class="card-body table-responsive p-0">
                            <table class="display table table-striped table-valign-middle">
                              <thead>
                                <tr>
                                  <th># Orden</th>
                                  <th>Cotizante</th>
                                  <th>Fecha</th>
                                  <th>Valor</th>
                                  <th>Ver</th>
                                  <th>Recibido</th>
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
                                  WHERE  c.estado_orden = "Proceso" ');
                                  $stmt->execute();
                                  $registros = 1;
                                  if ($stmt->rowCount() > 0) {

                                    while ($row = $stmt->fetch()) {

                                      $id_orden = $row["id_orden"];
                                      $nombre_usuario = $row["nombre_usuario"];
                                      $apellidos_usuario = $row["apellidos_usuario"];
                                      echo "<tr>";
                                      echo "<td >" . $id_orden . "</td>";
                                      echo "<td >" . $nombre_usuario . " " . $apellidos_usuario . "</td>";
                                      echo "<td>" . $row["fecha_orden"] . "</td>";
                                      echo "<td>$ " . number_format($row["total_orden"]) . "</td>";
                                      echo "<td>  <button class='btn btn-primary'><i class='fas fa-eye'></i> </button></td>";
                                      echo "<td>  <button class='btn btn-success'><i class='fas fa-thumbs-up'></i> </button></td>";

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
                        <!-- /.card -->
                      </div>
                    </div>
                  </div>
                  <!-- DIV DONDE SE MOSTRARA EL FORMULARIO PARA UNA NUEVA ORDEN DE COMPRA-->
                  <div class="tab-pane " id="orden">
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
                  <!-- DIV DONDE SE MUESTRAN LAS ORDENES PENDIENTES DE CADA USUARIO-->
                  <div id="pendientes" class="tab-pane ">
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
                                      echo "<td>  <button class='btn btn-primary'><i class='fas fa-eye'></i> </button></td>";
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
                  <!-- DIV DONDE SE MUESTRAN LOS PROVEEDORES DE CADA USUARIO-->
                  <div id="proveedores" class="tab-pane">
                    <div class="row">
                      <div class="col-lg-12 ">
                        <div class="card">
                          <div class="card-header border-0 bg-navy">
                            <h3 class="card-title">Administra tus Proveedores</h3>
                          </div>
                          <br><br>
                          <!-- Button trigger modal -->

                          <button type="button" class="btn btn-primary col-md-6 col-lg-6" data-toggle="modal" data-target="#exampleModal">
                            Agregar Proveedor
                          </button><br><br>

                          </section>
                          <div class="card">
                            <div class="card-header bg-warning">
                              <h3 class="card-title">Consulatar Proveedor</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
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
                                        $correo_proveedor = $row["correo_proveedor"];
                                        $telefono_proveedor = $row["telefono_proveedor"];
                                        echo "<tr>";
                                        echo "<td >" . $id_proveedor . "</td>";
                                        echo "<td >" . $nombre_proveedor . "</td>";
                                        echo "<td>" . $correo_proveedor . "</td>";
                                        echo "<td>" . $telefono_proveedor . "</td>";
                                        echo "<td>  <button class='btn btn-warning'><i class='fas fa-edit'></i> </button></td>";
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
                          <input type="number" class="form-control input-lg" id="id_proveedor" name="id_proveedor" placeholder="Identificación del Proveedor">
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                          <label>Razón Social</label>
                          <input type="text" class="form-control input-lg" id="nombre_proveedor" name="nombre_proveedor" placeholder="Nombre Proveedor">
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                          <label>Correo</label>
                          <input type="text" class="form-control input-lg" id="correo_proveedor" name="correo_proveedor" placeholder="Correo Proveedor">
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                          <label>Correo</label>
                          <input type="text" class="form-control input-lg" id="telefono_proveedor" name="telefono_proveedor" placeholder="Telefono Proveedor">
                        </div>
                      </div>
                    </div>

                  </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="guardarProveedor">Guardar Cambios</button>
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
        </script>

        </body>

        </html> 