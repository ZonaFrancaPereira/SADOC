<<<<<<< HEAD
<?php
$host = 'localhost'; // Puede ser localhost o proporcionado por Hostinguer
$dbname = 'upload';
$username = 'root';
$password = '';
=======
<?php 
	$conn = new PDO(
      'mysql:host=localhost;
      dbname=upload',
      'root',
      '');
	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");
>>>>>>> be5e1c9beb83f70fdf62da8caf57c26b58afb055

	} catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

 ?>