<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
if(!isset($_SESSION['email'])){
  $_SESSION['Redirect']= "checkout.php";
  header("Location: accedi.php");
}
$current="carrello";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// initializ shopping cart class
include 'carrello.php';
$cart = new Cart;

$stmt = $con->prepare("SELECT * FROM persona WHERE email = ?");
$stmt->bind_param('s', $_SESSION["email"]);
$stmt->execute();
$result = $stmt->get_result();
$utente  = $result->fetch_object();

if($cart->total_items() <= 0){
  header("Location: visualizzaCarrello.php");
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <title>CFU - Chekout</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  h1,h3, h4{text-align: center; color:white;}
  p{text-align: center; color:white;}
  .card{width: 900px; background-color: rgba(0,0,0, 0.7); margin:5% auto;}
  }
  .container{ background-color: rgba(0, 0, 0, 0.9);
  }
  .tot{background-color: #28a745; color:white; margin-top: 1%; margin-bottom: 1%;}
  .table{background-color: rgba(255,255,255,65%); margin-top: 1%}
  .footBtn{width: 95%;float: left;}
  .orderBtn {float: right;}
  </style>
</head>
<body>
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container  mobile">
      <h1>Anteprima dell'ordine</h1>
      <div class="table-responsive table-striped table-light">
      <table class="table">
          <tr>
            <th>Alimento</th>
            <th>Prezzo unitario</th>
            <th>Quantità</th>
            <th>Subtotale</th>
          </tr>

          <?php
          if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $alimento){
              ?>
              <tr>
                <td><?php echo $alimento["nome"]; ?></td>
                <td><?php echo $alimento["prezzo"].' €'; ?></td>
                <td><?php echo $alimento["quantità"]; ?></td>
                <td><?php echo $alimento["subtotale"].' €'; ?></td>
              </tr>
            <?php } }else{ ?>
              <tr><td colspan="4"><p>Non ci sono prodotti nel tuo carrello</p></td>
              <?php } ?>

              <tr>
              </tr>
          </table>
              <div class="container  mobile table"style="padding: .75rem;">
                <?php if($cart->total_items() > 0){ ?>
                  <div class="text-center tot"><strong>Totale <?php echo $cart->total().' €'; ?></strong></div>
                <?php } ?>


        </div>
        <div class="container  mobile tot"style="padding: .75rem;">
          <?php if($cart->total_items() > 0){ ?>
            <div class="text-center tot"><strong>Totale <?php echo $cart->total().' €'; ?></strong></div>
          <?php } ?>

        </div>

          <div>
          <h4>Dettagli di spedizione</h4>
            <p><?php echo $_SESSION['email']; ?></p>
            <p>Consegna: <?php echo $_SESSION['data']; ?></p>
            <p>Presso: <?php echo $_SESSION['luogo']; ?></p>
          </div>
            <a href="DBcarrello.php?action=placeOrder" class="btn btn-success orderBtn" >Invia ordine <i class="fa fa-check"></i></a>
            <a href="ristorante.php" class="btn btn-warning backbtn"><i class="fa fa-arrow-left"></i> Continua gli acquisti</a>
        </div>
      </div>
      <?php include 'footer.php'; ?>

      <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="./../js/messaggi.js"></script>
    </body>
    </html>
