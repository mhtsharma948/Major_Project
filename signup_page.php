<!DOCTYPE html>
<html>
<head>
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

    <nav>
        <div class='nav-wrapper  cyan lighten-2'>
            <a href='#!' class='brand-logo'>ProjArch</a>
            <ul class='right hide-on-med-and-down'>
                <li><a href='signin.php'>Sign In</a></li>
                <li><a href='signup_page.php'>Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <!-- Sign page for creating new account -->
    <!--	<div class="signup_page">
		<form method="post" action="<?php /*echo htmlspecialchars($_SERVER['PHP_SELF']);*/?>">
			<p class='labels'>UserName: </p><input type="text" name="uname" value="<?php /*echo $name; */?>">
			<span class="error"><?php /*echo $nameErr;*/?></span><br>
			<p class='labels'>Emailid:</p><input type="text" name="email" value="<?php /*echo $email; */?>"><span class="error"><?php /*echo $emailErr;*/?></span><br>
			<p class='labels'>Password:</p><input type="password" name="pwd" value="<?php /*echo $passwd; */?>"><span class="error"><?php /*echo $pwdErr;*/?></span><br>
			<input type="submit" name="submit">
		</form>
	</div>-->


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
                <button class="btn waves-effect waves-light cyan lighten-2" type="submit" name="submit" value='Submit'>Submit<i class="material-icons right">send</i></button>
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
</body>
</html>


   