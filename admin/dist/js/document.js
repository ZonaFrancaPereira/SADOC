$(document).ready(iniciar);

function iniciar() {
    
	$(".volver").hide();
	$(".sacar").show();
	$("#include_SIG").hide();
	$("#include_TI").hide();
	$("#include_CT").hide();
	$("#include_TEC").hide();
	$("#include_GH").hide();
	$("#include_GD").hide();
	$("#include_OP").hide();
	$("#include_JR").hide();
	$("#include_PH").hide();
	$("#include_GR").hide();
	$("#include_SST").hide();
	$("#include_PLE").hide();
	$("#include_Matriz_SIG").hide();
	$("#include_Matriz_TI").hide();
	$("#include_Matriz_GH").hide();
	$("#include_Matriz_OP").hide();
	$("#include_Matriz_GD").hide();
	$("#include_Matriz_CT").hide();
	$("#include_Matriz_PH").hide();
	$("#include_Matriz_CT").hide();
	$("#include_Matriz_GR").hide();
	$("#include_Matriz_TEC").hide();
	//esconder los botones de el panel (volver y panel principal)
	$("#panel").hide();
	$("#panel_TI").hide();
	$("#panel_CT").hide();
	$("#panel_TEC").hide();
	$("#panel_GH").hide();
	$("#panel_GD").hide();
	$("#panel_OP").hide();
	$("#panel_PH").hide();
	$("#panel_JR").hide();
	$("#panel_GR").hide();
	$("#panel_SST").hide();
	$("#panel_PLE").hide();
	$("#panel_MT_SIG").hide();
	$("#panel_MT_TI").hide();
	$("#panel_MT_GH").hide();
	$("#panel_MT_OP").hide();
	$("#panel_MT_GD").hide();
	$("#panel_MT_CT").hide();
	$("#panel_MT_PH").hide();
	$("#panel_MT_CT").hide();
	$("#panel_MT_GR").hide();
	$("#panel_MT_TEC").hide();
	


	//$("#sidebar-wrapper").hide();
	$("#wrapper").toggleClass("toggled");
	$(".sacar").click(mostrar);
	$(".volver").click(mostrar2);

	listar_cargos();
	$("#registrar_Usuario").click(insert_user);
	
}

function mostrar() {
	$("#wrapper").toggleClass("toggled");
	$(".volver").show();
	$(".sacar").hide();
}
function mostrar2() {
	$("#wrapper").toggleClass("toggled");
	$(".volver").hide();
	$(".sacar").show();
}


function activar_menus(cargo) {
	activar_menu_SIG(cargo);
	activar_menu_CT(cargo);
	activar_menu_TI(cargo);
	activar_menu_GH(cargo);
	activar_menu_TEC(cargo);
	activar_menu_GD(cargo);
	activar_menu_OP(cargo);
	activar_menu_PH(cargo);
	activar_menu_GR(cargo);
	activar_menu_SST(cargo);
	activar_menu_PLE(cargo);
	activar_menu_JR(cargo);
	$(".Matriz").hide();

	

}
//------------COMIENZO CODIGO PARA MENU GERENCIA MENU10 ------------------------------------//
function activar_menu_GR(cargo) {


	if (cargo == "GR") {
		$(".11").hide();
	}


	listar_Descargas_GR();

	function listar_Descargas_GR() {

		//carga de archivos de la base de datos:
		var ruta = "files/Gerencia/";
		var id_proceso_fk = "10";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_GR").html("");
				$("#descargas_GR").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GR);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}

			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_GR";
		var id_proceso_fk = "10";
		var json = {
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GR").html("");
				$("#folder_GR").html(data);
				$(".folder_MT_GR").click(consulta_folder_MT_GR);
				$(".folder_GR").click(consulta_folder_GR);
				$(".folder_GR").click(function () {
					$("#panel_GR").show();
					$("#recargar_GR").click(recargar_GR);
				});
				$(".folder_MT_GR").click(function () {
					$("#panel_GR").show();
					$("#recargar_GR").click(recargar_GR);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}

			}
		});

		var d = document.getElementById("GR");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_GR").click(consulta_sub_folder_GR);

		function consulta_sub_folder_GR() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "10";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_GR">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_GR [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "10";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_GR();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}

	}
	function consulta_folder_GR() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "10";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_GR").html("");
				$("#descargas_GR").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GR);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_GR' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='10' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";




		$("#subida_archivo_GR").html(" ");
		$("#archivos_GR").html(archivo);
		$("#include_GR").show();

		var direc = "../"+ruta;
		var d = document.getElementById("GR");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_GR";
		var id_proceso_fk ="10";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GR").html("");
				$("#folder_GR").html(data);
				$(".folder_MT_GR").click(consulta_folder_MT_GR);
				$(".folder_GR").click(consulta_folder_GR);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_GR");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Gerencia/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_GR").click(consulta_folder2_GR);
		
	}
	function consulta_folder_MT_GR() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk ="10";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_GR.php',
			success: function (data) {
				$("#descargas_GR").html("");
				$("#descargas_GR").html(data);
				if (cargo != "MT-GR") {
					$(".eliminar_MT_GR").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("GR");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_GR";
		var id_proceso_fk ="10";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GR").html("");
				$("#folder_GR").html(data);
				$(".folder_MT_GR").click(consulta_folder_MT_GR);
				$(".folder_GR").click(consulta_folder_GR);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_GR");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Gerencia/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_GR").click(consulta_folder2_GR);
	}
	function consulta_folder2_GR() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk ="10";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_GR").html("");
				$("#descargas_GR").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GR);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_GR";
		var id_proceso_fk ="10";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GR").html("");
				$("#folder_GR").html(data);
				$(".folder_MT_GR").click(consulta_folder_MT_GR);
				$(".folder_GR").click(consulta_folder_GR);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_GR");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/Gerencia/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/Gerencia/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_GR() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_GR();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "GR") {
		var b = document.getElementById("menu10");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_GR(){
		listar_Descargas_GR();
		$("#panel_GR").hide();

	}
}
//------------TERMINACIÖN CODIGO  GERENCIA -----------------------------------//

