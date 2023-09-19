<?php 
session_start();
if ($_SESSION['ingreso']==true) {
 require('php/conexion.php');
 require('plantilla.php');
 require('acpm.php');
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
    <a data-toggle="tab" href="#acpm" class="nav-link ">
      <i class="nav-icon fas fa-th"></i>
      <p>
        Nueva ACPM
        <span class="right badge badge-success">Nueva</span>
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-edit"></i>
      <p>
        Consultas
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a data-toggle="tab" href="#abiertas" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Acciones Abiertas</p>
        </a>
      </li>
      <li class="nav-item" name="cerradas">
        <a data-toggle="tab" href="#cerradas" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Acciones Cerradas</p>
        </a>
      </li>

    </ul>
  </li>
</ul>

</nav>
<footer >
  <small class="bg-teal">SADOC 3.0 &copy; Copyright 2022, ZFIP SAS</small>
</footer>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<?php
  //require('include/footer.php');

}else{
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
          <div  class="tab-pane  show active" id="panelc">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

            <div class="tab-pane " id="acpm" >
            <form  id="form_actividades" method="POST">
              <div class="card card-navy">
                <div class="card-header">
                  <center>  
                    <h4>ASIGNAR ACTIVIDADES</h4>
                  </center>
                </div>
                <div class="card-body">
                  <div class="row">
                  <div class="col-md-12 col-xs-12 col-sm-12">
                <label for="fecha_actividad">Fecha Actividad</label>
                    <input type="date" name="fecha_actividad" class="form-control" id="fecha_actividad" required>
                  </div>
                  <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                    <label for="descripcion_actividad">Descripcion de la Actividad</label>
                    <textarea class="form-control" id="descripcion_actividad" name="descripcion_actividad" rows="1" ></textarea>
                  </div>
                  <div class="col-2 col-xs-12 col-sm-12">
                    <label for="estado_actividad">Estado de la Actividad</label>
                    <select class="form-control" id="estado_actividad" name="estado_actividad" required>
                      <option value="completa">Completa</option>
                      <option value="incompleta">Incompleta</option>
                    </select>
                  </div>
                  <div class="col-2 col-xs-12 col-sm-12">
                    <label for="responsable_actividad">Responsable de la Actividad</label>
                    <select class="form-control" id="estado_actividad" name="estado_actividad" required>
                    <option value="completa">Completa</option>
                      <option value="incompleta">Incompleta</option>
                    </select>
                  </div>
                  </div>
              <!-- /.card-body -->
              <br>
              <div class="col-md-12 col-xs-12 col-sm-12" >
                <button type="button" class="btn btn-success btn-block " id="enviar_actividad" name="enviar_actividad">Asignar Actividad</button>
              </div>
            </div>
          </form>
          <!-- /.card -->
        </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>