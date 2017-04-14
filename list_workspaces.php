<?php
  require 'noSession.php';
  require 'logoutdisplay.php';
  session_start();

  function getWorkspaces() {
  // Displaying list of workspaces for Admin
  if ($_SESSION['role'] == "Admin" || $_SESSION['uid'] == 1) {
   require 'database_connection.php';
   ?>
   <table class='table'><tr><th>Workspace Name</th><th>Description</th><th>Edit Workspace</th><th>List of Tasks</th></tr>

   <?php
   //Query for displaying list of workspaces. 
   $sql = "SELECT distinct  workspace_id, project_name, description FROM workspace";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $wid = $row['workspace_id'];	
        echo "<tr><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=/action/workspaceTask/" . $wid . ">EDIT</td><td><a class ='list' href='/action/listTasks/" . $wid . "'>List of Tasks</a></td> </tr>";
       }
     }
   	echo "</table>";  
    }
   }  
?>      
