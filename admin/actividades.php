
<?php
session_start();
if ($_SESSION['ingreso']==true) {
 require('php/conexion.php');
 require('plantilla.php');
 $id_acpm=$_GET['id_acpm'];
 ?>
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

            <div class="tab-pane " id="actividades" >
            <form  id="form_actividades" method="POST" action="php/insertar_actividad.php">
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
                    <input type="date" name="fecha_actividad" class="form-control" id="fecha_actividad"  required>
                  </div>
                  <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                    <label for="descripcion_actividad">Descripcion de la Actividad</label>
                    <textarea class="form-control" id="descripcion_actividad" name="descripcion_actividad"  ></textarea>
                  </div>
                  <div class="col-2 col-xs-12 col-sm-12">
                    <label for="estado_actividad">Estado de la Actividad</label>
                    <select class="form-control" id="estado_actividad" name="estado_actividad"  required>
                      <option value="completa">Completa</option>
                      <option value="incompleta">Incompleta</option>
                    </select>
                  </div>

                  <label for="id_usuario">Nombre del Responsable:</label>
                    <input list="browsers" id="id_usuario" name="id_usuario" />
                    <datalist id="browsers">
                    <?php 
                      try {
                        $stmt = $conn->prepare('SELECT * FROM  usuarios '); 
                        $stmt-> execute();
                        if($stmt->rowCount()>0){
                          while ($row=$stmt->fetch()) {
                            $id_usuario=$row["Id_usuario"];
                            $nombre_usuario=$row["nombre_usuario"];
                            $apellidos_usuario=$row["apellidos_usuario"];
                            echo'<option value='.$id_usuario.'>'.$nombre_usuario.' '.$apellidos_usuario.'</option>';
                          } }
                        } catch (PDOException $e) {
                          echo "Error en el servidor";
                        }
                        ?>
                    </datalist>
                  <div class="col-2 col-xs-12 col-sm-12">
                    <label for="id_acpm">ID acpm</label>
                    <input type="number" class="form-control" value="<?php echo $id_acpm; ?>"  name="id_acpm" readonly>
                  </div>
                  </div>
              <!-- /.card-body -->
              <br>
              <div class="col-md-12 col-xs-12 col-sm-12" >
                <button type="submit" class="btn btn-success btn-block " id="enviar_actividad" name="enviar_actividad">Asignar Actividad</button>
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
  <?php  require('footer.php'); ?>
</body>
</html>
