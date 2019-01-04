<?php if (session_status() === PHP_SESSION_NONE){
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
if(isset($_POST['id_ristorante'])){
  $ristorante  = $_POST['id_ristorante'];
  $select_query = mysqli_query($conn,"SELECT nome FROM ristorante WHERE id = '$ristorante' ") or die(mysqli_error($conn));
  $row = mysqli_fetch_array($select_query);
  $_SESSION["nome_ristorante"]=$row["nome"];
  $_SESSION["id_ristorante"]=$ristorante;
}

$current="home";
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CFU - Home</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <style>
    .container{padding: 50px; background-color: rgba(255,255,255, 30%);}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    .caption{color:white;background-color: rgba(0,0,0, 60%); padding: 20px;margin: 10px;}
    .btn-success{
          float: right;
    }
    #torna {float: left; margin-left: 6%; margin-top: 1%;}
    #carrello {float: right; margin-right: 6%; margin-top: 1%;}
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
  <?php include 'menu.php'; ?>

  <!--<div class="card card-sm center-msg-box transparent ">
    <h3 class="title text-center">Elenco utenti</h3> -->
    <?php
    ?>
    <a href="DBcarrello.php?action=resetCart" id="torna" class="btn btn-success"> < Torna ai ristoranti</a>
    <a href="visualizzaCarrello.php" class="btn btn-success" id="carrello" title="View Cart"> Carrello > </a>
    <div class="container">
    <h1>Ecco cosa offre <?php echo $_SESSION["nome_ristorante"]?> </h1>

    <div id="products" class="row list-group">
        <?php
        //get rows query
        var_dump($_SESSION["id_ristorante"]);
        $stmt = $conn->prepare("SELECT nome, nome_menu, prezzo, id FROM alimento WHERE id_ristorante = ?");
        $stmt->bind_param('s', $_SESSION["id_ristorante"]);
        $stmt->execute();

        $query = $stmt->get_result();

        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
        ?>
        <div>
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="list-group-item-heading"><?php echo $row["nome"]; ?></h4>
                    <p class="list-group-item-text"><?php echo 'menu: '.$row["nome_menu"]; ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo '€'.$row["prezzo"].' euro'; ?></p>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="DBcarrello.php?action=addToCart&id=<?php echo $row["id"]; ?>">Aggiungi al carrello</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <p>Nessun prodotto trovato</p>
        <?php } ?>
    </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
	"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
