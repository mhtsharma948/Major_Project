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
<nav>
    <div class="nav-wrapper  cyan lighten-2">
        <a href="#!" class="brand-logo">ProjArch</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="signin.php">Sign in</a></li>
            <li><a href="signup_page.php">Sign Up</a></li>
        </ul>
    </div>
</nav>
<?php
    // If no session is there..
    if(empty($_SESSION["user"])) {
        echo "<h1>JOYO - Project Management Tool</h1>";
        echo "<br><div class = 'main'><a href='signin.php' class='link'>Sign In</a>";
        echo "<a href='signup_page.php' class='link'>Sign up</a></div><br>";
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