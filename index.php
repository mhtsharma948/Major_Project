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

<?php
// Start the session
session_start();
?>
<?php
    // If no session is there..
    if(empty($_SESSION["user"])) {
        echo "<body class=\"background\" background=\"background.jpg\">";
        require 'navBeforeSignin.php';
        echo "<div class='background'>";
        echo "<div class=\"card col s6 transicard\" style='margin-bottom: 0px; margin-top: 0px'>";
        echo "<br><p class='flow-text center teal-text text-lighten-4' style='font-size: 57px;'>PROJECT MANAGEMENT<br> MADE EASY</p>";
        echo "<p class='flow-text center  blue-grey-text text-darken-4' style='font-size: 35px;'>ProjArch makes tracking, collaborating, and reporting a no-brainer, no matter how your teams choose to work.More than 15,000 organizations manage their work in ProjArch</p>";

        echo "<div class='row center-align'>";
        echo "<div class='col l5 m4 s2'></div>";
        echo "<a class=\"waves-effect waves-light btn-large col l2 m3 s8\" href='signin.php'>Try Now</a></div>";
        echo "<br>";
        echo "</div>";
        echo "</div>";
        echo "<script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-2.1.1.min.js\"></script>";
        echo "<script type=\"text/javascript\" src=\"resources/js/materialize.min.js\"></script>";
        echo "<script>$(document).ready(function(){ $(\".button-collapse\").sideNav(); });</script>";
        echo "</body>";
    }
    // if session exists
    else {
        echo "<br>";
        require 'mainPage.php';
    }

    ?>



</html>