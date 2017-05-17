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
    <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
    <title>Project Arch</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--font awesome library-->
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
</head>
<body>

<?php
require 'navBeforeSignin.php';
?>
    <div class='row center-align'><br><br><br>
        <div class='col s3'></div>
        <div class="card cyan lighten-5 col s6">
            <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method='post' class='col s12'>
                <div class='row center'>
                    <div class='col s2'></div>
                    <div class='input-field col s8'>
                        <i class="material-icons prefix">account_circle</i>
                        <input class='validate' type='text' name='uname' placeholder='User Name' value="<?php echo $name;?>"><span class="error"><?php echo $nameErr;?></span><br>
                    </div>
                </div>
                <div class='row center'>
                    <div class='col s2'></div>
                    <div class='input-field col s8'>
                        <i class="material-icons prefix">email</i>
                        <input class='validate' type='email' name='email' placeholder='Email' value="<?php echo $email; ?>"><span class="error"><?php echo $emailErr;?></span><br>
                    </div>
                </div>
                <div class='row center'>
                    <div class='col s2'></div>
                    <div class='input-field col s8'>
                        <i class="material-icons prefix">vpn_key</i>
                        <input class='validate' type='password' name='pwd' placeholder='Password' value="<?php echo $passwd;?>"><span class="error"><?php echo $pwdErr;?></span><br>
                    </div>
                </div>
                <button class="btn waves-effect waves-light cyan lighten-2" type="submit" name="submit" value='Submit'>Submit<i class="material-icons right">send</i></button><br><br>
                <a href='signin.php'><i class="tiny material-icons">perm_identity</i>already have account?</a>

                <br><br>
            </form>
        </div>
    </div>

    <?php
    // define variables and set to empty values
    $uid = $name = $email = $passwd = $select = "";
    $nameErr = $emailErr = $pwdErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // On submitting form below function will execute.
        if (isset($_POST['submit'])) {
            if (empty($_POST["uname"])) {
                $nameErr = "user name is required";
            }
            else {
                $name = test_input($_POST["uname"]);
                // check name only contains letters, numbers and whitespace
                if (!preg_match("/^[a-zA-Z0-9]*$/",$name)) {
                    $nameErr = "Only letters, numbers and white space allowed";
                }
            }

            if (empty($_POST["email"]))  {
                $emailErr = "email is required";
            }
            else {
                $email = test_input($_POST["email"]);
                // check if e-mail address syntax is valid or not
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
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
        }
        if (empty($nameErr) && empty($emailErr) && empty($pwdErr)) {
            //Establishing DB connection.
            require 'database_connection.php';

            //Inserting data into signup table.
            $sql = "INSERT INTO signup (user_name, email_id, password) VALUES ('$name', '$email','$pass_md')";
            if ($conn->query($sql) === TRUE) {
                header('Location: signin.php');
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
        // echo $name . "<br>" . $email . "<br>" . $passwd;

    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
<script>$(document).ready(function(){ $(".button-collapse").sideNav(); });</script>
</body>
</html>


   