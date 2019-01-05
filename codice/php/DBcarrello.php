<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
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
    }elseif($_REQUEST['action'] == 'resetCart'){
      $cart->destroy();
      header("Location: ricerca.php");
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
          $stato="0";
          $stmt4->bind_param("sssssss", $email, $_SESSION["id_ristorante"], $totale, $stato,
          $data, $_SESSION["luogo"],  $_SESSION["id_prenotazione"]);
          $insertOrder=$stmt4->execute();
          $stmt4->close();
        } else {
        echo 'Bad Programmatore Exception: la query non è andata a buon fine </br>';
        }
        $stmt5 = $db->prepare("SELECT email_proprietario FROM ristorante WHERE id=?");
        if($stmt5!=false){
          $stmt5->bind_param("s", $_SESSION["id_ristorante"]);
          $stmt5->execute();
          $result = $stmt5->get_result();
      	  $email = $result->fetch_object();
          $email=$email->email_proprietario;
          $stmt5->close();

        }
        $mess= "L'ordine ".$_SESSION['id_prenotazione']." attende di essere evaso. Vai nei tuoi Strumenti";
        $data= date('Y-m-d-h-m');
        $letto="0";
        $stmt5 = $db->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
        if($stmt5!=false){
          $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
          $stmt5->execute();
          $stmt5->close();
        } else {
          $errors .= "Bad Programmatore Exception: la query non è andata a buon fine: 109 signinfornitore.php </br>";
        }

            if($insertOrder){
                $cart->destroy();
                header("Location: orderSuccess.php");
            }else{
                header("Location: checkout.php");
            }
        }else{

            header("Location: checkout.php");
        }
    }else{
        header("Location: ristorante.php");
    }