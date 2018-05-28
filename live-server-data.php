<?php 
	
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "homedb";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Set the JSON header
header("Content-type: text/json");

//current time
$x = time() * 1000;


if(isset($_GET['ertek'])) {
	// http://localhost/live-server-data.php?ertek=30&ertek2=55 hívása
	$sql = "INSERT INTO temperature (date,temp,hum) VALUES (now(),('" . $_GET['ertek'] . "'),('" . $_GET['ertek2'] . "'))";
	$result = $conn->query($sql);
	$conn->close();
}
else{
	$sql = "SELECT id,temp,hum from temperature order by id desc limit 1";
	$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
			while($row = $result->fetch_assoc()) {
				$y = intval($row['temp']);
				$z = intval($row['hum']);
			}
		}
		else{
			$y = 0;
		}

	// Create a PHP array and echo it as JSON
	$ret = array($x, $y , $z);

	$conn->close();
	echo json_encode($ret);
}
?>