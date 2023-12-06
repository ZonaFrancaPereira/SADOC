<?php 
include('vencimientos.php');
session_start();
if (isset($_SESSION['ingreso'])) {
	header('location: ../../index.php');
}else{
	session_unset();
	session_destroy();
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>PLATAFORMA ZFIP</title>
		<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' /> 
		<meta name="viewport" content="width=device-width" /> 

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="./admin/plugins/fontawesome-free/css/all.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Tempusdominus Bootstrap 4 -->
		<link rel="stylesheet" href="./admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="./admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		<!-- JQVMap -->
		<link rel="stylesheet" href="./admin/plugins/jqvmap/jqvmap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="./admin/dist/css/adminlte.min.css">
		<link rel="stylesheet" href="./admin/dist/css/login.css">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="./admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="./admin/plugins/daterangepicker/daterangepicker.css">
		<!-- summernote -->
		<link rel="stylesheet" href="./admin/plugins/summernote/summernote-bs4.min.css">
	</head>

	<body class="hold-transition login-page" style="background-image: url(img/fondo_login.png); background-attachment: fixed;
	background-repeat: repeat-x;
	background-size: 100% 100%; ">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
		     
			<div class="card-header text-center">
			   
			     
				<a href="index.php" class="h1"><b>SADOC </b>ZFIP</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Inicia sesión para iniciar tu sesión</p>

				<form action="Validar_Ingreso.php" method="post">
					<label for="">Email *</label>
					<div class="input-group mb-3">
						
						<input type="email" class="form-control"  name="user" id="user" class="form-control"  placeholder="example@zonafrancadepereira.com" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<label for="">Contraseña *</label>
					<div class="input-group mb-3">
						
						<input type="password" name="pass" id="pass" class="form-control"  placeholder="****************" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						
						<!-- /.col -->
						<div class="col-12">
							<button type="submit" class="btn btn-success btn-block">Ingresar</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
		
		
	</div>
	<br>
	
	<center>
		<img src="img/333.png" alt="" class="img-responsive" style="width:60%">

	</center>
	<footer><B>SADOC 3.0 © Copyright <?php echo date("Y");?>, ZFIP SAS</B></footer>
	<!-- jQuery -->
	<script src="./admin/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="./admin/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="./admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="./admin/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="./admin/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="./admin/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="./admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="./admin/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="./admin/plugins/moment/moment.min.js"></script>
	<script src="./admin/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="./admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="./admin/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="./admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="./admin/dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="./admin/dist/js/demo.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="./admin/dist/js/pages/dashboard.js"></script>
	
	<script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
</body>
</html>
<?php 
}
?>