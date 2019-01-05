<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$current="";
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>CFU - Ordine inviato</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <style>
    h1,h3, p{text-align: center; color:white;}
    a{float:right;}
    .card{width: 450px;background: rgba(0,0,0,0.7);border-radius: 10px;
    -webkit-border-radius: 10px;-moz-border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    }
    </style>
</head>
</head>
<body>
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent">
  <div class="container">
    <h1>Stato dell'ordine</h1>
    <p>IL TUO ORDINE E' ANDATO A BUON FINE!</br> Riceverai un messaggio quando l'ordine partirà. Grazie per aver prenotato con CFU!</p>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
