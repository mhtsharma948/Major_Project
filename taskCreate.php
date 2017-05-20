<!DOCTYPE html>
<html>
<head>
	<title></title>
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
<nav>
    <div class='nav-wrapper  cyan lighten-2'>
        <a href='#!' class='brand-logo'>ProjArch</a>
        <ul class='right hide-on-med-and-down'>
            <li><a href='signout.php'>Sign out</a></li>
        </ul>
    </div>
</nav>
<div class='row center-align'><br><br><br>
    <div class='col s3'></div>
    <div class="card cyan lighten-5 col s6 create_task">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>?wid=<?php echo $wid;?>" method="post" class="col s12">
            <div class='row center'>
                <div class='col s2'></div>
                <div class='input-field col s8'>
                    <i class="material-icons prefix">account_circle</i>
                    <input class='validate' type='text' placeholder="Name" name="tname" value="<?php echo $tname; ?>"><span class="error"><?php echo $nameErr;?></span><br>
                </div>
            </div>
            <div class='row center'>
                <div class='col s2'></div>
                <div class='input-field col s8'>
                    <i class="material-icons prefix">av_timer</i>
                    <input class='validate' type='text' placeholder="Time" name="time" value="<?php echo $time; ?>"><span class="error"><?php echo $timeErr;?></span><br>
                </div>
            </div>
            <div class='row center'>
                <div class='col s2'></div>
                <div class='input-field col s8'>
                    <i class="material-icons prefix">description</i>
                    <textarea class="materialize-textarea" placeholder="description" name="description"></textarea><span class="error"><?php echo $descErr;?></span><br><br><br>
                </div>
            </div>
            <a class="waves-effect waves-light btn cyan lighten-2" onclick="getuser()"><i class="material-icons right">add</i>Add Developer</a>

            <button class="btn waves-effect waves-light cyan lighten-2" type="submit" name="submit">Submit<i class="material-icons right">send</i></button><br><br>

            <br><br>
        </form>
    </div>
</div>








<!--	<div class='create_task'> -->
<!--		<form action="--><?php //echo htmlspecialchars($_SERVER['PHP_SELF']);?><!--?wid=--><?php //echo $wid;?><!--" method="post">-->
<!--			<p class="labels">Task Name</p> <input type="text" name="tname" value="--><?php //echo $tname; ?><!--"><span class="error">--><?php //echo $nameErr;?><!--</span><br>-->
<!--			<p class="labels">Estimated Time:</p> <input type="text" name="time" value="--><?php //echo $time; ?><!--"><span class="error">--><?php //echo $timeErr;?><!--</span><br>-->
<!--			<p class="labels">Description: </p><br><textarea rows="10" cols="50" name="description"></textarea><span class="error">--><?php //echo $descErr;?><!--</span><br><br><br>-->
<!--			<input type="button" onclick="getuser()" value ="Add developers"><br><br>-->
			<div id ="txtHint" class="white"><span class="error"><?php echo $devErr;?></span><br></textarea><br></div>
			<br><br>
			<input type="submit" name="submit" value="save">
		</form>	
	</div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="resources/js/materialize.min.js"></script>
    <script>
        function ogetuser() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("POST","get_dev.php?wid=<?php echo $wid;?>",true);
            xmlhttp.send();
        }
    </script>
    <?php
    session_start();
    // Retrieving values from form.
    $tname = $descr = $developer = $time = "";
    $nameErr = $timeErr = $descErr = $devErr = "";
    require 'logoutdisplay.php';
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
                    //echo "New record created successfully";
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
</body>
</html>