//------------COMIENZO CODIGO MENU 12 PARA PLE------------------------------------//
function activar_menu_PLE(cargo) {

	if (cargo == "TI" || cargo == "CT" || cargo == "TEC" || cargo == "GH" || cargo == "GD" || cargo == "OP" || cargo == "PH" || cargo == "GR" || cargo == "SST") {
		$(".11").hide();
	}

	listar_Descargas_PLE();

	function listar_Descargas_PLE() {

		//carga de archivos de la base de datos:
		var ruta = "files/PLE/";
		var id_proceso_fk = "12";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_PLE").html("");
				$("#descargas_PLE").html(data);
				$(".eliminar_archivo").click(eliminar_registro_PLE);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();
				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_PLE";
		var id_proceso_fk = "12";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PLE").html("");
				$("#folder_PLE").html(data);
				$(".folder_PLE").click(consulta_folder_PLE);
				$(".folder_PLE").click(function () {
					$("#panel_PLE").show();
					$("#recargar_PLE").click(recargar_PLE);
				})
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("PLE");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_PLE").click(consulta_sub_folder_PLE);

		function consulta_sub_folder_PLE() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "12";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_PLE">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_PLE [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "12";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_PLE();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}
	}
	function consulta_folder_PLE() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "12";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_PLE").html("");
				$("#descargas_PLE").html(data);
				$(".eliminar_archivo").click(eliminar_registro_PLE);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide(); 	
				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_PLE' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='12' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_PLE").html(" ");
		$("#archivos_PLE").html(archivo);
		$("#include_PLE").show();

		var direc = "../"+ruta;
		var d = document.getElementById("PLE");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_PLE";
		var id_proceso_fk = "12";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PLE").html("");
				$("#folder_PLE").html(data);
				$(".folder_PLE").click(consulta_folder_PLE);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_PLE");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/PLE/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_PLE").click(consulta_folder2_PLE);
	}
	function consulta_folder2_PLE() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "12";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_PLE").html("");
				$("#descargas_PLE").html(data);
				$(".eliminar_archivo").click(eliminar_registro_PLE);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_PLE";
		var id_proceso_fk = "12";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PLE").html("");
				$("#folder_PLE").html(data);
				$(".folder_PLE").click(consulta_folder_PLE);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_PLE");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/PLE/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/PLE/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_PLE() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_PLE();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_PLE(){
		listar_Descargas_PLE();
		$("#panel_PLE").hide();

	}
}
//------------TERMINACIÖN CODIGO PARA PLE------------------------------------//

