<?php
  $arr = array(array());
  $add_name = "Manager";
  echo "Select managers";
  echo "<br>";
  $wid = $_GET['wid'];
  list_members();  
  echo "<br><br>";
  echo "Select Developers";
  echo "<br>";
  list_members();

  function list_members() {
    global $i, $arr, $add_name, $role_id, $set, $wid;
    
    //Establishing Database connection
    require 'database_connection.php';

     //Retrieving role_id for the desired role.
    $sql = "SELECT role_id from roles WHERE role_name = '" . $add_name . "'";
    $result = $conn->query($sql);
    if ($row = $result->fetch_assoc()) {
       $role_id = $row['role_id'];
    }

    // Retrieving list of all users who are neither managers nor developers.
    if (!empty($result)) {
     $sql = "SELECT s.user_id, s.user_name FROM signup s LEFT OUTER JOIN members m ON m.user_id = s.user_id AND m.role_id =" . $role_id . " and m.workspace_id =" . $wid . " WHERE m.role_id is null"; 
   $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $i = 0;
     while($row = $result->fetch_assoc()) {
      $uname = $row["user_name"];
      $key = $row["user_id"];
      for ($j = 0; $j < 2; $j++) { 
        if ($j == 0)
        $arr[$i][$j] = $uname;
        else 
        $arr[$i][$j] = $key;
      }

      $i++;
    }  
  }
    for ($j = 0; $j < $i; $j++) {
      for ($k = 0; $k < 2; $k++) { 
        if($k == 0)
        echo $arr[$j][$k];
        else {
        echo "<input type='checkbox' name='". $add_name . "[]' value= " . $arr[$j][$k] . ">";
        } 
       } 
    }
    $add_name = "Developer";
    echo "<br>";
  }
 }  
?>