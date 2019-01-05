<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
// initializ shopping cart class
include 'carrello.php';
$current="carrello";
$carrello = new Cart;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>CFU - Visualizza Carrello</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <style>
      input[type="number"]{width: 70px;}
      h1,h3{text-align: center; color:white;}
      a{float:right;}
      .card{width: 700px;background: rgba(0,0,0,0.7);border-radius: 10px;
      -webkit-border-radius: 10px;-moz-border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);-moz-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
      -webkit-box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.13);
      }
      .table{background-color: rgba(255,255,255,65%);}
    </style>
    <script>

    function updateCartItem(obj,id){
        $.get("DBcarrello.php", {action:"updateCartItem", id:id, quantità:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Aggiornamento del carrello fallito, riprova.');
            }
        });
    }
    </script>
</head>
</head>
<body>
  <?php include 'menu.php'; ?>
  <div class="card card-sm center-msg-box transparent">
  <div class="container">
    <h1>Carrello</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Alimento</th>
            <th>Prezzo</th>
            <th>Quantità</th>
            <th>Subtotale</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($carrello->total_items() > 0){
            //get cart items from session
            $carrelloItems = $carrello->contents();
            foreach($carrelloItems as $alimento){
        ?>
        <tr>
            <td><?php echo $alimento["nome"]; ?></td>
            <td><?php echo '€'.$alimento["prezzo"].' euro'; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $alimento["quantità"]; ?>" onchange="updateCartItem(this, '<?php echo $alimento["rowid"]; ?>')"></td>
            <td><?php echo '€'.$alimento["subtotale"].' euro'; ?></td>
            <td>
                <a href="DBcarrello.php?action=removeCartItem&id=<?php echo $alimento["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro?')">Rimuovi</a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Il tuo carrelo è vuoto...</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
          <?php if(isset($_SESSION["id_ristorante"])){
            echo '<td><a href="ristorante.php" class="btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a></td>
            <td colspan="2"></td>';
          } else {
            echo '<td><a href="ricerca.php" class="btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a></td>
            <td colspan="2"></td>';
          }

            if($carrello->total_items() > 0){ ?>
            <td class="text-center"><strong>Totale <?php echo '€'.$carrello->total().' euro'; ?></strong></td>
              <?php if (isset($_SESSION["luogo"])){
                echo '<td><a href="checkout.php" class="btn btn-success btn-block">Checkout ></a></td>';
              } else {
                echo '<td><a href="sceltaluogo.php" class="btn btn-success btn-block">Checkout ></a></td>';
              }

           } ?>
        </tr>
    </tfoot>
    </table>
</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
