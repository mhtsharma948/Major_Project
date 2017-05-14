<?php
  session_start();
  // Retrieving values from form.
  $tname = $descr = $developer = $time = "";
  $nameErr = $timeErr = $descErr = $devErr = "";
  require 'logoutdisplay.php';
  $wid = $_GET['wid'];
  if ($_SESSION['role'] == "Manager") { 
  	if(isset($_POST['submit'])) {  
	    if (empty($_POST["tname"])) {
     		$nameErr = "task name is required";
    	}
    	else {
    		$tname = test_input($_POST["tname"]);
    	}
    	if (empty($_POST["time"])) {
     		$timeErr = "time is required";
    	}
    	else {
    		$time = test_input($_POST["time"]);
    	}

			if (empty($_POST["description"])) {
     		$descErr = "description is required";
    	}
    	else {
    		$descr = test_input($_POST["description"]);
    	}    	

    	if (empty($_POST['Developer'])) {
    		$devErr = "Select any developer for the task";
    	}
    	
    	else {
	    	$developer = $_POST["Developer"];
	  	}

      //Checking if there is no error , all validations correct  
      if (empty($nameErr) && empty($descErr) && empty($devErr) && empty($timeErr)) {
        require 'database_connection.php';

      // Inserting data into table called task_create
      $sql = "INSERT INTO task_create (task_name, estimate_time, description,workspace_id) VALUES('$tname', '$time', '$descr','$wid')";

      if ($conn->query($sql) === TRUE) {
       $tid = $conn->insert_id;
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      // Inserting data into developer table.
      $sql = "INSERT INTO developer (task_id, user_id) VALUES ('$tid', '$developer')";
      if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $sql = "SELECT workspace_id FROM members WHERE workspace_id =" . $wid . " AND user_id = " . $developer . " AND role_id = 3";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        header('Location: main_page.php');  
        }   
      else { 
        //Inserting data into members table which will help user to show all the details which is assigned to him.    
        $sql = "INSERT INTO members (workspace_id, user_id , role_id) VALUES ('$wid', '$developer' , '3')";
        if ($conn->query($sql) === TRUE) {
          //echo "New record created successfully";
        } 
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
         header('Location: main_page.php');
      }
     
      }
  }
} 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }       
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
	<script>
	function getuser() {
		 xmlhttp = new XMLHttpRequest();
		 xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
     	document.getElementById("txtHint").innerHTML = this.responseText;
      }
     };
     xmlhttp.open("POST","get_dev.php?wid=<?php echo $wid;?>",true);
     xmlhttp.send();
	}	
	</script>
</head>
<!-- Page for Creation of a task -->
<body>
	<div class='create_task'> 
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?wid=<?php echo $wid;?>" method="post">
			<p class="labels">Task Name</p> <input type="text" name="tname" value="<?php echo $tname; ?>"><span class="error"><?php echo $nameErr;?></span><br>
			<p class="labels">Estimated Time:</p> <input type="text" name="time" value="<?php echo $time; ?>"><span class="error"><?php echo $timeErr;?></span><br>
			<p class="labels">Description: </p><br><textarea rows="10" cols="50" name="description"></textarea><span class="error"><?php echo $descErr;?></span><br><br><br>
			<input type="button" onclick="getuser()" value ="Add developers"><br><br>
			<div id ="txtHint" class="white"><span class="error"><?php echo $devErr;?></span><br></textarea><br></div>
			<br><br>
			<input type="submit" name="submit" value="save">
		</form>	
	</div>	
</body>
</html>