<html>

<head>
    <meta charset="UTF-8">
    <!-- =================  CSS Files  ================-->
    <link rel="stylesheet" href="css/main.css">
    <title>Homework Tracker</title>
</head>

<body>
<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
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
$hw_list = $query->fetchAll(PDO::FETCH_ASSOC); 

//print_r($hw_list);
 ?>
	 
    <h1>My Homework Assignments</h1>
    <div id="new_homework" title="Enter Homework Item">
        <form method="POST" action="add_item.php">
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
                <input type="submit" value="Add Assignment" name="new_submit" /> </div>
        </form>
    </div>
    <!--=================  Main HTML Markup Here  ====================-->
    <main>
        <h2>Homework Assignment List</h2>
        <div id="list">
            <?php foreach($hw_list as $hw)  { 
            	 echo '<ul id = "list">';
            	    echo  '<h4>Assignment:</h4><li>' .  $hw['Title'] . '</li>';
                    echo "<h4>Due On:</h4><li>" . $hw['Date'] . "<a title='Click Here to Delete'  href='delete.php?id=" . $hw['id'] . "'><button class='btn' id='delete'>X</button></a></li>";
				    echo  '<h4>Details:</h4><li class ="description" contenteditable="true">' . $hw['Description'] . '</li>';
					echo  "<button>Update</button>";
                  echo '</ul>';
			      }
			 ?>
                
        </div>
    </main>
    
    <!-- ================ Javascript below this Line   =============  -->
    <script>
		// AJAX used to post updated Description info field
		 var el = document.getElementById("list");
		 var str= "";
		 var test = document.getElementById("update");
		
		 //Get updated Desription field value when <enter> ket hit.
		 el.addEventListener("keypress", function(e)  {
		 	 if (e.keyCode == 13)  {
		 	    str = e.target.innerHTML;
	 	 	 }
		  });
		  
		function updateField(str) {
	  	      console.log("test");
		/*	if (str == "") {
				return;
			}
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("update").innerHTML = this.responseText;
				}
			}
			xmlhttp.open("POST", "update.php?q=" + str, true);
			xmlhttp.send();
		*/
		}
		 var x = document.getElementById("list");
		 x.getElementsByTagName("li");
	   //x.addEventListener("click", updateField(str));
    
	</script>
 
</body>

</html>
