<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scle=1, user-scalable=no">
    <link rel="apple-touch-icon" href="resources/icon.png">
    <link rel="apple-touch-startup-image" href="resources/splash.png">
    <meta name="apple-mobile-web-app-title" content="ProjArch">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!--Apple iOS tags-->

    <!--Other mobile web app tags-->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" type="text/css" href="resources/sass/stylesheets/homepage.css">
    <title>Project Arch</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="resources/css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--font awesome library-->
    <link rel="stylesheet" href="resources/font-awesome-4.7.0/css/font-awesome.css">
</head>
<body>
<?php
require 'navAfterSignin.php';
session_start();

// Displaying list of workspaces for Admin
if ($_SESSION['role'] == "Admin" || $_SESSION['uid'] == 1) {
    require 'databaseConnection.php';
    echo "<table class='table highlight'> <thead><tr><th>Workspace Name</th><th>Description</th><th>Edit Workspace</th><th>List of Tasks</tr></thead>";

    //Query for displaying list of workspaces.
    $sql = "SELECT distinct  workspace_id, project_name, description FROM workspace";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $wid = $row['workspace_id'];
            echo "<tr></td><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list waves-effect waves-teal' href=workspaceTask.php?wid=" . $wid . ">EDIT <i class=\"material-icons tiny waves-effect waves-teal\">mode_edit</i></td><td>  <a class ='list' href='listOfTasks.php?wid=" . $wid . "'>LIST OF TASK<i class=\" tiny material-icons\">library_books</i></a></td> </tr>";
//            echo "<br>";
        }
    }
    echo "</table>";
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="resources/js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html>