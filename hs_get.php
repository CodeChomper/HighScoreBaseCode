<?php
	$game = $_GET['Game'];
	if(isset($_GET['HowMany'])){
		$how_many = $_GET['HowMany'];
	} else {
		$how_many = 1000;
	}

	get_high_scores($game, $how_many);
	
	function get_high_scores($game, $how_many){
		$servername = "localhost";
		$username = "codechom_score";
		$password = "highScore";
		$dbname = "codechom_logging";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "Select PlayerName, Score from high_score where GameName = '$game' order by Score desc limit $how_many";

		$result = $conn->query($sql);
		echo('Top scores for '. $game. "\n");
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo $row["PlayerName"]. " - " . $row["Score"]. "\n";
			}
		} else {
			echo "0 results";
		}

		$conn->close();
	}
	
?>