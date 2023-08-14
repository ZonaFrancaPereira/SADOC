<?php 
	include_once("conexion.php");

	if (isset($_POST["subir"]) && empty($_POST["archivo"])   ) {
		foreach ($_FILES["archivo"] as $archivo => $valor) {
		
		}
		$archivo = $_FILES["archivo"]["tmp_name"];
		chmod($archivo, 0777);
		$proceso=$_POST["proceso"];
		$destino_principal = "files/".$proceso."/";
		$destino = $destino_principal.$_FILES["archivo"]["name"];
		$estado = "activo";
		$id_proceso_fk=$_POST["id_proceso_fk"];
	
		
		
		$sub_Carpeta = "No";

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
 			?>
 				<div class="alert alert-warning">
					<strong>Error en el Servidor,Intentelo más tarde...</strong>
				</div>
			<?php
			}
		} catch(PDOException $e){
			echo "Se ha producido un error al intentar conectar al servidor MySQL: ".$e->getMessage();
		}
	}
 ?>