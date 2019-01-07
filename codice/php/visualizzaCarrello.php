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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="./../css/bootstrap.min.css">
  <link href="./../css/full.css" rel="stylesheet">
  <link href="./../css/menubar.css" rel="stylesheet">
  <link href="./../css/navigation.css" rel="stylesheet">
  <link href="./../css/footer.css" rel="stylesheet">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
  input[type="number"]{width: 70px;}
  h1,h3, p{text-align: center; color:white;}
  .right{float:right;  margin-bottom: 1%}
  .left{float:left;  margin-bottom: 1%}
  .card{width: 700px;background: rgba(0,0,0,0.7);}
  .table{background-color: rgba(255,255,255,65%);}
  .nores{color:black;}
  .tot{background-color: #28a745; color:white; margin-top: 1%; margin-bottom: 1%;}
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
    <h1>Carrello</h1>

    <div class="container mobile">
      <?php
      if($carrello->total_items() > 0){

      if(!isset($_SESSION["luogo"]) || !isset($_SESSION["data"])){
        echo '<a href="sceltaluogo.php" class="right btn btn-success ">Checkout ></a>';
      } else{
        echo '<a href="checkout.php" class="right btn btn-success ">Checkout ></a>';
      }
    }

     if(isset($_SESSION["id_ristorante"])){
      echo '<a href="ristorante.php" class="left btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a>';
    } else {
      echo '<a href="ricerca.php" class="left btn btn-success"><i class="glyphicon glyphicon-menu-left"></i> < Aggiungi prodotti</a>';
    }?>


      <div class="table-responsive table-striped table-light carrello">
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
                  <a href="DBcarrello.php?action=removeCartItem&id=<?php echo $alimento["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro?')">X</a>
                </td>
              </tr>
            <?php } }else{ ?>
              <tr><td colspan="5"><p class="nores">Il tuo carrelo è vuoto...</p></td>
              <?php } ?>
            </tr>
          </tbody>
        </table>
</div>
          <?php
          if($carrello->total_items() > 0){ ?>
            <div class="container mobile tot"style="padding: .75rem;">
                <div class="text-center"><strong>Totale <?php echo '€'.$carrello->total().' euro'; ?></strong></div>
            </div>


            <?php } ?>
          </div>

          </div>
        <?php include 'footer.php'; ?>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./../js/messaggi.js"></script>
      </body>
      </html>
