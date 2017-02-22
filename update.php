<?php
require 'dbinfo.inc.php';

$description_val = $_POST['desc_value'];
$id_val = $_POST['id'];
// Establish database connection w/PDO.  
try
    {
       $conn = new PDO($dsn, $username,$password);
	
    	 /* Prepare SQL statement & bind values. This prevents sql injections and automatically escapes 
	         special characters like apostrophe's.*/
       $stmt = $conn->prepare("UPDATE hw_items SET Description = :description_val WHERE id=" . $id_val);
       $stmt -> bindValue(':description_val', $description_val, PDO::PARAM_STR);
       $stmt -> execute();
	   
	   echo ("Update Succesful!");
    }
catch (PDOException $e)
    {
       echo $e -> getMessage() . "<h1>Resource Unavailable. Please Contact the System Administrator</h1>";
    }
?>