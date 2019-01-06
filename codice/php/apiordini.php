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
  $id=$_REQUEST["id"];
  $stmt5 = $conn->prepare("SELECT * FROM prenotazione WHERE id=?");
  if($stmt5!=false){
    $stmt5->bind_param("s", $id);
    $stmt5->execute();
    $result = $stmt5->get_result();
    $result = $result->fetch_object();
    $email=$result->email_cliente;
    $luogo=$result->luogo_consegna;
    $stmt5->close();
  } else {
    $errors .= "Bad Programmatore Exception: la query non è andata a buon fine</br>";
  }

  if($_REQUEST["action"]=="evadi"){
    $stato="1";
    $stmt = $conn->prepare("UPDATE prenotazione SET stato=? WHERE id= ?");
    $stmt->bind_param("ss", $stato, $id);
    $stmt->execute();
    $stmt->close();

    /*Invio messaggio all'utente*/
    $mess= "L'ordine id=".$id." è stato evaso! Ci vediamo presso ".$luogo;
    $data= date('Y-m-d H-i-s');
    $letto="0";
    $stmt5 = $conn->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
    if($stmt5!=false){
      $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
      $stmt5->execute();
      $stmt5->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine</br>";
    }
    header("Location: evadiordini.php");

  } elseif($_REQUEST["action"]=="elimina" && !empty($_REQUEST["id"])){
    $id=$_REQUEST["id"];
    $stmt = $conn->prepare("DELETE FROM prenotazione WHERE id= ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
    /*Invio messaggio all'utente*/
    $mess= "L'ordine id=".$id." non è stato accettato, ci scusiamo per il disagio. Ti abbiamo rimborsato la spesa.";
    $data= date('Y-m-d H-i-s');
    $letto="0";
    $stmt5 = $conn->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
    if($stmt5!=false){
      $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
      $stmt5->execute();
      $stmt5->close();
    } else {
      $errors .= "Bad Programmatore Exception: la query non è andata a buon fine</br>";
    }
    header("Location: evadiordini.php");
  }
}
$conn->close();

?>
