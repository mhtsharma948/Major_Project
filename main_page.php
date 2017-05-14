<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body></body>
</html>
<?php
	session_start();
	require 'logoutdisplay.php';
	//Checking which user has login and refer to that page according to role assigned.
	if ($_SESSION["uid"] == 1) {
		echo "<a class='link' href='list_workspaces.php'>List of Workspaces</a><br><br><br>";		
		echo "<a class='link' href='create_workspace.php'> Create a Workspace</a><br>";
	}
	else if ($_SESSION["role"] == "Manager") {
		echo "<a class='link' href='manager_workspace.php'> List of Workspaces </a><br>";
	}
	else  {
	 	echo "<a class='link' href='manager_workspace.php?dev=1'> List of Workspaces </a><br>";
	 }
?>