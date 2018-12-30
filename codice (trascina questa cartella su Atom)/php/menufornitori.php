
<?php
if (session_status() === PHP_SESSION_NONE){
  session_start();
}
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>
    <a class="nav-link" href="homeclienti.php">Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Profilo <?php echo $_SESSION["nome"]; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Listino</a>
  </li>
  <li class="nav-item"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>
    <a class="nav-link" href="homeclienti.php">Area Clienti</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Contatti</a>
  </li>
  <li class="nav-item"<?php if($current == 'accedi') {echo 'id="current"';} ?>>
    <a class="nav-link" href="accedi.php">Amministratore</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
 <?php
} else {
 ?>
 <li class="nav-item"<?php if($current == 'areafornitori') {echo " id=\"currentPage\"";} ?>>
   <a class="nav-link" href="homeclienti.php">Home </a>
 </li>
 <li class="nav-item"<?php if($current == 'accedi') {echo 'active';} ?>>
   <a class="nav-link" href="accedi.php">Accedi</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="signinfornitore.php">Registrati</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="homeclienti.php">Area Clienti</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="#">Contatti</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="accedi.php">Amministratore</a>
 </li>
<?php
}
?>
