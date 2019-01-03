<?php
// initialize shopping cart class
include 'carrello.php';
$cart = new Cart;
$current="";
// include database configuration file
$servernome = "localhost";
$usernome = "root";
$password = "";
$dbnome = "cfu";

$db = new mysqli($servernome, $usernome, $password, $dbnome);

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
      var_dump($_REQUEST['id']);
        $productID = $_REQUEST['id'];
        // get product details
        $query = $db->query("SELECT * FROM alimento WHERE id = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['id'],
            'nome' => $row['nome'],
            'prezzo' => $row['prezzo'],
            'quantità' => 1
        );

        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'visualizzaCarrello.php':'ristorante.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'quantità' => $_REQUEST['quantità']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: visualizzaCarrello.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION["email"])){
        // insert order details into database
        $stmt4 = $db->prepare("UPDATE prenotazione SET email_cliente=?, id_ristorante=?, totale=?, stato=?,
          data=?, luogo_consegna=? WHERE id=?");
        if($stmt4!=false){
          $data= date('Y-m-d-H-m');
          $email=$_SESSION["email"];
          $totale= $cart->total();
          $stato="1";
          $stmt4->bind_param("sssssss", $email, $_SESSION["id_ristorante"], $totale, $stato,
          $data, $_SESSION["luogo"],  $_SESSION["id_prenotazione"]);
          $insertOrder=$stmt4->execute();
        } else {
        echo 'Bad Programmatore Exception: la query non è andata a buon fine </br>';
        }

        if($insertOrder){
            $orderID = $_SESSION["id_prenotazione"];
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $alimento){
                $sql .= "INSERT INTO alimenti_prenotati (id_prenotazione, id_alimento, quantità) VALUES ('".$orderID."', '".$alimento['id']."', '".$alimento['quantità']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);

            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: ristorante.php");
    }
}else{
    header("Location: ristorante.php");
}
