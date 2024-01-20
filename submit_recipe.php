<?php
/**
* On ne traite pas les super globales provenant de l'utilisateur directement,
* ces données doivent être testées et vérifiées.
*/
$postData = $_POST;

if (isset($_SESSION['LOGGED_USER'])) {
    if(!isset($postData['title']) 
    || !isset($postData['recipe']) 
    || empty($postData['title'])
    || trim($postData['title']) === ''
    || empty($postData['recipe'])
    || trim($postData['recipe']) === ''
    
    
    ){
        echo "nom de recette ou description invalide";

    }
    else{
        $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';

        // Préparation
$insertRecipe = $mysqlClient->prepare($sqlQuery);

// Exécution ! La recette est maintenant en base de données
$insertRecipe->execute([
    'title' => 'Cassoulet',
    'recipe' => 'Etape 1 : Des flageolets ! Etape 2 : Euh ...',
    'author' => 'contributeur@exemple.com',
    'is_enabled' => 1, // 1 = true, 0 = false
]);

    }
}