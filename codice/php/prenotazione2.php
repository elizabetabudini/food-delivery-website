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

  $stato= 0;
  $info = "";
  $totale = 0;
  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

  }else {
    $email = "not_logged_in";
  }
  $_POST["oraConsegna"]= "".$_POST['data']." ".$_POST['orario'].":00";
  $_SESSION["luogo"]=$_POST["luogo"];
  $_SESSION["data"]=$_POST["oraConsegna"];
  if(!isset($_SESSION["id_prenotazione"])){
    $stmt = $conn->prepare("INSERT INTO prenotazione (info_prenotazione,	email_cliente,	data_consegna,
                                        stato,	totale,	luogo_consegna) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $info, $email, $_POST["oraConsegna"], $stato, $totale, $_POST["luogo"]);
    $stmt->execute();
    $stmt->close();

    $stmt2 = $conn->prepare("SELECT id FROM prenotazione WHERE email_cliente = ?  AND data_consegna = ? AND luogo_consegna = ? LIMIT 1");
    $stmt2->bind_param("sss", $email, $_POST["oraConsegna"], $_POST["luogo"]);
    $stmt2->execute();
    /* bind result variables */
     $stmt2->bind_result($id);
     /* fetch value */
     $stmt2->fetch();
    $_SESSION["id_prenotazione"] = $id;
    $stmt2->close();
    $conn->close();
  } else {
    $stmt3 = $conn->prepare("UPDATE prenotazione SET data_consegna=?, stato=?, luogo_consegna=? WHERE id=?");
    $stmt3->bind_param("ssss",$_POST["oraConsegna"], $stato, $_POST["luogo"],$_SESSION["id_prenotazione"] );
    $_SESSION["luogo"]=$_POST["luogo"];
    $stmt3->execute();
    $stmt3->close();
    $conn->close();

  }
  header("Location: checkout.php");

  ?>
