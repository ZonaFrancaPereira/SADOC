<?php 
	require("conexion.php");

	$id = $_POST['id'];
	$ruta = $_POST['ruta'];
	

	try {
		$stmt = $conn->prepare('DELETE FROM sadoc WHERE id = ? and ruta=?');
		$stmt->bindParam(1, $id);
		$stmt->bindParam(2, $ruta);


		if ($stmt->execute()) {
			echo "1";
			unlink('../'.$ruta);
		}else{
			echo "2";
		}

	} catch (PDOException $e) {
		echo "Error en el servidor";
	}

 ?>