<!DOCTYPE html>
<html>
<head>
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
require 'databaseConnection.php';
$wid_arr = array();

if ($_SESSION['role'] == "Manager") {
    echo "<br><br><br><br><table class='table highlight responsive-table'> <thead><tr><th>Workspace Name</th><th>Description</th><th>List of Task</th><th>Create Task</tr></thead>";

    ///Query for Displaying list of workspaces for manager.
    $sql = "SELECT distinct w.workspace_id, w.project_name,  w.description  FROM workspace AS w JOIN members AS m  ON w.workspace_id = m.workspace_id JOIN roles as r  ON m.role_id = r.role_id AND r.role_name = 'Manager' AND m.user_id = ". $_SESSION["uid"];

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $wid = $row['workspace_id'];
            echo "<tbody><tr><td>" .  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=listOfTasks.php?wid=" . $wid . ">List of Task<i class=\"material-icons tiny\">web</i> </td></a><td><a class='list'  href=taskCreate.php?wid=" . $wid . ">Create Task<i class=\"material-icons tiny\">edit_mode</i></a></td></tr></tbod" ;
        }
        echo "<br>";
    }

    //Query for displaying list of developers who are also managers.
    $sql =  "SELECT m.workspace_id  FROM members AS m JOIN roles AS r ON m.role_id = r.role_id WHERE m.user_id =". $_SESSION['uid'] . " AND r.role_name ='developer' ";
    $result = $conn->query($sql);
    //print_r($result);
    $i = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $wid_arr[$i] = $row['workspace_id'];
            $i++;
        }
    }
    $j = 0;
    while ($j < $i) {
        $sql = "SELECT workspace_id, project_name,  description FROM workspace WHERE workspace_id = " . $wid_arr[$j];
        $result = $conn->query($sql);
        // print_r($result);
        $row = $result->fetch_assoc();
        echo "<tr><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=listOfTasks.php?dev=1&wid=" . $wid_arr[$j] . ">List of Task <i class=\"material-icons tiny\">web</i></td></a></tr>" ;
        $j++;
    }
    echo "</table>";
}

else {
    //Query for displaying list of developers who are only developers in a particular workspace.
    echo "<table class='table'> <tr><th>Workspace Name</th><th>Description</th><th>List of Task</th></tr>";
    $sql =  "SELECT m.workspace_id  FROM members AS m JOIN roles AS r ON m.role_id = r.role_id WHERE m.user_id =". $_SESSION['uid'] . " AND r.role_name ='developer' ";
    $result = $conn->query($sql);
    $i = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $wid_arr[$i] = $row['workspace_id'];
            $i++;
        }
    }
    $j = 0;
    while ($j < $i) {
        $sql = "SELECT workspace_id, project_name, description FROM workspace WHERE workspace_id = " . $wid_arr[$j];
        $result = $conn->query($sql);
        // print_r($result);
        $row = $result->fetch_assoc();
        echo "<tr><td>".  $row['project_name'] . "</td><td>". $row['description'] . "</a></td><td><a class='list' href=listOfTasks.php?dev=1&wid=" . $wid_arr[$j] . ">List of Task </td></a></tr>" ;
        $j++;
    }
    echo "</table>";
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="resources/js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html>


