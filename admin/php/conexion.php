<?php 
	$conn = new PDO(
      'mysql:host=srv1148.hstgr.io;
      dbname=u446101023_prueba',
      'u446101023_prueba',
      'Az2314zf*');
	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

	} catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

 ?>