//------------COMIENZO CODIGO MENU 1 PARA SIG------------------------------------//
function activar_menu_SIG(cargo) {

	listar_Descargas_SIG();

	function listar_Descargas_SIG() {

		//carga de archivos de la base de datos:
		var ruta = "files/SIG/";
		var id_proceso_fk="1";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_SIG").html("");
				$("#descargas_SIG").html(data);
				$(".eliminar_archivo").click(eliminar_registro_SIG);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}

			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_SIG";
		var id_proceso_fk="1";
		var json = {
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SIG").html("");
				$("#folder_SIG").html(data);
				$(".folder_SIG").click(consulta_folder);
				$(".folder_MT_SIG").click(consulta_folder_MT);
				$(".folder_SIG").click(function () {
					$("#panel").show();
					$("#recargar_SIG").click(recargar_SIG);
				});
				$(".folder_MT_SIG").click(function () {
					$("#panel").show();
					$("#recargar_SIG").click(recargar_SIG);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var b = document.getElementById("SIG");
		b.setAttribute("data-consulta", consulta);
		b.setAttribute("data-ruta", ruta);

		$(".new_folder_SIG").click(consulta_sub_folder);

		function consulta_sub_folder() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk="1";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk

			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta_SIG">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder [name=carpeta_SIG]").val();
					var ruta = "/"+direccion1;

					var folder = (`${result}`);
					var bar = {
						'folder':folder,
						'direccion':ruta
					}
					$.ajax({
						type:'POST',
						data:bar,
						url:'php/new_folder.php',
						success: function (data) {
							if (data == "1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_SIG();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}
	}

	function consulta_folder() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="1";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_SIG").html("");
				$("#descargas_SIG").html(data);
				$(".eliminar_archivo").click(eliminar_registro_SIG);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}

			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='subida_archivo' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='1' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$(".borde2").html(" ");
		$("#archivos_SIG").html(archivo);
		$("#include_SIG").show();

		var direc = "../"+ruta;
		var d = document.getElementById("SIG");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_SIG";

		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SIG").html("");
				$("#folder_SIG").html(data);
				$(".folder_SIG").click(consulta_folder);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_SIG");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/SIG/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_SIG").click(consulta_folder2);
	}
	function consulta_folder_MT() {	
		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_SIG.php',
			success: function (data) {

				$("#descargas_SIG").html("");
				$("#descargas_SIG").html(data);
				if (cargo != "MT-SIG") {
					$(".eliminar_MT_SIG").hide();
					$("#sesion_SIG").hide();
					$("#SIG").hide();

				}
			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("SIG");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_SIG";

		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SIG").html("");
				$("#folder_SIG").html(data);
				$(".folder_MT_SIG").click(consulta_folder_MT);
				$(".folder_MT_SIG").click(consulta_folder);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_SIG");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/SIG/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_SIG").click(consulta_folder2);
	}
	function consulta_folder2() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="1";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_SIG.php',
			success: function (data) {

				$("#descargas_SIG").html("");
				$("#descargas_SIG").html(data);
				$(".eliminar_archivo").click(eliminar_registro_SIG);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_SIG";
		var id_proceso_fk="1";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SIG").html("");
				$("#folder_SIG").html(data);
				$(".folder_MT_SIG").click(consulta_folder_MT);
				$(".folder_SIG").click(consulta_folder);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_SIG");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		// if (vieja == "undefined") {
		// 	c.removeAttribute("sub");
		// 	c.setAttribute("sub", "No");

		// }
		if (vieja == "files/SIG/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/SIG/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_SIG() {
		var id = $(this).attr("data-id");
		var ruta= $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_SIG();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "SIG") {
		var b = document.getElementById("menu1");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_SIG(){
		listar_Descargas_SIG();
		$("#panel").hide();

	}

	
}

//------------TERMINACIÖN CODIGO PARA SIG------------------------------------//


//------------COMIENZO CODIGO MENU 2 PARA TI------------------------------------//
function activar_menu_TI(cargo) {

	if (cargo == "TI") {
		$(".11").hide();
	}

	listar_Descargas_TI();

	function listar_Descargas_TI() {

		//carga de archivos de la base de datos:
		var ruta = "files/TI/";
		var id_proceso_fk="2";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_TI").html("");
				$("#descargas_TI").html(data);
				$(".eliminar_archivo").click(eliminar_registro_TI);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_TI";
		var id_proceso_fk="2";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TI").html("");
				$("#folder_TI").html(data);
				$(".folder_TI").click(consulta_folder_TI);
				$(".folder_MT_TI").click(consulta_folder_MT_TI);
				$(".folder_TI").click(function () {
					$("#panel_TI").show();
					$("#recargar_TI").click(recargar_TI);
				});
				$(".folder_MT_TI").click(function () {
					$("#panel_TI").show();
					$("#recargar_TI").click(recargar_TI);
				});
				
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("TI");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_TI").click(consulta_sub_folder_TI);

		function consulta_sub_folder_TI() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk="2";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_TI">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_TI [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk="2";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_TI();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}

		// $(".informacion").hide();
		// $(".ocultar").hide();
		// $(".mostrar").click(mostrar_informacion);
	}
	function consulta_folder_TI() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="2";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_TI").html("");
				$("#descargas_TI").html(data);
				$(".eliminar_archivo").click(eliminar_registro_TI);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide(); 
				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_TI' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='2' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_TI").html(" ");
		$("#archivos_TI").html(archivo);
		$("#include_TI").show();

		var direc = "../"+ruta;
		var d = document.getElementById("TI");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);
		var id_proceso_fk="2";

		var carpeta = "_TI";
		var id_proceso_fk="2";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TI").html("");
				$("#folder_TI").html(data);
				$(".folder_MT_TI").click(consulta_folder_MT_TI);
				$(".folder_TI").click(consulta_folder_TI);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_TI");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/TI/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_TI").click(consulta_folder2_TI);
	}
	function consulta_folder_MT_TI() {	
		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="2";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_TI.php',
			success: function (data) {

				$("#descargas_TI").html("");
				$("#descargas_TI").html(data);
				if (cargo != "MT-TI") {
					$(".eliminar_MT_TI").hide();
					$("#sesion_TI").hide();
					$("#TI").hide();
				}
			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("TI");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);
		var id_proceso_fk="2";
		var carpeta = "_TI";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TI").html("");
				$("#folder_TI").html(data);
				$(".folder_MT_TI").click(consulta_folder_MT_TI);
				$(".folder_TI").click(consulta_folder_TI);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_TI");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/TI/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_TI").click(consulta_folder2_TI);
	}
	function consulta_folder2_TI() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="2";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_TI").html("");
				$("#descargas_TI").html(data);
				$(".eliminar_TI").click(eliminar_registro_TI);
				if (cargo != "SIG") {
					$(".eliminar_TI").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_TI";
		var id_proceso_fk="2";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TI").html("");
				$("#folder_TI").html(data);
				$(".folder_MT_TI").click(consulta_folder_MT_TI);
				$(".folder_TI").click(consulta_folder_TI);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_TI");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/TI/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/TI/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_TI() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta,
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_TI();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "TI") {
		var b = document.getElementById("menu2");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_TI(){
		listar_Descargas_TI();
		$("#panel_TI").hide();

	}
}

//------------TERMINACIÖN CODIGO PARA TI------------------------------------//


//------------COMIENZO CODIGO MENU 3 PARA CONT------------------------------------//
function activar_menu_CT(cargo) {

	if (cargo == "CT") {
		$(".11").hide();
	}

	listar_Descargas_CT();
	function listar_Descargas_CT() {

		//carga de archivos de la base de datos y se muestra dependiendo el cargo:
		var ruta = "files/Conta/";
		var id_proceso_fk="3";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_CT").html("");
				$("#descargas_CT").html(data);
				$(".eliminar_archivo").click(eliminar_registro_CT);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_CT";
		var id_proceso_fk="3";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_CT").html("");
				$("#folder_CT").html(data);
				$(".folder_CT").click(consulta_folder_CT);
				$(".folder_MT_CT").click(consulta_folder_MT_CT);
				$(".folder_CT").click(function () {
					$("#panel_CT").show();
					$("#recargar_CT").click(recargar_CT);
				});
				$(".folder_MT_CT").click(function () {
					$("#panel_CT").show();
					$("#recargar_CT").click(recargar_CT);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("CT");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_CT").click(consulta_sub_folder_CT);

		function consulta_sub_folder_CT() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk="3";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_CT">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_CT [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk="3";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_CT();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}


	}
	function consulta_folder_CT() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="3";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_CT").html("");
				$("#descargas_CT").html(data);
				$(".eliminar_archivo").click(eliminar_registro_CT);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		
		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_CT' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='3' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_CT").html(" ");
		$("#archivos_CT").html(archivo);
		$("#include_CT").show();

		var direc = "../"+ruta;
		var d = document.getElementById("CT");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_CT";
		var id_proceso_fk="3";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_CT").html("");
				$("#folder_CT").html(data);
				$(".folder_MT_CT").click(consulta_folder_MT_CT);
				$(".folder_CT").click(consulta_folder_CT);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_CT");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Conta/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_CT").click(consulta_folder2_CT);
	}
	function consulta_folder_MT_CT() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="3";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_CT.php',
			success: function (data) {

				$("#descargas_CT").html("");
				$("#descargas_CT").html(data);
				if (cargo != "MT-CT") {
					$(".eliminar_MT_CT").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("CT");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_CT";
		var id_proceso_fk="3";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_CT").html("");
				$("#folder_CT").html(data);
				$(".folder_MT_CT").click(consulta_folder_MT_CT);
				$(".folder_CT").click(consulta_folder_CT);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_CT");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Conta/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_CT").click(consulta_folder2_CT);
	}
	function consulta_folder2_CT() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="3";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_CT").html("");
				$("#descargas_CT").html(data);
				$(".eliminar_archivo").click(eliminar_registro_CT);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_CT";
		var id_proceso_fk="3";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_CT").html("");
				$("#folder_CT").html(data);
				$(".folder_MT_CT").click(consulta_folder_MT_CT);
				$(".folder_CT").click(consulta_folder_CT);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_CT");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/Conta/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/Conta/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_CT() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_CT();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "CT") {
		var b = document.getElementById("menu3");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");	
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_CT(){
		listar_Descargas_CT();
		$("#panel_CT").hide();

	}

}

//------------TERMINACIÖN CODIGO PARA CONT------------------------------------//











//------------COMIENZO CODIGO PARA MENU 4 CONT------------------------------------//
function activar_menu_TEC(cargo) {

	if (cargo == "TEC") {
		$(".11").hide();
	}
	
	listar_Descargas_TEC();

	function listar_Descargas_TEC() {

		//carga de archivos de la base de datos:
		var ruta = "files/Tecnico/";
		var id_proceso_fk = "4";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_TEC").html("");
				$("#descargas_TEC").html(data);
				$(".eliminar_archivo").click(eliminar_registro_TEC);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_TEC"
		var id_proceso_fk = "4";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TEC").html("");
				$("#folder_TEC").html(data);
				$(".folder_TEC").click(consulta_folder_TEC);
				$(".folder_MT_TEC").click(consulta_folder_MT_TEC);
				$(".folder_TEC").click(function () {
					$("#panel_TEC").show();
					$("#recargar_TEC").click(recargar_TEC);
				});
				$(".folder_MT_TEC").click(function () {
					$("#panel_TEC").show();
					$("#recargar_TEC").click(recargar_TEC);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("TEC");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_TEC").click(consulta_sub_folder_TEC);

		function consulta_sub_folder_TEC() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "4";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_TEC">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_TEC [name=carpeta]").val();
					var ruta = "/"+direccion1;

					var folder = (`${result}`);
					var json = {
						'folder':folder,
						'direccion':ruta
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_TEC();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}



	}
	function consulta_folder_TEC() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "4";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_TEC").html("");
				$("#descargas_TEC").html(data);
				$(".eliminar_archivo").click(eliminar_registro_TEC);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_TEC' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='4' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_TEC").html(" ");
		$("#archivos_TEC").html(archivo);
		$("#include_TEC").show();

		var direc = "../"+ruta;
		var d = document.getElementById("TEC");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_TEC";
		var id_proceso_fk = "4";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TEC").html("");
				$("#folder_TEC").html(data);
				$(".folder_MT_TEC").click(consulta_folder_MT_TEC);
				$(".folder_TEC").click(consulta_folder_TEC);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_TEC");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Tecnico/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_TEC").click(consulta_folder2_TEC);
	}
	function consulta_folder_MT_TEC() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "4";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_TEC.php',
			success: function (data) {

				$("#descargas_TEC").html("");
				$("#descargas_TEC").html(data);
				if (cargo != "MT-TEC") {
					$(".eliminar_MT_TEC").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("TEC");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_TEC";
		var id_proceso_fk = "4";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TEC").html("");
				$("#folder_TEC").html(data);
				$(".folder_MT_TEC").click(consulta_folder_MT_TEC);
				$(".folder_TEC").click(consulta_folder_TEC);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_TEC");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/TEC/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_TEC").click(consulta_folder2_TEC);
	}
	function consulta_folder2_TEC() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "4";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_TEC").html("");
				$("#descargas_TEC").html(data);
				$(".eliminar_archivo").click(eliminar_registro_TEC);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_TEC";
		var id_proceso_fk = "4";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_TEC").html("");
				$("#folder_TEC").html(data);
				$(".folder_MT_TEC").click(consulta_folder_MT_TEC);
				$(".folder_TEC").click(consulta_folder_TEC);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_TEC");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/Tecnico/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/Tecnico") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_TEC() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_TEC();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "TEC") {
		var b = document.getElementById("menu4");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");

	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_TEC(){
		listar_Descargas_TEC();
		$("#panel_TEC").hide();

	}
}

