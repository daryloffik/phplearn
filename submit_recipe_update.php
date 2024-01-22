<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

/**
* On ne traite pas les super globales provenant de l'utilisateur directement,
* ces données doivent être testées et vérifiées.
*/
$postData = $_POST;

if (isset($_SESSION['LOGGED_USER'])) {
    if(!isset($postData['updatedtitle']) 
    || !isset($postData['updatedrecipe']) 
    || empty($postData['updatedtitle'])
    || trim($postData['updatedtitle']) === ''
    || empty($postData['updatedrecipe'])
    || trim($postData['updatedrecipe']) === ''
    
    ){
        echo "nom de recette ou description invalide";

    }
    else{
        $sqlQuery = 'UPDATE recipes SET title = :updatedtitle, recipe = :updatedrecipe WHERE recipe_id = :id';

        // Préparation
$updateRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$updateRecipe->execute([
    'updatedtitle' => $postData['updatedtitle'],
    'updatedrecipe' => $postData['updatedrecipe'],
    'id' => $postData['id'],

]) or die(print_r($mysqlClient->errorInfo()));

redirectToUrl('indexclassroom.php');

    }
}