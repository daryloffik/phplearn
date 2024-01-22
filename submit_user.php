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

if (isset($postData['email']) &&  isset($postData['password'])) {
    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)){
       echo "Email invalide.Veuillez réessayer";
    }
    else{
        if(!isset($postData['UserName']) 
        || !isset($postData['password']) 
        || empty($postData['UserName'])
        || trim($postData['UserName']) === ''
        || empty($postData['password'])
        || trim($postData['password']) === ''
       
        
        
        ){
            echo "nom d'utilisateur  ou mot de passe invalide";
    
        }
        else{
            $sqlQuery = 'INSERT INTO users(full_name, email, password, age) VALUES (:name, :email, :password, :age)';
    
            // Préparation
    $insertUser = $mysqlClient->prepare($sqlQuery);
    
    // Exécution ! La recette est maintenant en base de données
    $insertUser->execute([
        'name' => $postData['UserName'],
        'email' => $postData['email'],
        'password' => $postData['password'],
        'age' => (int)$postData['age'],

    ]) or die(print_r($mysqlClient->errorInfo()));
    
    redirectToUrl('indexclassroom.php');
    
        }
    }

}