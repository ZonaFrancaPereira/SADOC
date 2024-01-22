<?php
include "sumatorias.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Plataforma ZFIP</title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0," name="viewport">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="Shortcut Icon" href="favicon.ico" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">


  <div class="wrapper">
    <!-- Navbar PARA CERRAR SESION Y AÑADIR OPCIONES DENTRO DEL SISTEMA -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" title="Sistema Integrado de Gestión">SIG</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="sadoc.php" class="dropdown-item" target="_blank">SADOC </a></li>
            <li><a href="acpm.php" class="dropdown-item">ACPM</a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" title="Contabilidad y Finanzas">CT</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <?php
            if ($_SESSION['rol_usuario'] == "admin_sig" || $_SESSION['rol_usuario'] == "directivo" || $_SESSION['rol_usuario'] == "superadmin" || $_SESSION['rol_usuario'] == "directivo" || $_SESSION['rol_usuario'] == "gerencia" || $_SESSION['rol_usuario'] == "aux_cotizacion" || $_SESSION['rol_usuario'] == "aux_contable" || $_SESSION['rol_usuario'] == "admin_contable") {
            ?>
              <li>
                <a href="ordenes.php" class="dropdown-item">Ordenes de Compra</a>
              </li>
              <li>
                <a href="activos.php" class="dropdown-item">Activos Fijos</a>
              </li>
            <?php
            }
            ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" title="Gestión Tecnología e Informática">G-TI</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="asignacion_ti.php" class="dropdown-item">Asignación de Equipos</a></li>
            <li><a href="backup_ti.php" class="dropdown-item">Backup</a></li>
            <li><a href="inventario_ti.php" class="dropdown-item">Inventario TI</a></li>
            <li><a href="licencias_ti..php" class="dropdown-item">Licencias</a></li>
            <li><a href="mantenimientos_ti.php" class="dropdown-item">Mantenimientos</a></li>
            <li><a href=".php" class="dropdown-item">Matriz de Usuarios y Criticidad</a></li>
            <li><a href="soporte_ti.php" class="dropdown-item">Soporte</a></li>
            <li><a href="ti.php" class="dropdown-item">Usuarios</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" title="Gestión Jurídica">JU</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="asociados_ju.php" class="dropdown-item">Asociados de Negocios</a></li>
        
          </ul>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- MENU PARA DISPOSITIVOS MOVILES -->
        <li class="nav-item dropdown d-block d-sm-block d-md-none">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-list-ul"></i>
            <span class="badge badge-warning navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Otros Aplicativos</span>
            <div class="dropdown-divider"></div>
            <a href="sadoc.php" class="dropdown-item">
              <i class="fas fa-folder-open"></i> SADOC
              <span class="float-right text-muted text-sm">Ir</span>
            </a>
            <?php if ($_SESSION['ordenes'] == "Si") { ?>
              <div class="dropdown-divider"></div>
              <a href="ordenes.php" class="dropdown-item">
                <i class="fas fa-money-check-alt"></i> Ordenes de Compra
                <span class="float-right text-muted text-sm">Ir</span>
              </a>
            <?php } ?>
            <div class="dropdown-divider"></div>
            <a href="acpm.php" class="dropdown-item">
              <i class="fas fa-tasks"></i> ACPM
              <span class="float-right text-muted text-sm">Ir</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="index.php" class="dropdown-item dropdown-footer">Plataforma ZFIP</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-danger navbar-badge"><?= $notificaciones = ($total_acpm + $cantidad_orden + $total_actividades_vencidas); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><B><?= $notificaciones; ?> Pendientes</B></span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="far fa-times-circle mr-2"></i> <?= $total_acpm; ?> | ACPM Pendientes
              <span class="float-right badge badge-info">Pendientes</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="far fa-thumbs-down mr-2"></i> <?= $total_actividades_vencidas; ?> | Actividades Vencidas
              <span class="float-right badge badge-danger">Urgente</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-cart-plus mr-2"></i> <?= $cantidad_orden; ?> | Ordenes en Proceso
              <span class="float-right badge badge-success">Proceso</span>
            </a>

          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">

            <i class="fas fa-cogs"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <i class="dropdown-item dropdown-header">Opciones</i>
            <div class="dropdown-divider"></div>
            <a href="close.php" class="dropdown-item">
              <i class="fas fa-sign-in-alt mr-2"></i> Cerrar Sesion

            </a>
            <div class="dropdown-divider"></div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">PLATAFORMA ZFIP</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="info text-center">
            <B>
              <a href="./profile.php?section=<?php echo $_SESSION['Id']; ?>" class="d-block text-uppercase"><?php echo $_SESSION['nombre_usuario']; ?></a>

            </B>
          </div>
        </div>