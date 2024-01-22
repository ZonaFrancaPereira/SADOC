<?php
$host = 'srv1148.hstgr.io'; // Puede ser localhost o proporcionado por Hostinguer
$dbname = 'u446101023_prueba';
$username = 'u446101023_prueba';
$password = 'Az2314zf*';

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

