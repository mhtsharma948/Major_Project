<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
	// remove all session variables
	session_unset(); 
	
	// destroy the session 
	session_destroy(); 

	//echo "You are successfully logged out<br>";
	header('Location: index.php');
?>
</body>
</html>