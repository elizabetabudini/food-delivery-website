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

	switch ($_GET["request"]) {
		case "num_pages_users":
			$stmt = $conn->prepare("SELECT COUNT(*) AS num_utenti FROM persona");
			$stmt->execute();

			$stmt->bind_result($num_users);
			$stmt->fetch();

			$num_pages_users = ceil($num_users / $rows_per_page);
			$output = array("num_pages_users" => $num_pages_users);
			print json_encode($output);
			break;

		case "users":
			$page = 0;
			if(isset($_GET["page"])){
				$page = $_GET["page"];
			}

			$start_row = $page * $rows_per_page;

			$stmt = $conn->prepare("SELECT * FROM persona LIMIT ?, ?");
			$stmt->bind_param("ii", $start_row, $rows_per_page);
			$stmt->execute();

			$result = $stmt->get_result();

			$output = array();
			while($row = $result->fetch_assoc()) {
				$output[] = $row;
			}
			$stmt->close();
			print json_encode($output);
			break;
	}
}
?>
