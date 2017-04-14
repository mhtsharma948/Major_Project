<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body></body>
</html>
<?php
	require 'logoutdisplay.php';
	echo $_SESSION['uid'];
	function checkSession() {
		session_start();
		//Checking which user has login and refer to that page according to role assigned.
		if ($_SESSION["uid"] == 1) {
			echo "<a class='link' href='/action/getWorkspaces'>List of Workspaces</a><br><br><br>";		
			echo "<a class='link' href='/action/createWorkspace'>Create a Workspace</a><br>";
		}
		else if ($_SESSION["role"] == "Manager") {
			echo "<a class='link' href='/action/managerWorkspaces'> List of Workspaces </a><br>";
		}
		else {
		    echo "<a class='link' href='/action/managerWorkspace/1'> List of Workspaces </a><br>";
		}
 }	 
?>