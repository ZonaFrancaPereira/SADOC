<?php 
	$conn = new PDO(
      'mysql:host=localhost;
      dbname=upload',
      'root',
      '');
	try {
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("set names utf8");

	} catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

 ?>