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
<body>
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