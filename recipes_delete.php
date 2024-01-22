<?php
session_start();


require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('Il faut un identifiant de recette pour la modifier.');
    return;
}

$retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => (int)$getData['id'],
]);
$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['LOGGED_USER'])) {
        $sqlQuery = 'DELETE FROM recipes WHERE recipe_id=:id';

        // Préparation
$deletedRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$deletedRecipe->execute([
    
    'id' => $getData['id'],

]) or die(print_r($mysqlClient->errorInfo()));

redirectToUrl('indexclassroom.php');

    
}

?>
