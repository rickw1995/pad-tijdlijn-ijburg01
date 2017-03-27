<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('classes/database.class.php');

$DB = Database::getInstance();

$titel = '';
$beschrijving = '';
$afbeeldingURL = '';
$jaar = '';
$element_id = '';

$velden = '';
$boolError2 = '';
$sql3 = "SELECT `id` , `aantal_elementen` FROM `tijdlijn` ORDER BY id DESC LIMIT 0, 1";
$last_id = $DB->_query($sql3);

if ($last_id->num_rows > 0) {
    while($row = $last_id->fetch_assoc()) {
        $last_id2 = $row["id"]; 
        $aantal_elementen3 = $row["aantal_elementen"];
    }
}

$sql4 = "SELECT * FROM `elementen` WHERE `tijdlijn_id` = ".$last_id2."";

$last_id3 = $DB->_query($sql4);

if (isset($_POST) && !empty($_POST)) {
 $boolError2 = false;
    for ($i = 0; $i < count($_POST['titel']); $i++){
    $boolError = false;

    if (!isset($_POST['titel'][$i]) || trim($_POST['titel'][$i]) == '') {
        $titel    = 'error';
       $boolError = true;
    }

    if (!isset($_POST['beschrijving'][$i]) || trim($_POST['beschrijving'][$i]) == '') {
        $beschrijving = 'error';
        $boolError = true;
    } 

    if (!isset($_POST['afbeeldingURL'][$i]) || trim($_POST['afbeeldingURL'][$i]) == '') {
    } 

    if (!isset($_POST['jaar'][$i]) || trim($_POST['jaar'][$i]) == '') {
        $jaar_start  = 'error';
        $boolError = true;
    } 

    if (
        !isset($_POST['element_id'][$i])
        || trim($_POST['element_id'][$i]) == ''
        || !preg_match('/^\d+$/', $_POST['element_id'][$i])
    ) {
        $element_id  = 'error';
        $boolError = true;
    } 


    if ($boolError === false) {
        $sql = "UPDATE `elementen`
                SET
                `titel` = '" . $_POST['titel'][$i] . "',
                `beschrijving` = '" . $_POST['beschrijving'][$i] . "',
                `afbeelding_url` = '" . $_POST['afbeeldingURL'][$i] . "',
                `jaar` = '" . $_POST['jaar'][$i] . "'
                WHERE `id` = ".$_POST['element_id'][$i].";
        ";
       
        if ($DB->_query($sql)) {
         $boolError2 = false;
        // exit;


        } else {
            $boolError2 = true;
         

        }

    } else {
        $velden = "Ff alles invullen he";
    } }if( $boolError2 === false) {
        $newURL = "succes.php";
            header('Location: '.$newURL);
           
    } else {
        header('Location: ?oops');
           exit;
    }} 
?> <?php
include ('header.php');

     if ($last_id3->num_rows > 0) {
        while($row2 = $last_id3->fetch_assoc()) {
            $last_id4 = $row2["id"]; 

        if (isset($_GET['oops'])) { 
        ?>
            <span class="error">
                Oeps, iets ging fout.
            </span>
    
        <?php 
    
        } else {
           
        ?>

       
        <form class="form-nieuws" method="post">

          <?php echo $last_id4; ?>

            <input id="titel2" class="<?= $titel ?> form-control" type="text" placeholder="Titel tijdlijn" name="titel[]" value="<?= isset($_POST['titel']) ? $_POST['titel'] : '' ?>">
            <br>
            <textarea id="beschrijving2" class="<?= $beschrijving ?> form-control" rows="3" placeholder="Beschrijving over tijdlijn" name="beschrijving[]" value="<?= isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '' ?>"></textarea>
            <br>
            <input id="afbeeldingURL2" class="<?= $afbeeldingURL ?> form-control" type="text" placeholder="URL voor afbeelding" name="afbeeldingURL[]" value="<?= isset($_POST['afbeeldingURL']) ? $_POST['afbeeldingURL'] : '' ?>">
            <br>            
            <input id="jaar" class="<?= $jaar ?> form-control" type="text" placeholder="Start jaar tijdlijn" name="jaar[]" value="<?= isset($_POST['jaar']) ? $_POST['jaar'] : '' ?>">
             <input id="element_id" class="<?= $element_id ?> form-control" type="text" placeholder="<?php echo $last_id4 ?>" name="element_id[]" value="<?= isset($_POST['element_id']) ? $_POST['element_id'] : '' ?>">
            <div class="foutlabel">
                <em class="<?= ($velden) ? 'error' : '' ?>"><?= ($velden) ? $velden : '' ?>
                </em>
            </div>
            </br>    

                     <?php } 

                     } ?> <div class="gabutton">
                <input type="submit" value="Creeer tijdlijn">
            </div>
            
     
        </form> 
      <?php } include('footer.php') ?>