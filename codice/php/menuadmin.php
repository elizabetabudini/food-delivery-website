
<?php
if ( isset( $_SESSION['email'] ) ) {
  ?>
  <li class="nav-item">
    <a class="nav-link" href="homeadmin.php"<?php if($current == 'homeadmin') {echo 'id="current"';} ?>>Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">AMMINISTRATORE</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="logout" href="logout.php"<?php if($current == 'logout') {echo 'id="current"';} ?>>Logout</a>
  </li>
 <?php
} else {
 ?>
 <li class="nav-item">
   <a class="nav-link" href="homeclienti.php"<?php if($current == 'homeclienti') {echo 'id="current"';} ?>>Home <span class="sr-only">(current)</span></a>
 </li>
 <li class="nav-item">
   <a class="nav-link" href="accedi.php"<?php if($current == 'accedi') {echo 'id="current"';} ?>>Accedi</a>
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
   <a class="nav-link" href="accedi.php"<?php if($current == 'accedi') {echo 'id="current"';} ?>>Amministratore</a>
 </li>
<?php
}
?>
