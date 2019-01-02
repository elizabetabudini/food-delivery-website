
<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="areafornitori.php"<?php if($current == 'areafornitori') {echo 'id="current"';} ?>>Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="profilofornitore.php"<?php if($current == 'profilofornitore') {echo 'id="current"';} ?>>Profilo <?php echo $_SESSION["nome"]; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messaggifornitore.php"<?php if($current == 'messaggifornitore') {echo 'id="current"';} ?>>Messaggi <span class="badge badge-primary">1</span>
  <span class="sr-only">unread messages</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Listino</a>
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
 <li class="nav-item">
   <a class="nav-link" href="areafornitori.php"<?php if($current == 'areafornitori') {echo 'id="current"';} ?>>Home </a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="accedi.php"<?php if($current == 'accedi') {echo 'id="current"';} ?>>Accedi</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="signinfornitore.php"<?php if($current == 'signinfornitore') {echo 'id="current"';} ?>>Registrati</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Area Clienti</a>
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
