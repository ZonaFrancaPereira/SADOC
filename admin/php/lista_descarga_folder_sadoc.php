<?php
	
	require('conexion.php');
	$registros = 1;
	$sub = $_POST['sub'];
	$ruta = $_POST['ruta'];
	$ruta_principal = $_POST['ruta_principal'];
	$id_proceso_fk = $_POST['id_proceso_fk'];
	try {
		$stmt = $conn->prepare('SELECT * FROM sadoc WHERE estado = "activo" and sub_Carpeta = ? and ruta like "%"?"%" and ruta_principal = ? and id_proceso_fk="'.$id_proceso_fk.'" ');
		$stmt->bindParam(1, $sub);
		$stmt->bindParam(2, $ruta);
		$stmt->bindParam(3, $ruta_principal);
		$stmt-> execute();

		if($stmt->rowCount()>0){

			while ($row=$stmt->fetch()) {
				$nombre = basename($row["ruta"]);
				$previo=$row["ruta"];
				$id=$row["id"];
				
				echo "<tr class='sobras'>";
					echo "<td scope='row'>".$registros."</td>";
					echo "<td class='lado'>".$nombre."</td>";
					echo "<td>".$row["Fecha_Subida"]."</td>";
					echo "<td>";
						echo '<a href="php/descarga_Archivos.php?archivo='.$nombre.'&ruta='.$previo.'" target="_blank" ><button class="btn bg-navy"><span class="fa fa-eye" aria-hidden="true"></span></button></a>';
						
						echo "</td>";
					
						echo "<td>";
						echo '<form class="">';
							echo "<button data-id='".$row['id']."' data-ruta='".$row['ruta']."' type='button' class='eliminar_archivo btn btn-danger btn-block' title='Eliminar'>
									<span class='fa fa-trash' aria-hidden='true'></span>
									
								</button>";
						echo '</form>';
					echo "</td>";
				echo "<tr>";
				$registros++;
			}
			
		}else{
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