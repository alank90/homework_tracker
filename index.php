<html>

<head>
    <meta charset="UTF-8">
    <!-- =================  CSS Files  ================-->
    <link rel="stylesheet" href="css/main.css">
    <title>Homework Tracker</title>
</head>

<body>
	<?php

require ("dbinfo.inc.php"); //include login info file

try
    {
      $conn = new PDO($dsn, $username, $password);
    }
catch (PDOException $e)
    {
    $error_message=$e->getMessage();
    echo "<h1>Resource Unavailable. Please contact the System Administrator</h1>";
    }
//End of Connection


// Retrieve Homework table info via SQL
$sql = "SELECT * FROM hw_items";
$query = $conn->prepare($sql);
$query->execute();
$hw_list = array();

//  fetch() method fetches the next row from a result set. Here the variable $query stores the 
// result set of the sql Select query.
while($hw_item = $query->fetch())
{
    $hw_list[] = $hw_item;
}
print_r($hw_list);
 ?>
	 
    <h1>My Homework Assignments</h1>
    <div id="new_homework" title="Enter Homework Item">
        <form method="POST" action="new_hw.php">
            <p> Title:
                <br />
                <input type="text" class="title" name="title" placeholder="Homework Assignment" /> </p>
            <p> Date Due:
                <br />
                <input type="text" class="datepicker" name="due_date" placeholder="MM/DD/YYYY" /> </p>
            <p> Description:
                <br />
                <textarea class="description" name="description"></textarea>
            </p>
            <div class="actions">
                <input type="submit" value="Create Homework Assignment" name="new_submit" /> </div>
        </form>
    </div>
    <!--=================  Main HTML Markup Here  ====================-->
    <main>
        <h2>Homework Assignment List</h2>
        <div id="hw_list">
            <?php foreach($hw_list as $hw)  { ?>
                <h3> <?php echo $hw -> Title; ?></h3>
                  <p>Due <?php echo $hw->Date;?></p>
                  <p>Description:<br /><textarea  class="description" name="description"><?php echo $hw->Description; } ?></textarea>
                  </p>
                
        </div>
    </main>
</body>

</html>
