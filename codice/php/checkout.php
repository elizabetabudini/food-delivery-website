<?php
$current="";
$servernome = "localhost";
$usernome = "root";
$password = "";
$dbnome = "cfu";

$con = new mysqli($servernome, $usernome, $password, $dbnome);

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
    <style>
    .container{width: 100%; padding: 50px; color:#dee2e6;}
    .table{width: 65%;float: left; background-color: rgba(0,0,0, 50%);}
    .shipAddr{background-color: rgba(0,0,0, 50%); padding:10px; width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
    </style>
</head>
<body>
  <?php include 'menu.php'; ?>
<div class="container">
    <h1>Anteprima dell'ordine</h1>
    <table class="table ">
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
    <div class="shipAddr">
        <h4>Dettagli di spedizione</h4>
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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
