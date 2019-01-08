<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
// initialize shopping cart class
include 'carrello.php';
$cart = new Cart;
$current="";
// include database configuration file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cfu";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
  if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
    $productID = $_REQUEST['id'];
    if(!isset($_SESSION["id_prenotazione"])){
      $data= date('Y-m-d H-i-s');
      $stato= 0;
      $info = "";
      $totale = 0;
      if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];

      }else {
        $email = "not_logged_in";
      }
      $luogo= "aula 2.1";
      $stmt = $db->prepare("INSERT INTO prenotazione (info_prenotazione,	email_cliente,	data_consegna,
                                          stato,	totale,	luogo_consegna) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("ssssss", $info, $email, $data, $stato, $totale, $luogo);
      $stmt->execute();
      $stmt->close();

      $stmt2 = $db->prepare("SELECT id FROM prenotazione WHERE email_cliente = ?  AND data_consegna = ? AND luogo_consegna = ? LIMIT 1");
      $stmt2->bind_param("sss", $email, $data, $_POST["luogo"]);
      $stmt2->execute();
      /* bind result variables */
      $stmt2->bind_result($id);
       /* fetch value */
      $stmt2->fetch();
      $_SESSION["id_prenotazione"] = $id;
      $stmt2->close();
    }

    // get product details
    $query = $db->query("SELECT * FROM alimento WHERE id = ".$productID);
    $row = $query->fetch_assoc();
    $itemData = array(
      'id' => $row['id'],
      'nome' => $row['nome'],
      'prezzo' => $row['prezzo'],
      'quantità' => 1
    );

    $stmt4 = $db->prepare("INSERT INTO carrello (id_prenotazione, id_alimento, quantita) VALUES (?,?,?)");
      if($stmt4!=false){
        $quantità="1";
        $stmt4->bind_param("sss", $_SESSION["id_prenotazione"], $row['id'], $quantità);
        $insertOrder=$stmt4->execute();
        $stmt4->close();
      } else {
        echo 'Bad Programmatore Exception: la query non è andata a buon fine </br>';
      }

    $insertItem = $cart->insert($itemData);
    $redirectLoc = $insertItem?'visualizzaCarrello.php':'ristorante.php';
    header("Location: ".$redirectLoc);
  }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
    $itemData = array(
      'rowid' => $_REQUEST['id'],
      'quantità' => $_REQUEST['quantità']
    );

    $item=$cart->get_item($_REQUEST['id']);

    $stmt4 = $db->prepare("UPDATE carrello SET quantita=? WHERE id_prenotazione=? AND id_alimento=?");
    $_SESSION['quantità']=$_REQUEST['quantità'];
    $_SESSION['id']=$item['id'];
      if($stmt4!=false){
        $stmt4->bind_param("sss", $_REQUEST['quantità'], $_SESSION['id_prenotazione'], $item['id']);
        $stmt4->execute();
        $stmt4->close();
      } else {
        echo 'Bad Programmatore Exception: la query non è andata a buon fine </br>';
      }

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
       luogo_consegna=? WHERE id=?");
      if($stmt4!=false){
        $email=$_SESSION["email"];
        $totale= $cart->total();
        $stato="0";
        $stmt4->bind_param("ssssss", $email, $_SESSION["id_ristorante"], $totale, $stato,
         $_SESSION["luogo"],  $_SESSION["id_prenotazione"]);
        $insertOrder=$stmt4->execute();
        $stmt4->close();
      } else {
        echo 'Bad Programmatore Exception: la query non è andata a buon fine </br>';
      }

      if($insertOrder){
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
        $data= date('Y-m-d H-i');
        $letto="0";
        $stmt5 = $db->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
        if($stmt5!=false){
          $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
          $stmt5->execute();
          $stmt5->close();
        } else {
          $errors .= "Bad Programmatore Exception: la query non è andata a buon fine</br>";
        }
        $to = "cesenafooduniversity@gmail.com";
        $headers = "From: cesenafooduniversity@gmail.com" . "\r\n";
        $subject = "Evasione ordine n. ".$_SESSION['id_prenotazione']."di ".$email->email_proprietario;
        $body = "L'ordine ".$_SESSION['id_prenotazione']." attende di essere evaso. Accedi alla pagina Strumenti
        Ignora questo messaggio se non ti riguarda. CFU Team" . "\r\n";
        mail($to, $subject, $body, $headers);

        $stmt5 = $db->prepare("SELECT * FROM prenotazione WHERE id=?");
        if($stmt5!=false){
          $stmt5->bind_param("s", $_SESSION["id_prenotazione"]);
          $stmt5->execute();
          $result = $stmt5->get_result();
          $prenotazione = $result->fetch_object();
          $email=$prenotazione->email_cliente;
          $oraConsegna=$prenotazione->data_consegna;
          $luogo=$prenotazione->luogo_consegna;
          $stmt5->close();
        }
        $mess= "L'ordine id=".$_SESSION['id_prenotazione']." verrà spedito presso ".$luogo." alle ".$oraConsegna."";
        $data= date('Y-m-d H-i-s');
        $letto="0";
        $stmt5 = $db->prepare("INSERT INTO messaggio (testo, email, data, letto) VALUES (?, ?, ?, ?)");
        if($stmt5!=false){
          $stmt5->bind_param("ssss", $mess, $email, $data, $letto);
          $stmt5->execute();
          $stmt5->close();
        } else {
          $errors .= "Bad Programmatore Exception: la query non è andata a buon fine</br>";
        }
        $to = "cesenafooduniversity@gmail.com";
        $headers = "From: cesenafooduniversity@gmail.com" . "\r\n";
        $subject = "Il tuo ordine è stato accettato! CFU";
        $body = "Grazie per aver utilizzato il nostro servizio!
        L'ordine id=".$_SESSION['id_prenotazione']." verrà spedito presso ".$luogo." dell'Università di Cesena alle ".$oraConsegna."
        Ignora questo messaggio se non ti riguarda. CFU Team" . "\r\n";
        mail($to, $subject, $body, $headers);

        $cart->destroy();
        if(isset($_SESSION["data"])){
          unset($_SESSION["data"]);
        }
        if(isset($_SESSION["luogo"])){
          unset($_SESSION["luogo"]);
        }
        if(isset($_SESSION["id_prenotazione"])){
          unset($_SESSION["id_prenotazione"]);
        }
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
