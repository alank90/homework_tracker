<?php
require 'dbinfo.inc.php';

try
 {
    $conn = new PDO($dsn, $username,$password);
	
       // get the 'id' variable from the URL and store it in $id_val
    $id_val = $_REQUEST['id'];
    $stmt = "DELETE FROM hw_items WHERE id = '$id_val' ";
    $result = $conn -> query($stmt);	
    echo 'Deleted Record Sucessfully';
    echo "<br /n><a href= 'index.php' style='color:black'>Return To HomeWork List</a>";
 }
catch (PDOException $e)
 {
    echo $e->getMessage() . "<h1>An error occurred.</h1>";
 }

	
