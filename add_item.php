<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
require 'dbinfo.inc.php';

// Put values from the form submit(POST) into php variables

$title = $_POST['title'];
$due_date = $_POST['due_date'];
$description = $_POST['description'];
//Format date for SQL query
$due_date = date('Y-m-d', strtotime($due_date));

// Establish database connection w/PDO.  
try
    {
        $conn = new PDO($dsn, $username,$password);
	
	    $stmt = $conn->prepare("INSERT INTO hw_items SET Title = :Title, Date = :Date,Description = :Description");
	       /*if at least one variable is going to be used, you have to
	        substitute it with a placeholder, then prepare your query,
	        and then execute it, passing variables separately. This helps 
		    mitigate sql injection problem. First of all, you have to alter 
		    your query, adding placeholders in place of variables. Here we use
		    named placeholders. */
        $stmt->execute([
            ':Title' => $title,
            ':Date' => $due_date,
            ':Description' => $description]);
			
       echo '<br /n>';
       echo '<h3>Added Record Successfully</h3>';
 }
catch (PDOException $e)
    {
       echo $e -> getMessage() . "<h1>Resource Unavailable. Please Contact the System Administrator</h1>";
    }
	
echo "<br><a href= 'index.php' style='color:black'>Return To HomeWork List</a>";
