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

$result = mysqli_query($conn,"SELECT * FROM messaggio WHERE email = '".$_SESSION["email"]."' AND letto='0'");
if($result->num_rows>0){
  $notifica = $result->num_rows;
  echo '<div>'.$notifica.'</div>';
} else {
  $notifica=0;
  echo '<div>'.$notifica.'</div>';
}
?>
