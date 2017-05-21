<?php
session_start();
// Retrieving values from form.
$tname = $descr = $developer = $time = "";
$nameErr = $timeErr = $descErr = $devErr = "";
//    require 'logoutdisplay.php';
$wid = $_GET['wid'];
if ($_SESSION['role'] == "Manager") {
    if(isset($_POST['submit'])) {
        if (empty($_POST["tname"])) {
            $nameErr = "task name is required";
        }
        else {
            $tname = test_input($_POST["tname"]);
        }
        if (empty($_POST["time"])) {
            $timeErr = "time is required";
        }
        else {
            $time = test_input($_POST["time"]);
        }

        if (empty($_POST["description"])) {
            $descErr = "description is required";
        }
        else {
            $descr = test_input($_POST["description"]);
        }

        if (empty($_POST['Developer'])) {
            $devErr = "Select any developer for the task";
        }

        else {
            $developer = $_POST["Developer"];
        }

        //Checking if there is no error , all validations correct
        if (empty($nameErr) && empty($descErr) && empty($devErr) && empty($timeErr)) {
            require 'databaseConnection.php';

            // Inserting data into table called task_create
            $sql = "INSERT INTO task_create (task_name, estimate_time, description,workspace_id) VALUES('$tname', '$time', '$descr','$wid')";

            if ($conn->query($sql) === TRUE) {
                $tid = $conn->insert_id;
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Inserting data into developer table.
            $sql = "INSERT INTO developer (task_id, user_id) VALUES ('$tid', '$developer')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $sql = "SELECT workspace_id FROM members WHERE workspace_id =" . $wid . " AND user_id = " . $developer . " AND role_id = 3";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                header('Location: mainPage.php');
            }
            else {
                //Inserting data into members table which will help user to show all the details which is assigned to him.
                $sql = "INSERT INTO members (workspace_id, user_id , role_id) VALUES ('$wid', '$developer' , '3')";
                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                header('Location: mainPage.php');
            }

        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
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
<!-- Page for Creation of a task -->
<body>
<?php
require 'navAfterSignin.php';
?>
<div class='row center-align'><br><br><br>
    <div class='col s3'></div>
    <div class="card cyan lighten-5 col l6 s12 create_task">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?wid=<?php echo $wid;?>" method="post" class="col s12">
            <div class='row center'>
                <div class='col l2'></div>
                <div class='input-field col m8 s12'>
                    <i class="material-icons prefix">account_circle</i>
                    <input class='validate' id="tname" type='text' name="tname" value="<?php echo $tname; ?>"><span class="error"><?php echo $nameErr;?></span><br>
                    <label for="tname">Name</label>
                </div>
            </div>
            <div class='row center'>
                <div class='col l2'></div>
                <div class='input-field col m8 s12'>
                    <i class="material-icons prefix">av_timer</i>
                    <input class='validate' type='time' id="Time" name="time" value="<?php echo $time; ?>"><span class="error"><?php echo $timeErr;?></span><br>
                    <label for="time"></label>
                </div>
            </div>
            <div class='row center'>
                <div class='col l2'></div>
                <div class='input-field col m8 s12'>
                    <i class="material-icons prefix">description</i>
                    <textarea class="materialize-textarea" id="description" name="description" data-length="200"></textarea><span class="error"><?php echo $descErr;?></span><br><br><br>
                    <label for="description">Description</label>
                </div>
            </div>
            <a class="waves-effect waves-light btn cyan lighten-2" onclick="getuser()"><i class="material-icons right">add</i>Add Developer</a>
            <div id ="txtHint"><span class="error"><?php echo $devErr;?></span><br></textarea><br></div>
            <button class="btn waves-effect waves-light cyan lighten-2" type="submit" name="submit">Submit<i class="material-icons right">send</i></button><br><br>
            <br><br>
        </form>
    </div>
</div>

<script>
    function getuser() {
        xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST","getDev.php?wid=<?php echo $wid;?>",true);
            xmlhttp.send();
        }
    </script>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="resources/js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>x
</body>
</html>