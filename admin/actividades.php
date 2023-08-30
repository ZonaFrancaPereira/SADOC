<?php 
session_start();
if ($_SESSION['ingreso']==true) {
 require('php/conexion.php');
 require('plantilla.php');
 ?>
 

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

<div class="content-wrapper">
  <div id="wrapper" class="toggled">

    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="tab-content card">
          <!-- DIV DONDE SE MUESTRA TODA LA INFORMACION DE INTERES DE LAS ACPM PARA CADA USUARIO -->   
          <div  class="tab-pane  show active" id="actividades">
          <div class="content-wrapper">
</div>
</body>
</html>