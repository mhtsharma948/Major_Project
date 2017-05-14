<?php
require 'logoutdisplay.php';
?>
<?php
  session_start();
  $wid = $pname = $date = $descr = $manager = $developer = "";
  $nameErr = $descErr = $mngErr = "";
  if ($_SESSION['role'] == "Admin" || $_SESSION['uid'] == 1) {  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['submit'])) {
      if (empty($_POST["pname"])) {
        $nameErr = "user name is required";
      }
      else {
        $pname = test_input($_POST["pname"]);
      }

      if (empty($_POST["description"])) {
        $descErr = "description is required";
      }
      else {
        $descr = test_input($_POST["description"]);
      }

      $manager = $_POST["Manager"];
      $developer = $_POST["Developer"];
      $wid = "";
      $man_size = count($manager);
      $dev_size = count($developer);

      if ($man_size == 0 || $dev_size == 0) {
      	$mngErr = "Select Managers and Developers for the workspace";
      }

      if (empty($nameErr) && empty($descErr) && empty($mngErr)) {
        require 'database_connection.php';

       //Inserting workspace info into workspace table.
        $sql = "INSERT INTO workspace (project_name, description) VALUES('$pname' ,'$descr')";

        if ($conn->query($sql) === TRUE) {
          $wid = $conn->insert_id;
        } 
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        //Inserting names of those who are managers for that workspace.
        $sql = "SELECT role_id FROM roles WHERE role_name = 'Manager'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $role = $row['role_id'];
        
        echo $man_size;
        for ($i = 0; $i < $man_size; $i++) {
          echo $manager[$i];
          $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$manager[$i]', '$role')";
          if ($conn->query($sql) === TRUE) {
            echo "manager added";
        }
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
        //Inserting names of those who are managers for that workspace.
        $sql = "SELECT role_id FROM roles WHERE role_name = 'Developer'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $role =  $row['role_id'];
         
        for ($i = 0; $i < $dev_size; $i++) {
          //echo $developer[$i];
          $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$developer[$i]', '$role')";
          if ($conn->query($sql) === TRUE) {
            echo "developer added";
          }
          else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          }
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
<!-- Page for creating a workspace by the admin -->
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
    xmlhttp.open("POST","get_mng&dev.php",true);
    xmlhttp.send();
	}	
	</script>
</head>
<body>
	<div class='admin'>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
			Project Name <input type="text" name="pname" value="<?php echo $pname; ?>"><span class="error"><?php echo $nameErr;?></span><br>
			Description: <br><br><textarea rows="5" cols="50" name="description" value="<?php echo $descr; ?>"></textarea><span class="error"><?php echo $descErr;?></span><br><br><br>
			<input type="button" onclick="getuser()" value ="Add managers and developers"><br><br>
			<div id ="txtHint" class="white"><span class="error"><?php echo $mngErr;?></span><br></div>
			<br><br>
			<input type="submit" name="submit" value="save">
		</form>
	</div>		
</body>
</html>
