<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body>
</body>
</html>
<?php
  require 'logoutdisplay.php';
  session_start();
  
  // Displaying list of workspaces for Admin
  if ($_SESSION['role'] == "Admin" || $_SESSION['uid'] == 1) {
   require 'database_connection.php';
   echo "<table class='table'> <tr><th>Workspace Name</th><th>Description</th><th>Edit Workspace</th><th>List of Tasks</tr>";

   //Query for displaying list of workspaces. 
   $sql = "SELECT distinct  workspace_id, project_name, description FROM workspace";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $wid = $row['workspace_id'];	
        echo "<tr></td><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=workspace_task.php?wid=" . $wid . ">EDIT</td><td>  <a class ='list' href='list_of_tasks.php?wid=" . $wid . "'>List of Tasks</a></td> </tr>";
        echo "<br>"; 
       }
     }
   	echo "</table>";  
    } 
?>      
