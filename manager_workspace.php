<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body></body>
</html>

<?php
  session_start();
  require 'logoutdisplay.php';
  require 'database_connection.php';
  $wid_arr = array();

  if ($_SESSION['role'] == "Manager") {
    // echo "mohit";
    echo "<table class='table'> <tr><th>Workspace Name</th><th>Description</th><th>List of Task</th><th>Create Task</tr>";
    
  ///Query for Displaying list of workspaces for manager.
  	$sql = "SELECT distinct w.workspace_id, w.project_name,  w.description  FROM workspace AS w JOIN members AS m  ON w.workspace_id = m.workspace_id JOIN roles as r  ON m.role_id = r.role_id AND r.role_name = 'Manager' AND m.user_id = ". $_SESSION["uid"];

   	$result = $conn->query($sql);
    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
    		$wid = $row['workspace_id'];
      	echo "<tr><td>" .  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=list_of_tasks.php?wid=" . $wid . ">List of Task </td></a><td><a class='list'  href=task_create.php?wid=" . $wid . ">Create Task</a></td></tr>" ;
       }
       echo "<br>";
     }

      //Query for displaying list of developers who are also managers.
      $sql =  "SELECT m.workspace_id  FROM members AS m JOIN roles AS r ON m.role_id = r.role_id WHERE m.user_id =". $_SESSION['uid'] . " AND r.role_name ='developer' ";
      $result = $conn->query($sql);
      //print_r($result);
      $i = 0;
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
         $wid_arr[$i] = $row['workspace_id'];
         $i++;  
       }
      } 
      $j = 0;
        while ($j < $i) {
        $sql = "SELECT workspace_id, project_name,  description FROM workspace WHERE workspace_id = " . $wid_arr[$j];
          $result = $conn->query($sql);
         // print_r($result);
          $row = $result->fetch_assoc();
          echo "<tr><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=list_of_tasks.php?dev=1&wid=" . $wid_arr[$j] . ">List of Task </td></a></tr>" ;
            $j++;
          }   
      echo "</table>"; 
    }

    else {
      //Query for displaying list of developers who are only developers in a particular workspace.        
      echo "<table class='table'> <tr><th>Workspace Name</th><th>Description</th><th>List of Task</th></tr>";
      $sql =  "SELECT m.workspace_id  FROM members AS m JOIN roles AS r ON m.role_id = r.role_id WHERE m.user_id =". $_SESSION['uid'] . " AND r.role_name ='developer' ";
      $result = $conn->query($sql);
      $i = 0;
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
         $wid_arr[$i] = $row['workspace_id'];
         $i++;  
       }
      } 
      $j = 0;
        while ($j < $i) {
        $sql = "SELECT workspace_id, project_name, description FROM workspace WHERE workspace_id = " . $wid_arr[$j];
          $result = $conn->query($sql);
         // print_r($result);
          $row = $result->fetch_assoc();
          echo "<tr><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=list_of_tasks.php?dev=1&wid=" . $wid_arr[$j] . ">List of Task </td></a></tr>" ;
            $j++;
          }   
      echo "</table>"; 
    } 
?>      
