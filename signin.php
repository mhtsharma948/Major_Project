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
//This block checks the user's login details and matches with the DB.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $name = $email = $passwd =  "";
        $emailErr = $pwdErr = "";
        $found = 0;

        if (empty($_POST["email"]))  {
            $emailErr = "email is required";
        }
        else {
            $name = test_input($_POST["email"]);
            // check if e-mail address syntax is valid or not
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$name)) {
                $emailErr = "Invalid email format";
            }
        }
        if (empty($_POST['pwd'])) {
            $pwdErr = "password is required";
        }
        else {
            $passwd = test_input($_POST["pwd"]);
            $pass_md = md5($passwd);
        }
        if (empty($emailErr) && empty($pwdErr)) {
            require 'databaseConnection.php';

            $sql = "SELECT user_id,user_name, email_id, password FROM signup";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $uname = $row["user_name"];
                    $email = $row["email_id"];
                    $pass = $row["password"];
                    $user_id = $row["user_id"];
                    if (($name == $uname || $name == $email) && $pass_md == $pass) {
                        $_SESSION["user"] = $uname;
                        $_SESSION["uid"] = $user_id;
                        $verify_id = $_SESSION["uid"];
                        $found = 1;
                        break;
                    }
                }
            }
            //If result is not found
            if ($found == 0) {
                echo "<h2 class='invalid'>Invalid emailID or password</h2>";
            }

            //If result is found and getting the role_name from roles table.
            else {
                $sql = "SELECT role_id, user_id from members WHERE user_id = " . $verify_id;
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $role =  $row['role_id'];
                echo $role;

                if (!empty($role)) {
                    $sql = "SELECT role_id, role_name from roles WHERE role_id = " . $role;
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $role_name =  $row['role_name'];
                    $_SESSION["role"] = $role_name;
                }
                header('Location: mainPage.php');
                $conn->close();
            }
        }
    }
}
if ($_SESSION["uid"] == 1 || $_SESSION["role"] == "Manager" || $_SESSION["role"] == "Developer") {
    header('Location: mainPage.php');
}
//Login Details
else {
    //  nav bar
    require 'navBeforeSignin.php';
    // sign-in form
    echo "<div class='row center-align'><br><br><br>";
    echo "<div class='col s3'></div>";
    echo "<div class=\"card cyan lighten-5 col l6 s12\">";
    echo "<form action='signin.php' method='post' class='col s12'>";
    echo "<div class='row center'>";
    echo "<div class='input-field col l11 s12'>";
    echo "<i class=\"material-icons prefix\">email</i>";
    echo "<input class='validate' type='email' name='email' id='Email' value='" . $name . "'><span>". $emailErr . "</span><br>";
    echo "<label for=\"Email\">Email</label>";
    echo "</div>";
    echo "</div>";

    echo "<div class='row'>";
    echo "<div class='input-field col l11 s12'>";
    echo "<i class=\"material-icons prefix\">vpn_key</i>";
    echo "<input class='validate' type='password' name='pwd' id='Password' value='" . $passwd . "'><span>". $pwdErr . "</span><br>";
    echo "<label for=\"Password\">Pasword</label>";
    echo "</div>";
    echo "</div>";
    echo " <button class=\"btn waves-effect waves-light cyan lighten-2\" type=\"submit\" name=\"submit\" value='Submit'>Submit<i class=\"material-icons right\">send</i></button>";
    echo "</form>";
    echo "<a href='signupPage.php'><i class=\"tiny material-icons\">perm_identity</i>no account?</a><br><br>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

}
/*echo "<p class='labels'>Password :-</p> <input type='password' name='pwd' value='" . $passwd . "'><span>". $pwdErr . "</span><br>";
echo "<input type='submit' name='submit' value='Submit'><br></div>";*/
/*echo "<input placeholder='Email' id='first_name' type='text' class='validate'>";
echo "";*/
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="resources/js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html> 
