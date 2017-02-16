<?php

$description_val = $_REQUEST['q'];

ini_set('display_errors',1); 
error_reporting(E_ALL);

require 'dbinfo.inc.php';



// Establish database connection w/PDO.  
try
    {
    $conn = new PDO($dsn, $username,$password);
    }
catch (PDOException $e)
    {
    $error_message=$e->getMessage();
    echo "<h1>Resource Unavailable. Please Contact the System Administrator</h1>";
    }
	
	$stmt = $conn->prepare("UPDATE hw_items SET Description = '$description_val';");
?>