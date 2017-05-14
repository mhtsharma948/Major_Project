<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.scss">
</head>
<body>

</body>
</html>
<?php
  session_start();
  //If Admin is login..
  if ($_SESSION["uid"] == 1) {
    $wid = $mng = $dev = "";
    $wid =  $_GET["wid"]; 
    $mng = $_GET["mg"];
    $dev = $_GET["dev"];
    $manager = $_POST["Manager"];
    $developer = $_POST["Developer"];
    $rem_manager = $_POST["RemMng"];
    $rem_dev = $_POST["RemDev"];
    $man_size = count($manager);
    $dev_size = count($developer);
    $removemng = count($rem_manager);
    $remove_dev = count($rem_dev);
    require 'database_connection.php';
   
    // Removal of managers which are no longer needed.
    if (isset($_POST['rm'])) {
    // if ($mng == 2) {
      for ($i = 0; $i < $removemng; $i++) {
        $sql = "DELETE FROM members WHERE user_id = " . $rem_manager[$i] . " AND role_id = 2";
        $result = $conn->query($sql);
      }
       header('Location: workspace_task.php?wid=' . $wid);
    } 

    // Removal of developers which are no longer needed.
    // elseif ($dev == 3) {
      if (isset($_POST['rd'])) {
        for ($i = 0; $i < $remove_dev; $i++) {
          $sql = "DELETE FROM members WHERE user_id = " . $rem_dev[$i] . " AND role_id = 3";
          $result = $conn->query($sql);
      }
       header('Location: workspace_task.php?wid=' . $wid);
    }
      if (isset($_POST['add'])) {
      //Inserting new managers 
      $sql = "SELECT role_id FROM roles WHERE role_name = 'Manager'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $role = $row['role_id'];
        
      //echo $man_size;
      for ($i = 0; $i < $man_size; $i++) {
        //echo $manager[$i];
        $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$manager[$i]', '$role')";
        if ($conn->query($sql) === TRUE) {
           // echo "manager added";
        }
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      
      //Inserting new developers
      $sql = "SELECT role_id FROM roles WHERE role_name = 'Developer'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $role =  $row['role_id'];

      for ($i = 0; $i < $dev_size; $i++) {
        echo $developer[$i];
        $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$developer[$i]', '$role')";
          if ($conn->query($sql) === TRUE) {
            //echo "developer added";
          }
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
       header('Location: workspace_task.php?wid=' . $wid);
      } 
    }   
?>
