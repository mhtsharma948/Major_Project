<?php
	//Starting the session
	session_start();

	// remove all session variables
	session_unset(); 
	
	// destroy the session 
	session_destroy(); 

	//echo "You are successfully logged out<br>";
	header('Location: /');
?>
