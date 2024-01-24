<<<<<<< HEAD
<?php 
	$conn = new PDO(
      'mysql:host=srv1148.hstgr.io;
      dbname=u446101023_prueba',
      'u446101023_prueba',
      'Az2314zf*');
	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
=======
<?php
$host = 'srv1148.hstgr.io'; // Puede ser localhost o proporcionado por Hostinguer
$dbname = 'u446101023_prueba';
$username = 'u446101023_prueba';
$password = 'Az2314zf*';
>>>>>>> 53280ba8f0e752519ff203a0a5c87196e82244ce

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

