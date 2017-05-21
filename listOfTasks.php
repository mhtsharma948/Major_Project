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
    <title>Project Arch</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="resources/css/materialize.min.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--custom css-->
    <link rel="stylesheet" type="text/css" href="resources/sass/stylesheets/homepage.css">
</head>
<body>
<?php
require 'navAfterSignin.php';
?>
<?php
    session_start();
    $dev = "";
    $uid = $_SESSION["uid"];
    $wid = $_GET['wid'];
    $dev = $_GET['dev'];
    require 'databaseConnection.php';
    echo "<table class='table highlight responsive-table'> <thead><tr><th>Task Name</th><th>Estimate Time</th><th>Description</th><th>Filter</th><th>Update</th></tr></thead>";

    // List of tasks for the manager
    if (!empty($wid) & $dev != 1) {
        $sql = "SELECT t.task_id, task_name, estimate_time, description, spent_time FROM task_create AS t JOIN developer AS d ON t.task_id = d.task_id WHERE t.workspace_id = " . $wid;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $task_id = $row['task_id'];
                echo "<tr><td>" . $row['task_name'] . "</td><td>" . $row['estimate_time'] . "</td><td>" . $row['description']. "</td><td><a class ='list' href=filter.php?tid=". $task_id . "> Filter      <i class=\"tiny material-icons\">clear_all</i></a></td></tr>" ;
                echo "<br>";
            }
        }
        echo "</table>";
    }
    // List of tasks for the developer
    else {
        // echo "mohit";
        $sql = "SELECT t.task_id, task_name, estimate_time, description, spent_time FROM task_create AS t JOIN developer AS d ON t.task_id = d.task_id WHERE d.user_id = " . $uid . " AND t.workspace_id= " . $wid;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $task_id = $row['task_id'];
                echo "<tr><td>" . $row['task_name'] . "</td><td>" . $row['estimate_time'] . "</td><td>" . $row['description']. "</td><td><a class ='list' href=filter.php?tid=". $task_id . "> Filter by Date</a></td><td><a class='list' href=timeLog.php?uid=" . $uid . "&tid=". $task_id . ">Update<i class=\"tiny material-icons\">system_update_alt</i></a></td></tr>" ;
                echo "<br>";
            }
        }
    }
    ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="resources/js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html>

