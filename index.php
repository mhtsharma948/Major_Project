<html>
<head>
    <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body></body>
</html>	
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Arch</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body class="background" background="background.jpg">
<?php
    // If no session is there..
    if(empty($_SESSION["user"])) {


        echo "<nav>";
        echo "<div class='nav-wrapper  cyan lighten-2'>";
        echo "<a href='#!' class='brand-logo'>ProjArch</a>";
        echo "<ul class='right hide-on-med-and-down'>";
        echo "<li><a href='signin.php'>Sign In</a></li>";
        echo "<li><a href='signup_page.php'>Sign Up</a></li>";
        echo "</ul>";
        echo "</div>";
        echo "</nav>";

        echo "<div class=\"card col s6 transicard\">";
        echo "<br><p class='flow-text center white-text text-lighten-3' style='font-size: 60px;'>PROJECT MANAGEMENT<br> MADE EASY</p>";
        echo "<p class='flow-text center  blue-grey-text text-darken-4' style='font-size: 35px;'>ProjArch makes tracking, collaborating, and reporting a no-brainer, no matter how your teams choose to work.More than 15,000 organizations manage their work in ProjArch</p>";

        echo "<div class='row center-align'>";
        echo "<div class='col s5'></div>";
        echo "<a class=\"waves-effect waves-light btn-large col s2\" href='signin.php'>Try Now</a></div>";
        echo "<br>";
        echo "</div>";
    }
    // if session exists
    else {
        echo "<br>";
        require 'main_page.php';
    }
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>