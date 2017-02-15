<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

require 'dbinfo.inc.php';

try
    {
    $conn = new PDO($dsn, $username,$password);
    }
catch (PDOException $e)
    {
    $error_message=$e->getMessage();
    echo "<h1>An error occurred: $error_message</h1>";
 }

// get the 'id' variable from the URL and store it in $id_val
$id_val = $_REQUEST['id'];
$stmt = "DELETE FROM Inventory WHERE id = '$id_val'";
$result = $conn->query($stmt);	
?>
<h2><center><b>Deleted Record Sucessfully</b></center></h2>
	
