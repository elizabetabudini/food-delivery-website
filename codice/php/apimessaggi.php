<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
header('Content-Type: application/json');
if(isset($_GET["request"]))
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cfu";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if ($_GET["request"]=="messages") {
			$page = 0;
			if(isset($_SESSION["email"])){
				$email = $_SESSION["email"];
			}
      $stmt = $conn->prepare("SELECT * FROM messaggio WHERE email= ?");
			$stmt->bind_param("s", $email);
			$stmt->execute();

			$result = $stmt->get_result();

			$output = array();
			while($row = $result->fetch_assoc()) {
				$output[] = $row;
			}
			$stmt->close();
			print json_encode($output);
	}
}
?>
