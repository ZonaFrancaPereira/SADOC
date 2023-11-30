<style>
.boton {
border: 1px solid #2e518b; /*anchura, estilo y color borde*/
padding: 10px; /*espacio alrededor texto*/
background-color: #2e518b; /*color botón*/
color: #ffffff; /*color texto*/
text-decoration: none; /*decoración texto*/
text-transform: uppercase; /*capitalización texto*/
font-family: 'Helvetica', sans-serif; /*tipografía texto*/
border-radius: 50px; /*bordes redondos*/
}    
    
</style>

<?php
//Si la variable archivo que pasamos por URL no esta 
//establecida acabamos la ejecucion del script.
if (!isset($_GET['archivo']) || empty($_GET['archivo'])) {
   exit();
}

//Utilizamos basename por seguridad, devuelve el 
//nombre del archivo eliminando cualquier ruta. 
$archivo = basename($_GET['archivo']);
$direc = $_GET['ruta'];

$ruta = '../'.$direc;
//PATCHINFO : sirve para extraer la extension del archivo y asi crear la condicion para visualizarlo
$ext = pathinfo($direc, PATHINFO_EXTENSION);
//echo $ext;

if($ext=="pdf"){
//leer archivos PDF     
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=".$archivo);
header("Content-Length: " . filesize($ruta));

readfile($ruta);
   

}else{
//Leer archivos Excel,Word, Powerpoint
echo '<center>
<a href="descarga_final.php?archivo='.$archivo.'&ruta='.$direc.'"  ><button class="boton">Descargar</button></a></center><hr>
<iframe src="http://docs.google.com/gview?url=https://localhost/SADOC/'.$direc.'&embedded=true" style="width:100%; height:100%;" frameborder="0"></iframe>';
   
}


?>