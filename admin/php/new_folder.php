<?php
	$nombre_folder = $_POST['folder'];
	$direccion = $_POST['direccion'];
	$enlace = '..'.$direccion.$nombre_folder;

	if (!file_exists($enlace)) { 
	    mkdir($enlace, 0777, true);
	    echo "1";
	    chmod($enlace, 0777);
	}else{
		echo "2";
	}
 ?>