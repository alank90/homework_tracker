<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset=utf-8>
 
    <!-- =================  CSS Files  ================-->
    <link rel="stylesheet" href="css/main.css">
    <title>Homework Tracker</title>
</head>

<body>
<?php
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
require ("dbinfo.inc.php"); //include login info file

	try {
		$conn = new PDO($dsn, $username, $password);

		/*Retrieve Homework table info via SQL & PDO:: commands. 
		No variables are going to be used in the query, so we can 
		use the PDO::query() method. */
		$sql = "SELECT * FROM hw_items ORDER BY Date ASC";
		$stmt = $conn -> query($sql);
		$hw_list = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		 echo $e -> getMessage() . "<h1>Resource Unavailable. Please contact the System Administrator</h1>";
	}
//End of Connection

 ?>
	 
    <h1>My Homework Assignments<img src="img/homework.png"></h1>
       
    <!--======== New Assignment Modal  =========== -->
   	<a href="#openModal">Create New Assignment</a>
		<div id="openModal" class="modalDialog">
			<div>
			<a href="#close" title="Close" class="close">X</a>
				<h2>Add Assignment</h2>
				<form method="POST" action="add_item.php">
					<p>
						Title:
						<br />
						<input type="text" class="title" name="title" placeholder="Homework Assignment" required/>
					</p>
					<p>
						Date Due:
						<br />
						<input type="date" class="datepicker" name="due_date" placeholder="MM/DD/YYYY" />
					</p>
					<p>
						Description:
						<br />
						<textarea class="description" name="description"></textarea>
					</p>
					<div class="actions">
						<input type="submit" value="Add Assignment" name="new_submit" />
					</div>
				</form>
			</div>
		</div>
    <!--============= End New Assignment Modal  ========= -->
    
    
    <!--=================  Main HTML Markup Here  ====================-->
    <main>
        <h2>Assignment's Due.</h2>
           <h3>(Click Details to edit)</h3>
        <div id="post_message"></div>  <!-- Placeholder for AJAX status request message -->
        <div id = "list">
            <?php foreach($hw_list as $hw)  {
            	    echo '<ul>';
            	      echo  '<h4>Assignment:</h4><li>' .  $hw['Title'] . '</li>';
                      echo "<h4>Due On:</h4><li>" . date('D F j', strtotime($hw['Date'])) . "<a title='Click Here to Delete'  href='delete.php?id=" . $hw['id'] . "'><button class='btn' id='delete'><img class = 'delete_btn' src='img/delete.png' alt='Delete Button'></button></a></li>";
				      echo  "<h4>Details:</h4><li class ='description' contenteditable='true' data-id=" . $hw['id'] . ">" . $hw['Description'] . "</li>";
				    echo '</ul>';
			      }
			 ?>
                
        </div>
    </main>
    
    <!-- ========== Javascript Files below here  ==========================-->
    
    <script src="js/main.js"></script>
  
  </body>
</html>
