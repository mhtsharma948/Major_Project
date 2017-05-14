<?php
  $wid =  $_GET["wid"]; 
  $arr = array(array());
  $add_name = "RemMng";
  $role_name = "Manager";
  $role_id = "";
  echo "Select managers"; 
  echo "<br>";
  list_members();

  function list_members() {
    global $i, $arr, $add_name, $wid, $role_id, $role_name;
    require 'database_connection.php';
    $sql = "SELECT distinct m.role_id FROM members AS m  JOIN roles AS r ON m.role_id = r.role_id WHERE r.role_name = '" . $role_name . "'" . "AND m.workspace_id = " . $wid ;
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc())  {
       $role_id = $row['role_id'];
    }
  }
      
  if ($result->num_rows > 0) {
    $sql = "SELECT m.user_id, s.user_name FROM members AS m RIGHT JOIN signup AS s ON m.user_id = s.user_id WHERE m.user_id IS NOT NULL AND m.role_id = " . $role_id . " AND m.workspace_id = " . $wid ;

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
    }
  }
?>