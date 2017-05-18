

<!-- Page for creating a workspace by the admin -->
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
$wid = $pname = $date = $descr = $manager = $developer = "";
$nameErr = $descErr = $mngErr = "";
if ($_SESSION['role'] == "Admin" || $_SESSION['uid'] == 1) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submit'])) {
            if (empty($_POST["pname"])) {
                $nameErr = "user name is required";
            }
            else {
                $pname = test_input($_POST["pname"]);
            }

            if (empty($_POST["description"])) {
                $descErr = "description is required";
            }
            else {
                $descr = test_input($_POST["description"]);
            }

            $manager = $_POST["Manager"];
            $developer = $_POST["Developer"];
            $wid = "";
            $man_size = count($manager);
            $dev_size = count($developer);

            if ($man_size == 0 || $dev_size == 0) {
                $mngErr = "Select Managers and Developers for the workspace";
            }

            if (empty($nameErr) && empty($descErr) && empty($mngErr)) {
                require 'databaseConnection.php';

                //Inserting workspace info into workspace table.
                $sql = "INSERT INTO workspace (project_name, description) VALUES('$pname' ,'$descr')";

                if ($conn->query($sql) === TRUE) {
                    $wid = $conn->insert_id;
                }
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                //Inserting names of those who are managers for that workspace.
                $sql = "SELECT role_id FROM roles WHERE role_name = 'Manager'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $role = $row['role_id'];

                echo $man_size;
                for ($i = 0; $i < $man_size; $i++) {
                    echo $manager[$i];
                    $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$manager[$i]', '$role')";
                    if ($conn->query($sql) === TRUE) {
                        echo "manager added";
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                //Inserting names of those who are managers for that workspace.
                $sql = "SELECT role_id FROM roles WHERE role_name = 'Developer'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $role =  $row['role_id'];

                for ($i = 0; $i < $dev_size; $i++) {
                    //echo $developer[$i];
                    $sql = "INSERT INTO members (workspace_id, user_id, role_id) VALUES('$wid', '$developer[$i]', '$role')";
                    if ($conn->query($sql) === TRUE) {
                        echo "developer added";
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
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
<div class='row center-align'><br><br><br>
    <div class='col s3'></div>
    <div class="card cyan lighten-5 col l6 s12 admin">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method='post' class='col s12'>
            <div class='row center'>
                <div class='input-field col l11 s12'>
                    <i class="material-icons prefix">account_circle</i>
                    <input class='validate' id="pname" type='text' name='pname' value="<?php echo $pname; ?>"><span class="error"><?php echo $nameErr;?></span><br>
                    <label for="pname">Project Name</label>

                </div>
            </div>

            <div class='row center'>
                <div class='input-field col l11 s12'>
                    <i class="material-icons prefix">account_circle</i>
                    <textarea id="textarea1" class="materialize-textarea" data-length="200" name="description" value="<?php echo $descr; ?>"></textarea><span class="error"><?php echo $descErr;?></span><br><br><br>
                    <label for="textarea1">Description</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light cyan lighten-2" type="button" onclick="getuser()">Add managers and developers<i class="material-icons right">supervisor_account</i></button><br><br>
            <button class="btn waves-effect waves-light cyan lighten-2" type="submit" name="submit" value='Submit'>Submit<i class="material-icons right">send</i></button><br><br>
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
            xmlhttp.open("POST","get_mng&dev.php",true);
            xmlhttp.send();
        }
    </script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="resources/js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html>
