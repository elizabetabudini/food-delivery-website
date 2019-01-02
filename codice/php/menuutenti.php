
<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
if ( isset( $_SESSION['email'] ) ) {
  ?>

  <li class="nav-item">
    <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="profiloutente.php"<?php if($current == 'profiloutente') {echo 'id="current"';} ?>>Profilo <?php echo $_SESSION["nome"]; ?> </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messaggiutente.php"<?php if($current == 'messaggiutente') {echo 'id="current"';} ?>>Messaggi <span class="badge badge-primary">1</span>
  <span class="sr-only">unread messages</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="carrello.php"<?php if($current == 'carrello') {echo 'id="current"';} ?>>Carrello</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php"<?php if($current == 'logout') {echo 'id="current"';} ?>>Logout</a>
  </li>
 <?php
} else {
 ?>
 <li class="nav-item ">
   <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Home <span class="sr-only">(current)</span></a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="accedi.php" <?php if($current == 'accedi') {echo 'id="current"';} ?>>Accedi</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="signinutente.php"<?php if($current == 'signinutente') {echo 'id="current"';} ?>>Registrati</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="areafornitori.php"<?php if($current == 'areafornitori') {echo 'id="current"';} ?>>Area Fornitori</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="#"<?php if($current == 'contatti') {echo 'id="current"';} ?>>Contatti</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="accedi.php">Amministratore</a>
 </li>
<?php
}
?>
