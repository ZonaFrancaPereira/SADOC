<?php
session_start();
if ($_SESSION['ingreso'] == true) {
	require('php/conexion.php');
	require('plantilla.php');


	$Id = $_SESSION['Id'];
	try {
		$stmt = $conn->prepare("SELECT * FROM usuarios
		WHERE Id_usuario='$Id'");
		$stmt->execute();
		$registros = 1;
		if ($stmt->rowCount() > 0) {

			while ($row = $stmt->fetch()) {
				$correo_usuario = $row["correo_usuario"];
				$contrasena_usuario = $row["contrasena_usuario"];
				$nombre_usuario = $row["nombre_usuario"];
				$firma_usuario = $row["firma_usuario"];
			}
		} else {
			echo '<option value="0">No existen proveedores</option>';
		}
	} catch (PDOException $e) {
		echo "Error en el servidor";
	}
	if (isset($_POST['update'])) {
		$Id = $_SESSION['Id'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$nombre_archivo2 = uniqid() . "_" . $_FILES["firma_usuario"]["name"]; // Generar un nombre único para la imagen

		$guardar_img2 = $_FILES['firma_usuario']['tmp_name'];
		if ($pass1 == "" && $pass2 == "") {
			if (move_uploaded_file($guardar_img2, 'firmas/' . $nombre_archivo2)) {
				try {
					// Consulta de actualización
					$sql = "UPDATE usuarios SET firma_usuario = '$nombre_archivo2' WHERE Id_usuario = $Id";

					// Ejecutar la consulta
					if ($conn->query($sql) === TRUE) {
						echo "Registro actualizado correctamente.";
					} else {
						echo "FALLO";
					}
				} catch (PDOException $e) {
					echo "Error en el servidor";
				}
			}
		}
	}


?>


	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item" hidden>
				<a data-toggle="tab" href="#panelc" class="nav-link active">
					<i class="nav-icon fas fa-th"></i>
					<p>
						Panel de Control
					</p>
				</a>
			</li>
			<li class="nav-item" hidden>
				<a data-toggle="tab" href="#orden" class="nav-link ">
					<i class="nav-icon fas fa-th"></i>
					<p>
						Nueva Orden
						<span class="right badge badge-success">Nueva</span>
					</p>
				</a>
			</li>
			<li class="nav-item" hidden>
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-edit"></i>
					<p>
						Consultar Ordenes
						<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview" hidden>
					<li class="nav-item">
						<a data-toggle="tab" href="#pendientes" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Pendientes</p>
						</a>
					</li>
					<li class="nav-item" hidden>
						<a data-toggle="tab" href="#aprobadas" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Aprobadas</p>
						</a>
					</li>
					<li class="nav-item" hidden>
						<a data-toggle="tab" href="#ejecuccion" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>En Ejecucion</p>
						</a>
					</li>
					<li class="nav-item" hidden>
						<a data-toggle="tab" href="#ejecutadas" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>Ejecutadas</p>
						</a>
					</li>

				</ul>
			</li>
			<li class="nav-item" hidden>
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
<?php
	//require('include/footer.php');

} else {
	session_unset();
	session_destroy();
	header('location: index.php');
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Perfil</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
						<li class="breadcrumb-item active">Usuario</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<img class="profile-user-img img-fluid " src="img/logo_zf.png">
							</div>

							<h3 class="profile-username text-center text-uppercase"><?php echo $_SESSION['nombre_usuario'] . " " . $_SESSION['apellidos_usuario']; ?></h3>
							<h3 class="profile-username text-center "><?php echo $_SESSION['nombre_cargo'] . " " . $_SESSION['proceso_fk']; ?></h5>
								<span class=" btn btn-primary btn-block fa fa-fw fa-eye password-icon show-password "> Mostrar Contraseña</span>

						</div>
						<!-- Button trigger modal -->
						<button type="button" class="btn bg-teal" data-toggle="modal" data-target="#exampleModal">
							Aviso de Datos Personales
						</button>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Aviso Proteccion de Datos Personales </h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
									<p>AVISO DE REGISTRO ELECTRÓNICO DE DATOS: Al registrar y entregar sus datos personales mediante este mecanismo electrónico de página web y/o similares, usted declara que conoce nuestra política de tratamiento de datos personales disponible en: www.politicadeprivacidad.co/politica/zfipusuariooperador, también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS con NIT 900.311.215-6 para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.</p>

									</div>
								
								</div>
							</div>
						</div>

						<!-- /.card-body -->
					</div>
					<!-- /.card -->


					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills">

								<li class="nav-item "><a class="nav-link active" href="#settings" data-toggle="tab">Configurar Perfil</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">


								<div class="active tab-pane" id="settings">
									<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
										<div class="form-group row">
											<label for="inputName" class="col-sm-2 col-form-label">Usuario</label>
											<div class="col-sm-10">

												<input type="text" name="nombre_usuario" class="form-control" value="<?php echo $nombre_usuario; ?>" readonly>
											</div>
										</div>

										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Contraseña Actual</label>
											<div class="col-sm-10">

												<input type="password" name="" value="<?php echo $contrasena_usuario ?>" class="form-control password3" placeholder="Ingrese su actual contraseña">
											</div>
										</div>
										<div class="form-group row">
											<label for="usertag" class="col-sm-2 col-form-label">Nueva Contraseña <font color='brown'> (opcional)</font></label>
											<div class="col-sm-10">
												<input type="password" name="pass1" class="form-control password1 " placeholder="Ingrese nueva contraseña">

											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Confirmar Contraseña </label>
											<div class="col-sm-10">

												<input type="password" name="pass2" class="form-control password2" placeholder="Confirme su nueva contraseña">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Firma </label>
											<div class="col-sm-10">
												<?php if ($firma_usuario == "") {
													echo "<p>Te solicitamos amablemente adjuntar tu firma a nuestra plataforma. Tu firma es esencial para validar y completar los procesos en curso.
													";
												} else { ?>
													<center>
														<img src="firmas/<?php echo $firma_usuario ?>" alt="Firma Gerente " width="250" class="text-center img-thumbnail">
													</center>
												<?php }
												?>
												<input type="file" name="firma_usuario" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-success btn-block" name="update" value="Update User">Guardar Cambios</button>
											</div>
										</div>
									</form>


								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>


<?php require('footer.php'); ?>

<script>
	window.addEventListener("load", function() {

		// icono para mostrar contraseña
		showPassword = document.querySelector('.show-password');
		showPassword.addEventListener('click', () => {

			// elementos input de tipo clave
			password3 = document.querySelector('.password3');
			password1 = document.querySelector('.password1');
			password2 = document.querySelector('.password2');

			if (password1.type === "text") {
				password1.type = "password"
				password2.type = "password"
				password3.type = "password"
				showPassword.classList.remove('fa-eye-slash');
			} else {
				password1.type = "text"
				password2.type = "text"
				password3.type = "text"
				showPassword.classList.toggle("fa-eye-slash");
			}

		})

	});
</script>