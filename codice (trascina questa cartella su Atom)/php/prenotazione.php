<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$_SESSION['fornitore']= "false";
$_SESSION['utente']= "true";
$_SESSION['admin']="false";
$current= "homeclienti";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$_SESSION['data'] = date(c[,time()]);
$_SESSION['stato'] = 0;
$_SESSION['info'] = "";
$_SESSION['totale'] = 0;
if(isset($_SESSION['email'])){
$email = $_SESSION['email'];

}else {
  $email = "";
}$stmt = $conn->prepare("INSERT INTO prenotazione (info_prenotazione,	email_cliente,	data,
                                    stato,	totale,	luogo_consegna)
                                    VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $_SESSION['info'], $cognome, $_SESSION['data'], $_SESSION['stato'], $_SESSION['totale'], $_POST["luogo"]);
?>
