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
     session_start();
     require 'navAfterSignin.php';
     $spent_time = "";
     $time = $bar = $comments = "";
     $progressErr = $timeErr = $commErr = "";
     $task_id = $_GET['tid'];
     $uid = $_GET['uid'];

     if (isset($_POST['submit'])) {
         if (empty($_POST['log'])) {
             $timeErr = "Time is required";
         }
         else {
             $time = $_POST['log'];
             // check time only contains numbers
             if (!preg_match("/^[0-9]{1,3}$/",$time)) {
                 $timeErr = "Only integer value allowed";
             }
         }

         if (empty($_POST['progress'])) {
             $progressErr = "Progress is required";
         }
         else {
             $bar = $_POST['progress'];
             // check time only contains numbers
             if (!preg_match("/^[0-9]{1,3}$/",$bar)) {
                 $progressErr = "Only integer value allowed";
             }
         }

         if (empty($_POST['comments'])) {
             $commErr = "Comments are required";
         }
         else {
             $comments = $_POST['comments'];
         }


         if (empty($timeErr) && empty($progressErr) && empty($commErr)) {
             $prev_time = $prev_comm = "";
             require 'databaseConnection.php';

             //Retrieving the previous spent time and modifying it with the updated one.
             $sql = "SELECT spent_time FROM developer WHERE user_id = " . $uid;
             $result = $conn->query($sql);
             while($row = $result->fetch_assoc()) {
                 $prev_time = $row['spent_time'];
             }

             $spent_time = $time+$prev_time;

             //update spent time and progress
             $sql = "UPDATE developer SET spent_time =" . $spent_time . ", progress = " . $bar . " WHERE user_id=" . $uid;

             if ($conn->query($sql) === TRUE) {
                 echo "Updated Carefully";
             }
             else {
                 echo "Error updating record: " . $conn->error;
             }

             //Inserting the data in table called dev_time_logs.
             $t = time();
             $sql = "INSERT INTO dev_time_logs (time_log, comments, time_in_sec, task_id) values ('$time', '$comments', '$t', '$task_id')";
             $conn->query($sql);
             header('Location: mainPage.php');
         }
     }


     echo "<div class='row center-align'><br><br><br>";
     echo "<div class='col s3'></div>";
     echo "<div class=\"card cyan lighten-5 col l6 s12\">";
     echo "<form action=timeLog.php?tid=" . $task_id ."&uid=" . $uid . " method='post' class='col s12'>";

     echo "<div class='row center'>";
     echo "<div class='input-field col l11 s12'>";
     echo "<i class=\"material-icons prefix\">query_builder</i>";
     echo "<input class='validate' type='number' id='log' name='log' value=" . $time . "><span>" . $timeErr . "</span>";
     echo "<label for=\"log\">Time Log</label>";
     echo "</div>";
     echo "</div>";

     echo "<div class='row'>";
     echo "<div class='input-field col l11 s12'>";
     echo "<i class=\"material-icons prefix\">play_for_work</i>";
     echo "<input class='validate' id='progress' type='number' name='progress' value=" . $bar . "><span>" . $progressErr . "</span><br>";
     echo "<label for=\"progress\">Percentage Complete</label>";
     echo "</div>";
     echo "</div>";

     echo "<div class='row'>";
     echo "<div class='input-field col l11 s12'>";
     echo "<i class=\"material-icons prefix\">comment</i>";
     echo " <textarea class=\"materialize-textarea\" id=\"comments\" data-length=\"200\" name='comments' value=" . $comments . "></textarea><span>" . $commErr . "</span><br>";
     echo "<label for=\"comments\">Comments</label>";
     echo "</div>";
     echo "</div>";

     echo " <button class=\"btn waves-effect waves-light cyan lighten-2\" type=\"submit\" name=\"submit\" value='Submit'>Submit<i class=\"material-icons right\">send</i></button><br><br><br>";
     echo "</form>";
     echo "</div>";
     echo "</div>";
     echo "</div>";
     ?>
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
     <script type="text/javascript" src="resources/js/materialize.min.js"></script>
     <script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
	 </body>
 </html>

 