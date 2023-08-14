<?php 
function obtener_estructura_directorios($ruta, $direc, $carpeta){
  $registros = 1;
    // Se comprueba que realmente sea la ruta de un directorio
  if (is_dir($ruta)){
            // Abre un gestor de directorios para la ruta indicada
    $gestor = opendir($ruta);
            // Recorre todos los elementos del directorio
    while (($archivo = readdir($gestor)) !== false)  {

        $ruta_completa = $ruta . $archivo;

                // Se muestran todos los archivos y carpetas excepto "." y ".."
        if ($archivo != "." && $archivo != "..") {
                    // Si es un directorio se recorre recursivamente
            if (is_dir($ruta_completa)) {
               $direccion = $direc.$archivo."/";
               $completa = "../".$direccion;
               echo "<tr>";
               echo "<td scope='row' class='col-md-1'>" . $registros . "</td>";
               echo "<td class='lado' name='".$direccion."'>". $archivo ."/</td>";
               echo "<td ><center>";
                               echo "<div class='row'>
                <button id='".$archivo."' type='button' sub='Si' data-ruta='".$direccion."' class='col-sm-6 col-md-6 col-lg-6 btn btn-info  folder".$carpeta."' ruta='".$direccion."' url-vieja='".$direc."'>
                <i class='fas fa-folder-open'></i>
                Ver
                </button>";
                echo '<form class="col-sm-6 col-md-6 col-lg-6 ">';
                echo "<button data-id='".$direccion."' type='button' class='eliminarCarpeta btn btn-danger btn-block' title='Eliminar'>
                <span class='fa fa-trash' aria-hidden='true'></span>

                </button>";
                echo '</form></div>';

            

            echo "</center></td>";
            echo "</tr>";
            $registros++;
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
$carpeta = $_POST['carpeta'];
obtener_estructura_directorios($consulta,$direc,$carpeta);
?>