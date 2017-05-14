<?php
  $arr = array(array());
  $wid = $_GET['wid'];
  require 'database_connection.php';
  $add_name = "Developer";
  $sql = "SELECT user_id, user_name FROM signup";
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

  echo "Select Developers";
  echo "<br><br>";
  list_members();
  
  function list_members() {
    global $i, $arr, $add_name;
    for ($j = 0; $j < $i; $j++) {
      for ($k = 0; $k < 2; $k++) { 
        if($k == 0)
        echo $arr[$j][$k];
        else 
        echo "<input type='radio' name='". $add_name . "' value= " . $arr[$j][$k] . ">"; //. $add_name . $arr[$j][$k] . "<br>";
       } 
    }
  }
?>