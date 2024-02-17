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
    if(!isset($postData['id']) 
    || !isset($postData['comment']) 
    || !isset($postData['number'])
    || empty($postData['id'])
    || trim($postData['id']) === ''
    || empty($postData['comment'])
    || trim($postData['comment']) === ''

    || empty($postData['number'])
    || trim($postData['number']) === ''
    
    
    ){
        var_dump('test');
        echo " identifiant,nom ou description invalide";

    }
    else{
        $checkIfExistsStatement = $mysqlClient->prepare('SELECT COUNT(*) as count FROM users WHERE user_id = :valueToCheck');
$checkIfExistsStatement->execute([
    'valueToCheck' => $_SESSION['LOGGED_USER']['user_id'],
]);

// Récupérer le nombre de résultats
$result = $checkIfExistsStatement->fetch(PDO::FETCH_ASSOC);

        if($result['count'] > 0){
            $checkStatement = $mysqlClient->prepare('SELECT full_name FROM users WHERE user_id = :valueToCheck');
            $checkStatement->execute([
                'valueToCheck' => $_SESSION['LOGGED_USER']['user_id'],
            ]);
            
            // Récupérer le nombre de résultats
            $newresult = $checkStatement->fetch(PDO::FETCH_ASSOC);
            
            $sqlQuery = 'INSERT INTO comments(user_id, recipe_id, comment ,review) VALUES (:user_id, :recipe_id, :comment, :review)';

            // Préparation
    $insertComment = $mysqlClient->prepare($sqlQuery);
    
    // Exécution ! La recette est maintenant en base de données
    $insertComment->execute([
        'user_id' =>  $_SESSION['LOGGED_USER']['user_id'],
        'recipe_id' => $postData['id'],
        'comment' => $postData['comment'],
        'review' => $postData['number'],
    ]) or die(print_r($mysqlClient->errorInfo()));
    
        }
        redirectToUrl('recipes_read.php?id=' . $postData['id']);


    }
}