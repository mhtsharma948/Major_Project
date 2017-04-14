<?php 
  // Setting up DB connection
  $servername = "localhost";
  $username = "root";
  $password = "manager";
  $dbname = "project_mgmt";
// Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else {
//	echo "Connection established";
	}
?>
