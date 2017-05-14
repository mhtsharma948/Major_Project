<html>
<head>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body></body>
</html>	
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>JOYO Project Management Tool</title>
</head>
<body>
<?php
	// If no session is there.. 
	if(empty($_SESSION["user"])) {
		echo "<h1>JOYO - Project Management Tool</h1>";
		echo "<br><div class = 'main'><a href='signin.php' class='link'>Sign In</a>";
  	echo "<a href='signup_page.php' class='link'>Sign up</a></div><br>";
 	}
 	// if session exists
	else {
		echo "<br>";
		require 'main_page.php';
	}
?>
</body>
</html>