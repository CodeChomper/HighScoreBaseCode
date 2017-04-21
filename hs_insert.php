<?php
	$keys = array(array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j"),
			 	  array("k", "l", "m", "n", "o", "p", "q", "r", "s", "t"),
			 	  array("u", "v", "w", "x", "y", "z", "A", "B", "C", "D"),
			 	  array("E", "F", "G", "H", "I", "J", "K", "L", "M", "N"),
			 	  array("O", "P", "Q", "R", "S", "T", "U", "V", "W", "X"),
			 	  array("Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8"),
			 	  array("9", "0", "a", "b", "c", "d", "e", "f", "g", "h"));

	$game = $_GET['Game'];
	$name = $_GET['Name'];
	$ip = get_client_ip();
	$score = $_GET['Score'];
	
	echo($game);
	new_line();
	echo($name);
	new_line();
	echo($ip);
	new_line();
	echo($score);
	new_line();

	$decoded_score = decode_score($score, $keys);

	insert_into_db($game,$name,$ip,$decoded_score);

	function decode_score($score, $keys){
		$score_str = "";
		for($i = 0; $i < 7; $i++){
			$tmp_str = substr($score,$i,1);
			
			for($j=0; $j<10; $j++){
				$tmp_key = $keys[6 - $i][$j];
				if($tmp_key == $tmp_str){
					$score_str = $score_str. strval($j);
				}
			}
		}
		echo("Score decoded: ". (int)$score_str. "<br/>");
		return (int)$score_str;
		
	}

	function new_line(){
		echo("<br/>");
	}
	
	// Function to get the client IP address
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	function insert_into_db($game,$name,$ip,$score){
		$servername = "[SERVER_NAME]";
		$username = "[USER_NAME]";
		$password = "[PASSWORD]";
		$dbname = "[DATABASE_NAME]";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "INSERT INTO high_score (GameName, IP, PlayerName, Score)
		VALUES ('$game', '$ip', '$name', $score )";

		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	
	
?>