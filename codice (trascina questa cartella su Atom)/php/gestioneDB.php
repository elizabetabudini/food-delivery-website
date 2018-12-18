<?php
//Dichiarazione variabili per server
$servername="localhost";
$username ="root";
$password ="";
$database = "progetto";
$psswduser = "";

if(isset($_POST["nome"]) and isset($_POST["cognome"]) and isset($_POST["email"]) and isset($_POST["password"])){
  //preparazione query
  $psswduser = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);
  $query_sql_insert="INSERT INTO `clienti` (`nome`, `cognome`, `email`, `password`) VALUES ('".$_POST['nome']."', '"
                                                                               .$_POST['cognome']."', '"
                                                                               .$_POST['email']."', '"
                                                                               .$psswduser."')";

  $query_sql_retrive= " SELECT `email` FROM `clienti` where `email` = '".$_POST['email']."'";
  //connessione al db
  $conn =new mysqli($servername, $username, $password, $database);
  //Check della connessione
  if ($conn->connect_errno) {
      echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  }
  if(mysqli_num_rows($conn->query($query_sql_retrive)) == 0){
    //Invio query
    if ($conn->query($query_sql_insert) === TRUE) {
        echo "Benvenuto " .$_POST['nome']. ", la registrazione è avvenuta con successo!";
    } else {
        echo "Errore: " . $query_sql_insert . "<br>" . $conn->error;
    }
  }else{
    echo "<script>console.log( 'you are already registered' );</script>";
  }
    //Chiusura connessione con db
  $conn->close();
}
 ?>