//------------TERMINACIÖN CODIGO PARA CONT------------------------------------//


//------------COMIENZO CODIGO PARA MENU 5 GESTIÓN HUMANA------------------------------------//
function activar_menu_GH(cargo) {

	if (cargo == "GH") {
		$(".11").hide();
	}
	
	listar_Descargas_GH();

	function listar_Descargas_GH() {

		//carga de archivos de la base de datos:
		var ruta = "files/GH/";
		var id_proceso_fk = "5";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_GH").html("");
				$("#descargas_GH").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GH);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_GH"
		var id_proceso_fk = "5";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GH").html("");
				$("#folder_GH").html(data);
				$(".folder_GH").click(consulta_folder_GH);
				$(".folder_MT_GH").click(consulta_folder_MT_GH);
				$(".folder_GH").click(function () {
					$("#panel_GH").show();
					$("#recargar_GH").click(recargar_GH);
				});
				$(".folder_MT_GH").click(function () {
					$("#panel_GH").show();
					$("#recargar_GH").click(recargar_GH);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("GH");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_GH").click(consulta_sub_folder_GH);

		function consulta_sub_folder_GH() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "5";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_GH">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_GH [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "5";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_GH();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}

		// $(".informacion").hide();
		// $(".ocultar").hide();
		// $(".mostrar").click(mostrar_informacion);

	}
	function consulta_folder_GH() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "5";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_GH").html("");
				$("#descargas_GH").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GH);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_GH' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='5' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_GH").html(" ");
		$("#archivos_GH").html(archivo);
		$("#include_GH").show();

		var direc = "../"+ruta;
		var d = document.getElementById("GH");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_GH";
		var id_proceso_fk = "5";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GH").html("");
				$("#folder_GH").html(data);
				$(".folder_MT_GH").click(consulta_folder_MT_GH);
				$(".folder_GH").click(consulta_folder_GH);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_GH");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/GH/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_GH").click(consulta_folder2_GH);
	}
	function consulta_folder_MT_GH() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "5";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_GH.php',
			success: function (data) {

				$("#descargas_GH").html("");
				$("#descargas_GH").html(data);
				if (cargo != "MT-GH") {
					$(".eliminar_MT_GH").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("GH");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_GH";
		var id_proceso_fk = "5";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GH").html("");
				$("#folder_GH").html(data);
				$(".folder_MT_GH").click(consulta_folder_MT_GH);
				$(".folder_GH").click(consulta_folder_GH);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_GH");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/GH/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_GH").click(consulta_folder2_GH);
	}
	function consulta_folder2_GH() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "5";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_GH").html("");
				$("#descargas_GH").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GH);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_GH";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GH").html("");
				$("#folder_GH").html(data);
				$(".folder_MT_GH").click(consulta_folder_MT_GH);
				$(".folder_GH").click(consulta_folder_GH);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_GH");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/GH/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/GH") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_GH() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_GH();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "GH") {
		var b = document.getElementById("menu5");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_GH(){
		listar_Descargas_GH();
		$("#panel_GH").hide();

	}

}

//------------TERMINACIÖN CODIGO GESTIÓN HUMANA-----------------------------------//


//------------COMIENZO CODIGO PARA MENU 6 COMERCIAL------------------------------------//
function activar_menu_GD(cargo) {

	if (cargo == "GD") {
		$(".11").hide();
	}

	listar_Descargas_GD();

	function listar_Descargas_GD() {

		//carga de archivos de la base de datos:
		var ruta = "files/GD/";
		var id_proceso_fk="6";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_GD").html("");
				$("#descargas_GD").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GD);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_GD"
		var id_proceso_fk="6";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GD").html("");
				$("#folder_GD").html(data);
				$(".folder_GD").click(consulta_folder_GD);
				$(".folder_MT_GD").click(consulta_folder_MT_GD);
				$(".folder_GD").click(function () {
					$("#panel_GD").show();
					$("#recargar_GD").click(recargar_GD);
				});
				$(".folder_MT_GD").click(function () {
					$("#panel_GD").show();
					$("#recargar_GD").click(recargar_GD);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("GD");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_GD").click(consulta_sub_folder_GD);

		function consulta_sub_folder_GD() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk="6";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_GD">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_GD [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk="6";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_GD();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}

		// $(".informacion").hide();
		// $(".ocultar").hide();
		// $(".mostrar").click(mostrar_informacion);

	}
	function consulta_folder_GD() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk="6";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_GD").html("");
				$("#descargas_GD").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GD);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2_GD' id='archivo2_GD' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='6' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_GD").html(" ");
		$("#archivos_GD").html(archivo);
		$("#include_GD").show();

		var direc = "../"+ruta;
		var d = document.getElementById("GD");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_GD";
		var id_proceso_fk= "6";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GD").html("");
				$("#folder_GD").html(data);
				$(".folder_MT_GD").click(consulta_folder_MT_GD);
				$(".folder_GD").click(consulta_folder_GD);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_GD");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/GD/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_GD").click(consulta_folder2_GD);
	}
	function consulta_folder_MT_GD() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk= "6";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_GD.php',
			success: function (data) {

				$("#descargas_GD").html("");
				$("#descargas_GD").html(data);
				if (cargo != "MT-GD") {
					$(".eliminar_MT_GD").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("GD");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_GD";
		var id_proceso_fk= "6";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GD").html("");
				$("#folder_GD").html(data);
				$(".folder_MT_GD").click(consulta_folder_MT_GD);
				$(".folder_GD").click(consulta_folder_GD);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_GD");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/GD/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_GD").click(consulta_folder2_GD);
	}
	function consulta_folder2_GD() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk= "6";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_GD").html("");
				$("#descargas_GD").html(data);
				$(".eliminar_archivo").click(eliminar_registro_GD);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_GD";
		var id_proceso_fk= "6";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_GD").html("");
				$("#folder_GD").html(data);
				$(".folder_MT_GD").click(consulta_folder_MT_GD);
				$(".folder_GD").click(consulta_folder_GD);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_GD");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/GD/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/GD/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_GD() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_GD();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "GD") {
		var b = document.getElementById("menu6");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_GD(){
		listar_Descargas_GD();
		$("#panel_GD").hide();

	}

}


//------------TERMINACIÖN CODIGO  COMERCIAL-----------------------------------//


