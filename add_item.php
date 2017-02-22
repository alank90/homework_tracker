<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

require 'dbinfo.inc.php';

// Put values from the form submit(POST) into php variables

$title = $_POST['title'];
$due_date = $_POST['due_date'];
$description = $_POST['description'];

$due_date = date("Y-m-d");
// Establish database connection w/PDO.  
try
    {
        $conn = new PDO($dsn, $username,$password);
	
	    $stmt = $conn->prepare("INSERT INTO hw_items SET Title = :Title, Date = :Date,Description = :Description");
	       // PDOStatement::execute — Executes a prepared statement                      
        $stmt->execute(array(
            ':Title' => $title,
            ':Date' => $due_date,
            ':Description' => $description));
			
       echo '<br /n>';
       echo '<h3>Added Record Successfully</h3>';
 }
catch (PDOException $e)
    {
       echo $e -> getMessage() . "<h1>Resource Unavailable. Please Contact the System Administrator</h1>";
    }
	
echo "<br><a href= 'index.php' style='color:black'>Return To HomeWork List</a>";
           
?>