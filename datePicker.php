<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body>
</body>
</html>

<?php
	session_start();
	$start_date = $_GET['sd'];
	// echo $start_date;

	$end_date = $_GET['ed'];
	// echo "<br>" . $end_date;

	$task_id = $_GET['tid'];
	if ($start_date == "NaN" || $end_date == "NaN") {
		echo "<br><h2 class='list'>Fill the details.";	
	}

	else {
		//Checking if date entries are correct.
		if ($end_date > $start_date) {
			require 'database_connection.php';
			$sql = "SELECT time_log, comments, time_in_sec FROM dev_time_logs WHERE time_in_sec >= " . $start_date . "   and time_in_sec <= " . $end_date . " AND task_id = " . $task_id;
				
			 $result = $conn->query($sql);
			 if ($result->num_rows <= 0) {
			 	echo "<br><h2 class='list'>No time logs and comments";
			}
			 else {
			 	echo "<table><tr><th>Time Log</th><th>Comments</th><th>Spent time</th><th>Progress</th></tr>";
			  while ($row = $result->fetch_assoc()) {
			 		echo "<tr><td>" . $row['time_log'] . "</td><td>" . $row['comments'] . "</td>";
			 	}

			 	$sql = "SELECT spent_time, progress FROM developer WHERE task_id = " . $task_id;
			 	$result = $conn->query($sql);
			 	while ($row = $result->fetch_assoc()) {
			 		echo "<td>" . $row['spent_time'] . "</td><td>" . "<progress max=100 value= ". $row['progress'] . "></td></tr>";
			 	}
			 		echo "</table>";
			 }
		}
		else {
			echo "<br><h2 class='list'>Incorrect End date";
		}
	}  
?>
