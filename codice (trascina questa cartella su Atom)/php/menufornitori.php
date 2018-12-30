
<?php
$thisPage="About";
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="homeclienti.php">Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Profilo <?php echo $_SESSION["nome"]; ?></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Listino</a>
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
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>
 <?php
} else {
 ?>
 <li class="nav-item active">
   <a class="nav-link" href="areafornitori.php">Home <span class="sr-only">(current)</span></a>
 </li>
 <li class="nav-item">
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