//------------COMIENZO CODIGO PARA MENU 7 Operaciones ------------------------------------//
function activar_menu_OP(cargo) {

	if (cargo == "OP") {
		$(".11").hide();
	}

	listar_Descargas_OP();

	function listar_Descargas_OP() {

		//carga de archivos de la base de datos:
		var ruta = "files/Operaciones/";
		var id_proceso_fk = "7";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_OP").html("");
				$("#descargas_OP").html(data);
				$(".eliminar_archivo").click(eliminar_registro_OP);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_OP"
		var id_proceso_fk = "7";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_OP").html("");
				$("#folder_OP").html(data);
				$(".folder_MT_OP").click(consulta_folder_MT_OP);
				$(".folder_OP").click(consulta_folder_OP);
				$(".folder_OP").click(function () {
					$("#panel_OP").show();
					$("#recargar_OP").click(recargar_OP);
				});
				$(".folder_MT_OP").click(function () {
					$("#panel_OP").show();
					$("#recargar_OP").click(recargar_OP);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("OP");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_OP").click(consulta_sub_folder_OP);

		function consulta_sub_folder_OP() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "7";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_OP">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_OP [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "7";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_OP();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}

/*		$(".informacion").hide();
		$(".ocultar").hide();
		$(".mostrar").click(mostrar_informacion);*/

	}
	function consulta_folder_OP() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "7";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_OP").html("");
				$("#descargas_OP").html(data);
				$(".eliminar_archivo").click(eliminar_registro_OP);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_OP' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='7' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_OP").html(" ");
		$("#archivos_OP").html(archivo);
		$("#include_OP").show();

		var direc = "../"+ruta;
		var d = document.getElementById("OP");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_OP";
		var id_proceso_fk = "7";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_OP").html("");
				$("#folder_OP").html(data);
				$(".folder_MT_OP").click(consulta_folder_MT_OP);
				$(".folder_OP").click(consulta_folder_OP);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_OP");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Operaciones/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_OP").click(consulta_folder2_OP);
	}
	function consulta_folder_MT_OP() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "7";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_OP.php',
			success: function (data) {
				$("#descargas_OP").html("");
				$("#descargas_OP").html(data);
				if (cargo != "MT-OP") {
					$(".eliminar_MT_OP").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("OP");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_OP";
		var id_proceso_fk = "7";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_OP").html("");
				$("#folder_OP").html(data);
				$(".folder_MT_OP").click(consulta_folder_MT_OP);
				$(".folder_OP").click(consulta_folder_OP);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_OP");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/Operaciones/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_OP").click(consulta_folder2_OP);
	}
	function consulta_folder2_OP() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "7";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_OP").html("");
				$("#descargas_OP").html(data);
				$(".eliminar_archivo").click(eliminar_registro_OP);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_OP";
		var id_proceso_fk = "7";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_OP").html("");
				$("#folder_OP").html(data);
				$(".folder_MT_OP").click(consulta_folder_MT_OP);
				$(".folder_OP").click(consulta_folder_OP);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_OP");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/Operaciones/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/Operaciones/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_OP() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_GD();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "OP") {
		var b = document.getElementById("menu7");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_OP(){
		listar_Descargas_OP();
		$("#panel_OP").hide();

	}

}

//------------TERMINACIÖN CODIGO  Operaciones -----------------------------------//


//------------COMIENZO CODIGO PARA MENU 8 PH ------------------------------------//
function activar_menu_PH(cargo) {
	
	if (cargo == "PH") {
		$(".11").hide();
	}

	listar_Descargas_PH();

	function listar_Descargas_PH() {

		//carga de archivos de la base de datos:
		var ruta = "files/PH/";
		var id_proceso_fk = "8";		
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_PH").html("");
				$("#descargas_PH").html(data);
				$(".eliminar_archivo").click(eliminar_registro_PH);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_PH"
		var id_proceso_fk = "8";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PH").html("");
				$("#folder_PH").html(data);
				$(".folder_MT_PH").click(consulta_folder_MT_PH);
				$(".folder_PH").click(consulta_folder_PH);
				$(".folder_PH").click(function () {
					$("#panel_PH").show();
					$("#recargar_PH").click(recargar_PH);
				});
				$(".folder_MT_PH").click(function () {
					$("#panel_PH").show();
					$("#recargar_PH").click(recargar_PH);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("PH");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_PH").click(consulta_sub_folder_PH);

		function consulta_sub_folder_PH() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "8";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_PH">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_PH [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "8";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_PH();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}



	}
	function consulta_folder_PH() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "8";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_PH").html("");
				$("#descargas_PH").html(data);
				$(".eliminar_archivo").click(eliminar_registro_PH);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});


	var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_PH' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='8' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_PH").html(" ");
		$("#archivos_PH").html(archivo);
		$("#include_PH").show();

		var direc = "../"+ruta;
		var d = document.getElementById("PH");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_PH";
		var id_proceso_fk = "8";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PH").html("");
				$("#folder_PH").html(data);
				$(".folder_MT_PH").click(consulta_folder_MT_PH);
				$(".folder_PH").click(consulta_folder_PH);
			}
		});
		var c = document.getElementById("volver_PH");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/PH/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}


		$("#volver_PH").click(consulta_folder2_PH);
	}
	function consulta_folder_MT_PH() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "8";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_PH.php',
			success: function (data) {
				$("#descargas_PH").html("");
				$("#descargas_PH").html(data);
				if (cargo != "MT-PH") {
					$(".eliminar_MT_PH").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("PH");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_PH";
		var id_proceso_fk = "8";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PH").html("");
				$("#folder_PH").html(data);
				$(".folder_MT_PH").click(consulta_folder_MT_PH);
				$(".folder_PH").click(consulta_folder_PH);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_PH");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/PH/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_PH").click(consulta_folder2_PH);
	}
	function consulta_folder2_PH() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "8";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_PH").html("");
				$("#descargas_PH").html(data);
				$(".eliminar_archivo").click(eliminar_registro_PH);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_PH";
		var id_proceso_fk = "8";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_PH").html("");
				$("#folder_PH").html(data);
				$(".folder_MT_PH").click(consulta_folder_MT_PH);
				$(".folder_PH").click(consulta_folder_PH);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_PH");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/PH/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/PH/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_PH() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_PH();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "PH") {
		var b = document.getElementById("menu8");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_PH(){
		listar_Descargas_PH();
		$("#panel_PH").hide();

	}

}

//------------TERMINACIÖN CODIGO  PH -----------------------------------//





