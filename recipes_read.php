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



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Contact reçu</title>
    <link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet"
>
</head>

<body>
    <div class="container">
        <?php require_once(__DIR__ . '/headerclassroom.php'); ?>
        <h1> <?php echo($recipe['title']); ?></h1>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations</h5>
            <p class="card-text"><b>Recettes</b> : <?php echo($recipe['recipe']); ?></p>
            <p class="card-text"><b>Auteur</b> : <?php echo(strip_tags($recipe['author'])); ?></p>
            <i><?php echo displayAuthor($recipe['author'], $users); ?></i>   
        </div>
    </div>
</body>
</html>