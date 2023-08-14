<?php 
	function obtener_estructura_directorios($ruta, $direc){
    // Se comprueba que realmente sea la ruta de un directorio
        if (is_dir($ruta)){
            // Abre un gestor de directorios para la ruta indicada
            $gestor = opendir($ruta);
            // Recorre todos los elementos del directorio
            echo "<option value='".$direc."'>Carpeta Principal/</option>";
            while (($archivo = readdir($gestor)) !== false)  {
                    
                $ruta_completa = $ruta . $archivo;

                // Se muestran todos los archivos y carpetas excepto "." y ".."
                if ($archivo != "." && $archivo != "..") {
                    // Si es un directorio se recorre recursivamente
                    if (is_dir($ruta_completa)) {
                    	$direccion = $direc.$archivo."/";
                        echo "<option value='".$direccion."'>". $archivo ."/</option>";
                        
                        //obtener_estructura_directorios($ruta_completa);
                    }
                }
            }
            // Cierra el gestor de directorios
            closedir($gestor);
        } else {
            echo "No es una ruta de directorio valida<br/>";
        }
    }
    $consulta = $_POST['consulta'];
    $direc = $_POST['ruta'];
    obtener_estructura_directorios($consulta,$direc);
 ?>