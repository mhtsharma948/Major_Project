<?php
require 'logoutdisplay.php';
$task_id = $_GET['tid'];
?>
<!-- Page for Filter option, to see the list of tasks from a start and end date. -->
<html lang="en">
<head>
  <title>Date Filter</title>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
</head>
<body>
  <div class="white">
  <p class="labels">Start Date:</p> <input type="text" id="datepicker"><br>
  <p class="labels">End Date:</p> <input type="text" id="datepicker1">
  <div id ="txtHint"> </div><br><br>
  <input type="button" class="button" value="Submit" onclick="getdet()">
</body>
</html>
