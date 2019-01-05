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
    <link href="./../css/full.css" rel="stylesheet">
    <link href="./../css/menubar.css" rel="stylesheet">
    <link href="./../css/navigation.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      input[type="number"]{width: 70px;}
      h1,h3{text-align: center; color:white;}
      .right{float:right;}
      .left{float:left;}
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
  <div class="card card-sm center-msg-box transparent mobile">
    <div class="container mobile">
    <h1>Carrello</h1>
    <table class="table mobile">
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
                <a href="DBcarrello.php?action=removeCartItem&id=<?php echo $alimento["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro?')">X</a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Il tuo carrelo è vuoto...</p></td>
        <?php } ?>
         </tr>
    </tbody>
      <?php
            if($carrello->total_items() > 0){ ?>
              <tr>
            <td class="text-center"><strong>Totale <?php echo '€'.$carrello->total().' euro'; ?></strong></td>
            <tr>
              </table>
              <?php if (isset($_SESSION["luogo"])){
                echo '<a href="checkout.php" class="right btn btn-success ">Checkout ></a>';
              } else {
                echo '<a href="sceltaluogo.php" class="right btn btn-success ">Checkout ></a>';
              }

           } ?>

           <?php if(isset($_SESSION["id_ristorante"])){
             echo '<a href="ristorante.php" class="left btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a></td>
             <td colspan="2">';
           } else {
             echo '<a href="ricerca.php" class="left btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a></td>
             <td colspan="2">';
           }?>


</div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
