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
      .container{padding: 50px; color: #dee2e6;}
    .table{width: 65%;float: left; background-color: rgba(0,0,0, 50%);}
      input[type="number"]{width: 70px;}
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
<div class="container align">
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
          <?php if(isset($_SESSION("id_ristorante"))){
            echo '<td><a href="ristorante.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a></td>
            <td colspan="2"></td>'
          } else {
            echo '<td><a href="ricerca.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a></td>
            <td colspan="2"></td>'
          }

            <?php if($carrello->total_items() > 0){ ?>
            <td class="text-center"><strong>Totale <?php echo '€'.$carrello->total().' euro'; ?></strong></td>
            <td><a href="checkout.php" class="btn btn-success btn-block">Checkout ></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity=
"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
