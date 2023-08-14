<?php 
	include_once("conexion.php");
	
	$ruta = $_POST['ruta'];
	$sub_Carpeta = "Si";

	if (isset($_POST["subir2"]) && empty($_POST["archivo2"])  ) {
		foreach ($_FILES["archivo2"] as $archivo => $valor) {
		
		}
		$archivo = $_FILES["archivo2"]["tmp_name"];
		chmod($archivo, 0777);
		$destino = $ruta.$_FILES["archivo2"]["name"];
		$destino_principal =$ruta;
		$estado = "activo";
		$id_proceso_fk=$_POST["id_proceso_fk"];
		


		move_uploaded_file($archivo, $destino);
		//insertamos los datos a la DB:
		try {
		$stmt = $conn->prepare('INSERT INTO sadoc(ruta, ruta_principal, estado, sub_Carpeta,id_proceso_fk) VALUES(?, ?, ?, ?,?)');
			$stmt->bindParam(1, $destino);
			$stmt->bindParam(2, $destino_principal);
			$stmt->bindParam(3, $estado);
			$stmt->bindParam(4, $sub_Carpeta);
			$stmt->bindParam(5, $id_proceso_fk);

			if ($stmt->execute()){
				echo '<meta http-equiv="refresh" content="1">';
			}else{
 				echo "Error en el la consulta...";
			}
		} catch(PDOException $e){
			echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
		}
	}
 ?>