//------------COMIENZO CODIGO PARA MENU 10 SST------------------------------------//
function activar_menu_SST(cargo) {

	if (cargo == "SST") {
		$(".11").hide();
	}

	listar_Descargas_SST();

	function listar_Descargas_SST() {

		//carga de archivos de la base de datos:
		var ruta = "files/SST/";
		var id_proceso_fk = "9";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_SST").html("");
				$("#descargas_SST").html(data);
				$(".eliminar_archivo").click(eliminar_registro_SST);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide(); 	
				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_SST";
		var id_proceso_fk = "9";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SST").html("");
				$("#folder_SST").html(data);
				$(".folder_SST").click(consulta_folder_SST);
				$(".folder_SST").click(function () {
					$("#panel_SST").show();
					$("#recargar_SST").click(recargar_SST);

				})
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("SST");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_SST").click(consulta_sub_folder_SST);

		function consulta_sub_folder_SST() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "9";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_SST">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_SST [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "9";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_SST();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}

		// $(".informacion").hide();
		// $(".ocultar").hide();
		// $(".mostrar").click(mostrar_informacion);

	}
	function consulta_folder_SST() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "9";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_SST").html("");
				$("#descargas_SST").html(data);
				$(".eliminar_archivo").click(eliminar_registro_SST);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide(); 	
				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_SST' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='9' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_SST").html(" ");
		$("#archivos_SST").html(archivo);
		$("#include_SST").show();

		var direc = "../"+ruta;
		var d = document.getElementById("SST");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_SST";
		var id_proceso_fk = "9";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SST").html("");
				$("#folder_SST").html(data);
				$(".folder_SST").click(consulta_folder_SST);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_SST");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/SST/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_SST").click(consulta_folder2_SST);
	}
	function consulta_folder2_SST() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "9";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_SST").html("");
				$("#descargas_SST").html(data);
				$(".eliminar_archivo").click(eliminar_registro_SST);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide(); 	
				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_SSST";
		var id_proceso_fk = "9";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_SST").html("");
				$("#folder_SST").html(data);
				$(".folder_SST").click(consulta_folder_SST);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_SST");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/SST/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/SST/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_SST() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_SST();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "SST") {
		var b = document.getElementById("menu9");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_SST(){
		listar_Descargas_SST();
		$("#panel_SST").hide();

	}
}

//------------TERMINACIÖN CODIGO  SST -----------------------------------//

function listar_cargos() {
	
	$.ajax({
		type:"POST",
		url:'php/listar_cargos.php',
		success: function (data) {
			$("#cargo_fk").html("");
			$("#cargo_fk").html(data);
		}
	});
}
function insert_user(event) {
	event.preventDefault();
	var nom = $("#registro_user [name=nom]").val();
	var ape = $("#registro_user [name=ape]").val();
	var email = $("#registro_user [name=email]").val();
	var pass = $("#registro_user [name=pass]").val();
	var cargo = $("#registro_user [name=cargo_fk]").val();

	var json = {
		"nom": nom,
		"ape": ape,
		"email": email,
		"pass": pass,
		"cargo": cargo
	}
	$.ajax({
		type:"POST",
		data: json,
		url:'php/insertar_user.php',
		success: function (data) {
			if (data = "1") {
				swal({
					title:'Registrado!',
					text: "Usuario Registrado Correctamente.",
					type:"success"
				}).then(function(success) {
					window.location.reload();
				});
			}else{
				swal(
					"OH! No se pudo registrar el usuario!",
					"error"
					);
			}
		}
	});
}


