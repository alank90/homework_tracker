<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

require 'dbinfo.inc.php';

$description_val = $_POST['desc_value'];
$id_val = $_POST['id'];
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
	$sql = "UPDATE hw_items SET Description = '$description_val' WHERE id='$id_val'";
	
	 // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();
echo ("Update Succesful");
?>