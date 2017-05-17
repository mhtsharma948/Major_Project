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
    <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
    <title>Project Arch</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--font awesome library-->
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
</head>
<body>
<?php
require 'navAfterSignin.php';
?>
<?php
session_start();
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
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html>
