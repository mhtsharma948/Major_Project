 <?php
	session_start();
	require 'logoutdisplay.php';
	$spent_time = "";
	$time = $bar = $comments = "";	
	$progressErr = $timeErr = $commErr = ""; 
	$task_id = $_GET['tid'];
	$uid = $_GET['uid'];
	
	if (isset($_POST['submit'])) {
		if (empty($_POST['log'])) {
			$timeErr = "Time is required";	
		}
		else {
			$time = $_POST['log'];
			// check time only contains numbers
    	if (!preg_match("/^[0-9]{1,3}$/",$time)) {	
				$timeErr = "Only integer value allowed";
			}
		}

		if (empty($_POST['progress'])) {
			$progressErr = "Progress is required";	
		}
		else {
			$bar = $_POST['progress'];
			// check time only contains numbers
    	if (!preg_match("/^[0-9]{1,3}$/",$bar)) {	
				$progressErr = "Only integer value allowed";
			}
		}

		if (empty($_POST['comments'])) {
			$commErr = "Comments are required";	
		}
		else {
			$comments = $_POST['comments'];
		}
	
	
		if (empty($timeErr) && empty($progressErr) && empty($commErr)) {
			$prev_time = $prev_comm = "";
			require 'database_connection.php';

			//Retrieving the previous spent time and modifying it with the updated one.
			$sql = "SELECT spent_time FROM developer WHERE user_id = " . $uid;
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {
			$prev_time = $row['spent_time'];
			}

			$spent_time = $time+$prev_time;

			//update spent time and progress
			$sql = "UPDATE developer SET spent_time =" . $spent_time . ", progress = " . $bar . " WHERE user_id=" . $uid;

			if ($conn->query($sql) === TRUE) {	
				echo "Updated Carefully";
			}
			else {
				echo "Error updating record: " . $conn->error;
			}

			//Inserting the data in table called dev_time_logs.
			$t = time();
			$sql = "INSERT INTO dev_time_logs (time_log, comments, time_in_sec, task_id) values ('$time', '$comments', '$t', '$task_id')";
			$conn->query($sql);
			header('Location: main_page.php');
		}
	}
	echo "<br><form method='post' action=time_log.php?tid=" . $task_id ."&uid=" . $uid . "><div class='white'><p class='labels'>Timelog</p> <input type='text' name='log' value=" . $time . "><span>" . $timeErr . "</span>
		<br><p class='labels'>Percentage Complete </p><input type='text' name='progress' value=" . $bar . "><span>" . $progressErr . "</span><br><p class='labels'>Comments</p> <textarea rows = 5 cols=25 name='comments' value=" . $comments . "></textarea><span>" . $commErr . "</span><br><input type='submit' name='submit'>";			
?>
 
<!DOCTYPE html>
 <html>
	 <head>
		 	<link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
		 	<title></title>
	 </head>
	 <body>
	 </body>
 </html>

 