<?php
//Dichiarazione variabili per server
$servername="localhost";
$username ="root";
$password ="";
$database = "progetto";

if(isset($_POST["nome"]) and isset($_POST["cognome"]) and isset($_POST["email"]) and isset($_POST["password"])){
  //preparazione query
  $query_sql="INSERT INTO `clienti` (`nome`, `cognome`, `email`, `password`) VALUES ('".$_POST['nome']."', '"
                                                                               .$_POST['cognome']."', '"
                                                                               .$_POST['email']."', '"
                                                                               .$_POST['password']."')";
  //connessione al db
  $conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }
  //Invio query
  if ($conn->query($query_sql) === TRUE) {
      echo "Un nuovo record è stato creato con successo";
  } else {
      echo "Errore: " . $query_sql . "<br>" . $conn->error;
  }
  //Chiusura connessione con db
  $conn->close();
}
 ?>
