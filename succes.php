<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

include ('header.php');

?>

       <p> Lekker pik! </p>

       
      <?php include('footer.php') ?>