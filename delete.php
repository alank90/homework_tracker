<?php
require 'dbinfo.inc.php';

try
 {
    $conn = new PDO($dsn, $username,$password);
	
       // get the 'id' variable from the URL and store it in $id_val
    $id_val = $_REQUEST['id'];
	
	//Note here we use positional placeholder in prepare statement
    $stmt = $conn->prepare("DELETE FROM hw_items WHERE id = ?");
    $stmt -> execute([$id_val]);	
    echo 'Deleted Record Sucessfully';
    echo "<br /n><a href= 'index.php' style='color:black'>Return To HomeWork List</a>";
 }
catch (PDOException $e)
 {
    echo $e->getMessage() . "<h3>An error occurred.</h3>";
 }

	
