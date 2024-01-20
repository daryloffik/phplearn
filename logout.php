<?php

require_once(__DIR__ . '/functions.php');
?>

<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<?php
session_start();

if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    redirectToUrl('indexclassroom.php');
}
?>

