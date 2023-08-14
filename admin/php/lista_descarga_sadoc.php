<?php
	
	require('conexion.php');
	$registros = 1;
	$ruta = $_POST['ruta'];
	$id_proceso_fk = $_POST['id_proceso_fk'];
	try {
		$stmt = $conn->prepare('SELECT * FROM sadoc WHERE estado = "activo" and sub_Carpeta = "No"  and ruta_principal = ? and id_proceso_fk="'.$id_proceso_fk.'" ');
		$stmt->bindParam(1,$ruta);
		$stmt -> execute();

		if($stmt->rowCount()>0){

			while ($row=$stmt->fetch()) {
				$nombre = basename($row["ruta"]);
				$previo = $row["ruta"];
				
				
				echo "<tr>";
					echo "<td scope='row'>".$registros."</td>";
					echo "<td class='lado'>".$nombre."</td>";
					echo "<td>".$row["Fecha_Subida"]."</td>";
					echo "<td>";
						echo '<form action="php/descarga_Archivos.php?archivo='.$nombre.'"" method="post" name="formulario" class="col-xs-12 col-sm-12 col-md-12">';
							echo' <input type="hidden" name="ruta" value="'.$row['ruta'].'">';
							echo "<button type='submit' class='btn btn-success btn-block' title='Descargar'>
									<span class='fa fa-download' aria-hidden='true'></span>
									
								</button>";
						echo '</form>';
						echo "</td>";
					
						echo "<td>";	
						echo '<form class="col-xs-12 col-sm-12 col-md-12">';
							echo "<button data-id='".$row['id']."' data-ruta='".$row['ruta']."' type='button' class='eliminar_archivo btn btn-danger btn-block' title='Eliminar'>
									<span class='fa fa-trash' aria-hidden='true'></span>
									
								</button>";
						echo '</form>';
					echo "</td>";
				echo "</tr>";
				$registros++;
			}
			
		}	else{
		echo "<tr>";

		echo "<td colspan='5'>";
		echo "<input type='text' value='Aun no existen archivos en esta carpeta' class='form-control' disabled>";
		echo "</td>";
		echo "<tr>";
	}

	} catch (PDOExeption $e) {
		echo "Error en el servidor";
	}

 ?>