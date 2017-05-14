<?php
  session_start();
  require 'logoutdisplay.php';
  $wid = $_GET['wid'];
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
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
</body>
</html>    
