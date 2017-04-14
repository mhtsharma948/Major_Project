<?php
   $name = $email = $passwd =  "";
   $emailErr = $pwdErr = "";
   $found = 0;
    //This function checks the user's login details and matches with the DB.
   function loginCheck() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['submit'])) {
        global $name, $emailErr, $passwd, $pwdErr, $found, $verify_id;
        if (empty($_POST["email"]))  {
          $emailErr = "email is required";
        }
        else {
          $name = test_input($_POST["email"]);
          // check if e-mail address syntax is valid or not
          if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$name)) {
            $emailErr = "Invalid email";
            return false;
          }
        }

        if (empty($_POST['pwd'])) {
          $pwdErr = "password is required";
        }
        else {
          $passwd = test_input($_POST["pwd"]);
          $pass_md = md5($passwd);
      } 
      if (empty($emailErr) && empty($pwdErr)) {  
         require 'database_connection.php';   
         $sql = "SELECT user_id,user_name, email_id, password FROM signup";
         $result = $conn->query($sql);

        if ($result->num_rows > 0) { 
          while($row = $result->fetch_assoc()) {
            $uname = $row["user_name"];
            $email = $row["email_id"];
            $pass = $row["password"];
            $user_id = $row["user_id"];
            if (($name == $uname || $name == $email) && $pass_md == $pass) {
              $_SESSION["user"] = $uname;
              $_SESSION["uid"] = $user_id;
              $found = 1;
              return true;
              break;
            }
          }
        }
      }
    }
  } 
}
    
 function loginFound() {
    global $found,$name,$passwd, $verify_id, $role;
    require 'database_connection.php';
   //If result is not found
    if (isset($_POST['submit'])) {
      if(!empty($name) && !empty($passwd)) {
        if ($found == 0) { 
          echo "<h2 class='invalid'>Invalid emailID or password</h2>";
        }

     //If result is found and getting the role_name from roles table.     
      else {
        $sql = "SELECT role_id, user_id from members WHERE user_id = " . $_SESSION["uid"];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $role =  $row['role_id'];
        if (!empty($role)) {
          $sql = "SELECT role_id, role_name from roles WHERE role_id = " . $role;
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $role_name =  $row['role_name'];  
          $_SESSION["role"] = $role_name;
        }   
        header('Location: /action/user');    
        $conn->close();  
       } 
    }
   }    
}
 function getLogin() {
  global $name, $emailErr, $passwd, $pwdErr;
  if ($_SESSION["uid"] == 1 || $_SESSION["role"] == "Manager" || $_SESSION["role"] == "Developer") {
    header('Location: /action/user');
    }
    //Login Details
    else {
      echo "<div class ='signinpage'><form action='/action/signin' method='post'>";
      echo "<p class='labels'>Email ID :-</p> <input type='text' name='email' value='" . $name . "'><span>". $emailErr . "</span><br>";
      echo "<p class='labels'>Password :-</p> <input type='password' name='pwd' value='" . $passwd . "'><span>". $pwdErr . "</span><br>";
      echo "<input type='submit' name='submit' value='Submit'><br></div>";
    }
 }  

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }     
?>