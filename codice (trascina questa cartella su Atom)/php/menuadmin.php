
<?php
$thisPage="About";
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="homeclienti.php">Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">AMMINISTRATORE</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="logout" href="logout.php">Logout</a>
  </li>
 <?php
} else {
 ?>
 <li class="nav-item">
   <a class="nav-link" href="homeclienti.php">Home <span class="sr-only">(current)</span></a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="accedi.php">Accedi</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="signinutente.php">Registrati</a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="areafornitori.php">Area Fornitori</a>
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
