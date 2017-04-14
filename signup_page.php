<?php
  session_start();
  
  if (isset($_SESSION['role']) || isset($_SESSION['uid'])) {
    header('Location: /');
  }

  // define variables and set to empty values
  $uid = $name = $email = $passwd = $select = "";
  $nameErr = $emailErr = $pwdErr = "";

  function createAccount() {
    global $name, $email, $emailErr, $passwd, $pwdErr, $uid, $select, $nameErr;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	// On submitting form below function will execute.
    	if (isset($_POST['submit'])) {
    	 if (empty($_POST["uname"])) {
       	$nameErr = "user name is required";
      }
      else {
      	$name = test_input($_POST["uname"]);
      	// check name only contains letters, numbers and whitespace
      	if (!preg_match("/^[a-zA-Z0-9]*$/",$name)) {	
  				$nameErr = "Only letters, numbers and white space allowed";
  			}
      }

      if (empty($_POST["email"]))  {
      	$emailErr = "email is required";
      }
      else {
      	$email = test_input($_POST["email"]);
      	// check if e-mail address syntax is valid or not
  			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
  				$emailErr = "Invalid email format";
  				}
      }

      if (empty($_POST['pwd'])) {
      	$pwdErr = "password is required";
      }
      else {
      	$passwd = test_input($_POST["pwd"]);
        
      	$pass_md = md5($passwd);
      }
     }
     if (empty($nameErr) && empty($emailErr) && empty($pwdErr)) {
      //Establishing DB connection.
      require 'database_connection.php';

      //Inserting data into signup table.
      $sql = "INSERT INTO signup (user_name, email_id, password) VALUES ('$name', '$email','$pass_md')";
      if ($conn->query($sql) === TRUE) {
        header('Location: /action/signin');
      } 
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();   
     }
     // echo $name . "<br>" . $email . "<br>" . $passwd; 
    }
 } 
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
  
  function signupDisplay() {
    global $name, $nameErr, $email, $emailErr, $passwd, $pwdErr;
    echo '<div class="signup_page">
      <form method="post" action="/action/signup">
        <p class="labels">UserName: </p><input type="text" name="uname" value= ' . $name . '>
        <span class="error">' . $nameErr . '</span><br>
        <p class="labels">Emailid:</p><input type="text" name="email" value= ' . $email . '><span class="error">' . $emailErr . '</span><br>
        <p class="labels">Password:</p><input type="password" name="pwd" value= ' . $passwd . '><span class="error">' . $pwdErr . '</span><br>
        <input type="submit" name="submit">
      </form>
    </div>';
  }  
?>

   