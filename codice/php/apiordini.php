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
    $stmt5 = $conn->prepare("SELECT email_cliente FROM prenotazione WHERE id=?");
    if($stmt5!=false){
      $stmt5->bind_param("s", $id);
      $stmt5->execute();
      $result = $stmt5->get_result();
      $email = $result->fetch_object();
      $email=$email->email_cliente;
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
      $mess= "L'ordine ".$id." è stato evaso!";
      $data= date('Y-m-d-h-m');
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
      $mess= "L'ordine ".$id." non è stato accettato, riprova più tardi!";
      $data= date('Y-m-d-h-m');
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