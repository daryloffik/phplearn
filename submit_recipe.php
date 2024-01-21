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
    if(!isset($postData['title']) 
    || !isset($postData['recipe']) 
    || !isset($postData['author']) 
    || empty($postData['title'])
    || trim($postData['title']) === ''
    || empty($postData['recipe'])
    || trim($postData['recipe']) === ''
    || empty($postData['author'])
    || trim($postData['author']) === ''
    
    
    ){
        echo "nom de recette ou description invalide";

    }
    else{
        $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';

        // Préparation
$insertRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'title' => $postData['title'],
    'recipe' => $postData['recipe'],
    'author' => $postData['author'],
    'is_enabled' => 1, // 1 = true, 0 = false
]);

redirectToUrl('indexclassroom.php');

    }
}