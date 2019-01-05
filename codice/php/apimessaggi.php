<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cfu";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

  if(isset($_REQUEST["action"]) && !empty($_REQUEST["id"])){
    if($_REQUEST["action"]=="letto"){
      $id=$_REQUEST["id"];
      $letto="1";
      $stmt = $conn->prepare("UPDATE messaggio SET letto=? WHERE id= ?");
      $stmt->bind_param("ss", $letto, $id);
      $stmt->execute();
      $stmt->close();

    } elseif($_REQUEST["action"]=="elimina" && !empty($_REQUEST["id"])){
      $id=$_REQUEST["id"];
      $stmt = $conn->prepare("DELETE FROM messaggio WHERE id= ?");
      $stmt->bind_param("s", $id);
      $stmt->execute();
      $stmt->close();
    } elseif($_REQUEST["action"]=="nuovimessaggi"){
      if(isset($_SESSION["email"])){
        $result = mysqli_query($conn,"SELECT * FROM messaggio WHERE email = '".$_SESSION["email"]."' AND letto='0'");
    		if($result->num_rows==0){
    			$_SESSION["nuovimsg"]="false";
    		} else {
          $_SESSION["nuovimsg"]="true";
        }

      }

    }
  }
  $conn->close();

?>
