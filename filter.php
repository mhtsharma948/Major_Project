<?php
//require 'logoutdisplay.php';
$task_id = $_GET['tid'];
?>
<!-- Page for Filter option, to see the list of tasks from a start and end date. -->
<html lang="en">
<head>
  <title>Date Filter</title>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
            <li><a href='signout.php'>Sign out</a></li>
        </ul>
    </div>
</nav>

<div class='row center-align'><br><br><br>
    <div class='col s3'></div>
    <div class="card cyan lighten-5 col s6">
            <div class='row center'>
                <div class='col s2'></div>
                <div class='input-field col s8'>
                    <i class="material-icons prefix">today</i>
                    <input class='validate' type='text' id="datepicker" placeholder='Start Date' ><br>
                </div>
            </div>
            <div class='row center'>
                <div class='col s2'></div>
                <div class='input-field col s8'>
                    <i class="material-icons prefix">today</i>
                    <input class='validate' type='text' id="datepicker1" placeholder='End Date' ><br>
                </div>
            </div>
        <button class="btn waves-effect waves-light cyan lighten-2" type="button" value='Submit' onclick="getdet()">Submit<i class="material-icons right">send</i></button><br><br>

    </div>
</div>

      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>

      <script>
          function getdet() {
              var a = $("#datepicker").val();
              console.log(a);
              var b1 = $.datepicker.formatDate( "@", new Date(a) );
              b1 = b1 / 1000;
              console.log(b1);
              var b = $("#datepicker1").val();
              console.log(b);

              b2 = $.datepicker.formatDate( "@", new Date(b) );
              b2 = b2 / 1000;
              console.log(b2);

              xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("txtHint").innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("POST","date_picker.php?tid=<?php echo $task_id;?>&sd="+b1+"&ed="+b2,true);
              xmlhttp.send();
          }
      </script>
      <script>
          $(function() {
              $("#datepicker").datepicker();
              $("#datepicker1").datepicker();
          } );
      </script>
</body>
</html>