function Desactivar_listado(cargo) {
	$(".En_linea").hide();
	$(".Matriz").show();
	
	//listar matrices :
	listar_MT_SIG(cargo);
	listar_MT_TI(cargo);  
	listar_MT_GH(cargo);
	listar_MT_TEC(cargo);
	listar_MT_OP(cargo);
	listar_MT_GD(cargo);
	listar_MT_CT(cargo);
	listar_MT_GR(cargo);
	listar_MT_PH(cargo);
	listar_MT_JR(cargo);


	// terminacion del listado de matrices.
}
function listar_MT_SIG(cargo) {

	listar_Descargas_MT_SIG(cargo);

	function listar_Descargas_MT_SIG(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/SIG/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_SIG.php',
			success: function (data) {
				$("#descargas_MT_SIG").html("");
				$("#descargas_MT_SIG").html(data);
				$(".eliminar_MT_SIG").click(eliminar_registro_MT_SIG);
				if (cargo != "MT-SIG") {
					$(".eliminar_MT_SIG").hide();
					$("#Matriz_SIG").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_SIG() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_SIG.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_SIG();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-SIG") {
		var b = document.getElementById("menu13");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_TI(cargo) {

	listar_Descargas_MT_TI(cargo);

	function listar_Descargas_MT_TI(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/TI/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_TI.php',
			success: function (data) {
				$("#descargas_MT_TI").html("");
				$("#descargas_MT_TI").html(data);
				$(".eliminar_MT_TI").click(eliminar_registro_MT_TI);
				if (cargo != "MT-TI") {
					$(".eliminar_MT_TI").hide();
					$("#Matriz_TI").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_TI() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_TI.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_TI();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-TI") {
		var b = document.getElementById("menu14");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_GH(cargo) {

	listar_Descargas_MT_GH(cargo);

	function listar_Descargas_MT_GH(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/GH/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_GH.php',
			success: function (data) {
				$("#descargas_MT_GH").html("");
				$("#descargas_MT_GH").html(data);
				$(".eliminar_MT_GH").click(eliminar_registro_MT_GH);
				if (cargo != "MT-GH") {
					$(".eliminar_MT_GH").hide();
					$("#Matriz_GH").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_GH() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_GH.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_GH();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-GH") {
		var b = document.getElementById("menu15");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
/*MATRIZ JURIDICO*/
function listar_MT_JR(cargo) {

	listar_Descargas_MT_JR(cargo);

	function listar_Descargas_MT_JR(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/JR/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_JR.php',
			success: function (data) {
				$("#descargas_MT_JR").html("");
				$("#descargas_MT_JR").html(data);
				$(".eliminar_MT_JR").click(eliminar_registro_MT_JR);
				if (cargo != "MT-JR") {
					$(".eliminar_MT_JR").hide();
					$("#Matriz_JR").hide();
				}
			}
		});
		
	}
	
	function eliminar_registro_MT_JR() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_JR.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_JR();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-JR") {
		var b = document.getElementById("menu31");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}







function listar_MT_TEC(cargo){

	listar_Descargas_MT_TEC(cargo);

	function listar_Descargas_MT_TEC(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/Tecnico/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_TEC.php',
			success: function (data) {
				$("#descargas_MT_TEC").html("");
				$("#descargas_MT_TEC").html(data);
				$(".eliminar_MT_TEC").click(eliminar_registro_MT_TEC);
				if (cargo != "MT-TEC") {
					$(".eliminar_MT_TEC").hide();
					$("#Matriz_TEC").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_TEC() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_TEC.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_TEC();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-TEC") {
		var b = document.getElementById("menu16");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_OP(cargo){
	listar_Descargas_MT_OP(cargo);

	function listar_Descargas_MT_OP(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/Operaciones/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_OP.php',
			success: function (data) {
				$("#descargas_MT_OP").html("");
				$("#descargas_MT_OP").html(data);
				$(".eliminar_MT_OP").click(eliminar_registro_MT_OP);
				if (cargo != "MT-OP") {
					$(".eliminar_MT_OP").hide();
					$("#Matriz_OP").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_OP() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_OP.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_OP();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-OP") {
		var b = document.getElementById("menu21");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_GD(cargo){
	listar_Descargas_MT_GD(cargo);

	function listar_Descargas_MT_GD(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/Comercial/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_GD.php',
			success: function (data) {
				$("#descargas_MT_GD").html("");
				$("#descargas_MT_GD").html(data);
				$(".eliminar_MT_GD").click(eliminar_registro_MT_GD);
				if (cargo != "MT-GD") {
					$(".eliminar_MT_GD").hide();
					$("#Matriz_GD").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_GD() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_GD.php',
				success: function(data) {
					if (data=="1") {
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}else{
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							

						});
						
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-GD") {
		var b = document.getElementById("menu20");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_CT(cargo){
	listar_Descargas_MT_CT(cargo);

	function listar_Descargas_MT_CT(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/Conta/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_CT.php',
			success: function (data) {
				$("#descargas_MT_CT").html("");
				$("#descargas_MT_CT").html(data);
				$(".eliminar_MT_CT").click(eliminar_registro_MT_CT);
				if (cargo != "MT-CT") {
					$(".eliminar_MT_CT").hide();
					$("#Matriz_CT").hide();
				}
			}
		});
/*		$(".ocultar").hide();
		$(".mostrar").hide();*/
	}
	
	function eliminar_registro_MT_CT() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_CT.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_CT();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-CT") {
		var b = document.getElementById("menu17");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_GR(cargo){
	listar_Descargas_MT_GR(cargo);

	function listar_Descargas_MT_GR(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/Gerencia/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_GR.php',
			success: function (data) {
				$("#descargas_MT_GR").html("");
				$("#descargas_MT_GR").html(data);
				$(".eliminar_MT_GR").click(eliminar_registro_MT_GR);
				if (cargo != "MT-GR") {
					$(".eliminar_MT_GR").hide();
					$("#Matriz_GR").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_GR() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_GR.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_GR();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-GR") {
		var b = document.getElementById("menu19");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}
function listar_MT_PH(cargo){
	listar_Descargas_MT_PH(cargo);

	function listar_Descargas_MT_PH(cargo) {

		//carga de archivos de la base de datos:
		var ruta = "files/PH/Matrices/";
		var json = {
			'ruta':ruta
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/listar_Descargas_MT_PH.php',
			success: function (data) {
				$("#descargas_MT_PH").html("");
				$("#descargas_MT_PH").html(data);
				$(".eliminar_MT_PH").click(eliminar_registro_MT_PH);
				if (cargo != "MT-PH") {
					$(".eliminar_MT_PH").hide();
					$("#Matriz_PH").hide();
				}
			}
		});
		// $(".ocultar").hide();
		// $(".mostrar").hide();
	}
	
	function eliminar_registro_MT_PH() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");

		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_MT_PH.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_MT_PH();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "MT-PH") {
		var b = document.getElementById("menu18");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane  in active");
	}
}

//------------COMIENZO CODIGO PARA MENU JR JURIDICA ------------------------------------//
function activar_menu_JR(cargo) {
	
	if (cargo == "JR") {
		$(".11").hide();
	}

	listar_Descargas_JR();

	function listar_Descargas_JR() {

		//carga de archivos de la base de datos:
		var ruta = "files/JR/";
		var id_proceso_fk = "11";
		var json = {
			'ruta':ruta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			data:json,
			type:'POST',
			url:'php/lista_descarga_sadoc.php',
			success: function (data) {
				$("#descargas_JR").html("");
				$("#descargas_JR").html(data);
				$(".eliminar_archivo").click(eliminar_registro_JR);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		//carga de carpetas en el servidor:
		var consulta = "../"+ruta;
		var carpeta = "_JR";
		var id_proceso_fk = "11";
		var json={
			'consulta': consulta,
			'ruta': ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_JR").html("");
				$("#folder_JR").html(data);
				$(".folder_MT_JR").click(consulta_folder_MT_JR);
				$(".folder_JR").click(consulta_folder_JR);
				$(".folder_JR").click(function () {
					$("#panel_JR").show();
					$("#recargar_JR").click(recargar_JR);
				});
				$(".folder_MT_JR").click(function () {
					$("#panel_JR").show();
					$("#recargar_JR").click(recargar_JR);
				});
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var d = document.getElementById("JR");
		d.setAttribute("data-consulta", consulta);
		d.setAttribute("data-ruta", ruta);

		$(".new_folder_JR").click(consulta_sub_folder_JR);

		function consulta_sub_folder_JR() {

			var ruta = $(this).attr("data-ruta");
			var direc = $(this).attr("data-consulta");
			var id_proceso_fk = "11";
			var json = {
				'consulta':direc,
				'ruta':ruta,
				'id_proceso_fk':id_proceso_fk
			}
			swal({
				title: '<span class="title">Creación de la Carpeta</span>',
				input: 'text',
				showCancelButton: true,
			}).then(function(result) {

				var select = "";
				select += '<form action="#" class="select_folder_JR">';
				select += '<div class="form-group">';
				select += '<label for="select">Elije donde quieres crear la carpeta :</label>';
				select += '<select class="form-control" id="select" name="carpeta">';

				$.ajax({
					type:"POST",
					data:json,
					url:'php/selectSwal.php',
					success: function (data) {
						$("#select").html("");
						$("#select").html(data);
					}
				});
				select += '</select>';
				select += '</div>';
				select += '</form>';


				swal({
					title: "Destino",
					html: select,
					showCancelButton: true
				}).then(function () {

					var direccion1 = $(".select_folder_JR [name=carpeta]").val();
					var ruta = "/"+direccion1;
					var folder = (`${result}`);
					var id_proceso_fk = "11";
					var json = {
						'folder':folder,
						'direccion':ruta,
						'id_proceso_fk':id_proceso_fk
					}
					$.ajax({
						type:'POST',
						data:json,
						url:'php/new_folder.php',
						success: function (data) {
							if (data=="1") {
								swal({
									text: "Tu carpeta ha sido creada!",
									type: "success"
								}).then((success) => {
									listar_Descargas_JR();
									ocultar_informacion();
								});
							}else{
								if (data == "2") {
									swal({
										text: "OH! Tu carpeta Ya existe!", 
										type: "error"
									});
								}else{
									swal({
										text: "OH! Tu carpeta NO ha sido creada!", 
										type: "error"
									});
								}
							}
						}
					});	
				}).catch(swal.noop);

			}).catch(swal.noop);
		}



	}
	function consulta_folder_JR() {

		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "11";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_JR").html("");
				$("#descargas_JR").html(data);
				$(".eliminar_archivo").click(eliminar_registro_JR);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});

		var archivo = "";
		archivo+="<center>";
		archivo+="<div id='' class='pt-3 pb-2'>";
		archivo += "<form class='form-inline col-md-9 col-lg-8 col-sm-12 col-xs-12' id='form2' action='#' name='upload' method='POST' enctype='multipart/form-data'>";
		archivo += "<br/>";
		archivo+="<h3>Adjuntar Archivos : </h3>";
		archivo+="<div class='form-group mx-sm-3 mb-2'>";
		archivo += "<input type='file' name='archivo2' id='archivo2_JR' class='form-control' required>";
		archivo +="<input type='hidden' value='"+ruta+"' name='ruta'>"
		archivo +="<input type='hidden' value='11' name='id_proceso_fk'>"
		archivo+="</div>";
		archivo+="<button type='submit' class='btn btn-success mb-2' name='subir2'>";
		archivo+="<span class=' fa fa-upload' aria-hidden='true'></span>";
		archivo+="Subir Archivo";
		archivo+="</button>";
		archivo += "</form>";
		archivo+="</div>";
		archivo+="</center>";


		$("#subida_archivo_JR").html(" ");
		$("#archivos_JR").html(archivo);
		$("#include_JR").show();

		var direc = "../"+ruta;
		var d = document.getElementById("JR");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_JR";
		var id_proceso_fk = "11";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_JR").html("");
				$("#folder_JR").html(data);
				$(".folder_MT_JR").click(consulta_folder_MT_JR);
				$(".folder_JR").click(consulta_folder_JR);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		var c = document.getElementById("volver_JR");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/JR/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_JR").click(consulta_folder2_JR);
	}
	function consulta_folder_MT_JR() {

		var sub = "No";
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "11";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_MT_JR.php',
			success: function (data) {
				$("#descargas_JR").html("");
				$("#descargas_JR").html(data);
				if (cargo != "MT-JR") {
					$(".eliminar_MT_JR").hide();

				}

			}
		});

		var direc = "../"+ruta;
		var d = document.getElementById("JR");
		d.removeAttribute("data-consulta");
		d.removeAttribute("data-ruta");
		d.setAttribute("data-consulta", direc);
		d.setAttribute("data-ruta", ruta);

		var carpeta = "_JR";
		var id_proceso_fk = "11";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_JR").html("");
				$("#folder_JR").html(data);
				$(".folder_MT_JR").click(consulta_folder_MT_JR);
				$(".folder_JR").click(consulta_folder_JR);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});

		var c = document.getElementById("volver_JR");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);
		if (vieja == "files/JR/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}

		$("#volver_JR").click(consulta_folder2_JR);
	}
	function consulta_folder2_JR() {


		var sub = $(this).attr('sub');
		var ruta = $(this).attr('ruta');
		var ruta_principal = $(this).attr('data-ruta');
		var vieja = $(this).attr("url-vieja");
		var id_proceso_fk = "11";
		var json = {
			'ruta':ruta,
			'sub':sub,
			'ruta_principal':ruta_principal,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:'POST',
			data:json,
			url:'php/lista_descarga_folder_sadoc.php',
			success: function (data) {

				$("#descargas_JR").html("");
				$("#descargas_JR").html(data);
				$(".eliminar_archivo").click(eliminar_registro_JR);
				if (cargo != "SIG") {
					$(".eliminar_archivo").hide();

				}
			}
		});
		var direc = "../"+ruta;
		var carpeta = "_JR";
		var id_proceso_fk = "11";
		var json={
			'consulta':direc,
			'ruta':ruta,
			'carpeta':carpeta,
			'id_proceso_fk':id_proceso_fk
		}
		$.ajax({
			type:"POST",
			data:json,
			url:'php/cargar_folders.php',
			success: function (data) {
				$("#folder_JR").html("");
				$("#folder_JR").html(data);
				$(".folder_MT_JR").click(consulta_folder_MT_JR);
				$(".folder_JR").click(consulta_folder_JR);
				$(".eliminarCarpeta").click(eliminarCarpeta);
				if (cargo != "SIG") {
					$(".eliminarCarpeta").hide();

				}
			}
		});
		//boton para regresar :
		var c = document.getElementById("volver_JR");
		c.setAttribute("url-new", ruta_principal);
		c.removeAttribute("url-old");
		c.removeAttribute("data-ruta");
		c.removeAttribute("ruta");
		c.removeAttribute("sub");
		c.setAttribute("data-ruta", vieja);
		c.setAttribute("ruta", vieja);
		c.setAttribute("sub", sub);
		c.setAttribute("url-vieja", vieja);

		if (vieja == "files/JR/") {
			c.removeAttribute("sub");
			c.setAttribute("sub", "No");
		}else{
			if (vieja != "files/JR/") {
				c.removeAttribute("sub");
				c.setAttribute("sub", "Si");
			}
		}
	}
	function eliminar_registro_JR() {
		var id = $(this).attr("data-id");
		var ruta = $(this).attr("data-ruta");
		var json = {
			'id':id,
			'ruta':ruta
		}
		
		swal({
			title: "Estas Seguro?",
			text: "¡Una vez que se elimine, ¡no podrá recuperar este archivo!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Si, deseo hacerlo!',
			cancelButtonText: 'No, cancelar!',
			confirmButtonClass: 'confirm-class',
			cancelButtonClass: 'cancel-class',
		}).then(function() {

			$.ajax({
				type:'POST',
				data:json,
				url:'php/eliminar_registro_sadoc.php',
				success: function(data) {
					if (data=="1") {
						swal({
							title:'Borrado!',
							text: "Poof! Tu archivo ha sido eliminado!",
							type:"success"
						}).then(function(success) {
							listar_Descargas_JR();
							ocultar_informacion();
						});
					}else{
						swal(
							"OH! Tu archivo NO ha sido eliminado!",
							"error"
							);
					}	
				}
			}); 

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Cancelado',
					text: "Has cancelado la eliminación!",
					type: "error"
				});
			}

		}).catch(swal.noop);
	}
	if (cargo == "JR") {
		var b = document.getElementById("menuJR");
		b.removeAttribute("class");
		b.setAttribute("class", "tab-pane in active");
	}
	if (cargo != "SIG") {
		$("#sesion_SIG").hide();
		$("#sesion_TI").hide();
		$("#sesion_CT").hide();
		$("#sesion_TEC").hide();
		$("#sesion_GH").hide();
		$("#sesion_GD").hide();
		$("#sesion_OP").hide();
		$("#sesion_PH").hide();
		$("#sesion_JR").hide();
		$("#sesion_GR").hide();
		$("#sesion_SST").hide();
		$("#sesion_PLE").hide();
		$("#SIG").hide();
		$("#TI").hide();
		$("#CT").hide();
		$("#TEC").hide();
		$("#GH").hide();
		$("#GD").hide();
		$("#OP").hide();
		$("#PH").hide();
		$("#GR").hide();
		$("#SST").hide();
		$("#PLE").hide();
	}
	function recargar_JR(){
		listar_Descargas_JR();
		$("#panel_JR").hide();

	}

}

//------------TERMINACIÖN CODIGO  JURIDICA -----------------------------------//



function eliminarCarpeta(){
	var id = $(this).attr("data-id");
	var json = {
		'id':id
	}

	swal({
		title: "Estas Seguro?",
		text: "¡Una vez que se elimine, ¡no podrá recuperar esta Carpeta ni sus archivos!",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: 'Si, deseo hacerlo!',
		cancelButtonText: 'No, cancelar!',
		confirmButtonClass: 'confirm-class',
		cancelButtonClass: 'cancel-class',
	}).then(function() {

		$.ajax({
			type:'POST',
			data:json,
			url:'php/eliminar_carpeta.php',
			success: function(data) {
				if (data=="1") {
					swal(
						"OH! Tu archivo NO ha sido eliminado!",
						"error"
						);
					
				}else{
					swal({
						title:'Borrado!',
						text: "Tu archivo ha sido eliminado!",
						type:"success"
					}).then(function(success) {

						location.reload();
					});
					
				}	
			}
		}); 

	}, function (dismiss) {
		if (dismiss === 'cancel') {
			swal({
				title: 'Cancelado',
				text: "Has cancelado la eliminación!",
				type: "error"
			});
		}

	}).catch(swal.noop);
}