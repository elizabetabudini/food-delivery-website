<?php
  if (session_status() === PHP_SESSION_NONE){
    session_start();
  }
  $_SESSION['fornitore']= "false";
  $_SESSION['utente']= "true";
  $_SESSION['admin']="false";
  $current= "prenotazione";

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "cfu";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $data = date("Y\-m\-d");
  $stato= 0;
  $info = "";
  $totale = 0;
  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

  }else {
    $email = "not_logged_in";
  }

  $stmt = $conn->prepare("INSERT INTO prenotazione (info_prenotazione,	email_cliente,	data,
                                      stato,	totale,	luogo_consegna) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $info, $email, $data, $stato, $totale, $_POST["luogo"]);
  $stmt->execute();
  $stmt->close();

  $stmt2 = $conn->prepare("SELECT id FROM prenotazione WHERE email_cliente = ?  AND data = ? AND luogo_consegna = ? LIMIT 1");
  $stmt2->bind_param("sss", $email, $data, $_POST["luogo"]);
  $stmt2->execute();

  /* bind result variables */
   $stmt2->bind_result($id);

   /* fetch value */
   $stmt2->fetch();
   echo $data;
   echo $id;

  $_SESSION["id_prenotazione"] = $id;
  header("Location: ricerca.php");
  $stmt2->close();
  $conn->close();
  ?>
