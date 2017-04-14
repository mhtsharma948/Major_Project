<?php
	session_start();
	//This function will display homepage
	function getHome() {
	// If no session is there.. 
		if (empty($_SESSION["user"])) {
			echo "<h1>JOYO - Project Management Tool</h1>";
			echo "<br><div class = 'main'><a href='/action/signin' class='link'>Sign In</a>";
	  	echo "<a href='/action/signup' class='link'>Sign up</a></div><br>";
	 	}
	 	// if session exists
		else {
			echo "<br>";
			header('Location: /action/user');
		}
}	
?>