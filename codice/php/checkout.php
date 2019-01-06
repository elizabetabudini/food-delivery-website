<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
$current="carrello";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";
if(!isset($_SESSION['email'])){
  $_SESSION['Redirect']= "checkout.php";
  header('location:accedi.php');
}

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// initializ shopping cart class
include 'carrello.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
  header("Location: ristorante.php");
}
$stmt = $con->prepare("SELECT * FROM persona WHERE email = ?");
$stmt->bind_param('s', $_SESSION["email"]);
$stmt->execute();
$result = $stmt->get_result();
$utente  = $result->fetch_object();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <title>CFU - Chekout</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1,h3, h4{text-align: center; color:white;}
  p{text-align: center;}
  a{float:right;}
  .card{width: 700px;background: rgba(0,0,0,0.7);border-radius: 10px;
    -webkit-border-radius: 10px;-moz-border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
    -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
  }
  .table{background-color: rgba(255,255,255,65%);}
  .footBtn{width: 95%;float: left;}
  .orderBtn {float: right;}
  </style>
</head>
<body>
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container">
      <h1>Anteprima dell'ordine</h1>
      <table class="table mobile">
        <thead>
          <tr>
            <th>Alimento</th>
            <th>Prezzo</th>
            <th>Quantità</th>
            <th>Subtotale</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $alimento){
              ?>
              <tr>
                <td><?php echo $alimento["nome"]; ?></td>
                <td><?php echo '€'.$alimento["prezzo"].' euro'; ?></td>
                <td><?php echo $alimento["quantità"]; ?></td>
                <td><?php echo '€'.$alimento["subtotale"].' euro'; ?></td>
              </tr>
            <?php } }else{ ?>
              <tr><td colspan="4"><p>Non ci sono prodotti nel tuo carrello</p></td>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <?php if($cart->total_items() > 0){ ?>
                  <td class="text-center"><strong>Totale <?php echo '€'.$cart->total().' euro'; ?></strong></td>
                <?php } ?>
              </tr>
            </tfoot>
          </table>
          <h4>Dettagli di spedizione</h4>
          <div class="table">
            <p><?php echo $utente->nome; ?></p>
            <p><?php echo $utente->cognome; ?></p>
            <p><?php echo $utente->email; ?></p>
            <p><?php echo $_SESSION['luogo']; ?></p>
          </div>
          <div class="footBtn">
            <a href="ristorante.php" class="btn btn-warning"> < Continua gli acquisti</a>
            <a href="DBcarrello.php?action=placeOrder" class="btn btn-success orderBtn">Invia ordine > </a>
          </div>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="./../js/messaggi.js"></script>
    </body>
    </html>
