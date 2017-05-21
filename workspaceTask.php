<?php
session_start();
require 'navAfterSignin.php';
$wid = $_GET['wid'];
?>
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
<!-- Option for Add more managers and developers and remove existing also -->
<body>
<form action="addrem.php?wid=<?php echo $wid;?>" method="POST">
    <a class ='list' href="#" onclick="getuser()">Add more Managers and Developers</a><br><br><br>
    <div id ="add" class="white"></div>
    <br><br>
    <input type="submit" name="add" value="Add">
</form>
<form action="addrem.php?wid=<?php echo $wid;?>" method="POST">
    <a class ='list' href="#" onclick="getmng()">Remove Managers</a><br><br><br>
    <div id ="removemng" class="white"></div>
    <input type="submit" name="rm" value="Remove Managers">
</form>
<form action="addrem.php?wid=<?php echo $wid;?>" method="POST">
    <a class ='list' href="#" onclick="getdev()">Remove Developers</a><br><br><br>
    <div id ="removedev" class="white"></div>
    <input type="submit" name="rd" value="Remove Developers">
</form>
<br><br>
<script>
    function getuser() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("add").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","getmoreman&dev.php?wid=<?php echo $wid; ?>",true);
        xmlhttp.send();
    }
    function getmng() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("removemng").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","getmng.php?wid=<?php echo $wid; ?>",true);
        xmlhttp.send();
    }
    function getdev() {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("removedev").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST","getdev.php?wid=<?php echo $wid; ?>",true);
        xmlhttp.send();
    }
</script>
</body>
</html>