<?php
	
	require('conexion.php');
	try {
		$stmt = $conn->prepare('SELECT * FROM cargos');
		$stmt -> execute();

		if($stmt->rowCount()>0){

			while ($row=$stmt->fetch()) {
				echo "<option value='".$row['siglas']."'>". $row['Nombre_Cargo'] ."</option>";
			}
			
		}else{
			echo "<input type='text' value='No hay Resultados...' class='form-control' disabled>";
		}

	} catch (PDOExeption $e) {
		echo "Error en el servidor";
	}

 ?>