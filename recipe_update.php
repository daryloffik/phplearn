<?php
session_start();


require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    var_dump('recipeUpdate');
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
    <title>Site de Recettes - Page de modification de recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/headerclassroom.php'); ?>
        <h1>Modifier recette</h1>
        
        <form action="submit_recipe_update.php" method="POST" >
        <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']); ?>">
        </div>
            <div class="mb-3">
                <label for="updatedtitle" class="form-label">Nom de la recette</label>
                <input type="text" class="form-control" id="updatedtitle" name="updatedtitle" aria-describedby="title-help">
               
            </div>
            <div class="mb-3">
                <label for="updatedrecipe" class="form-label">Votre modification</label>
                <textarea class="form-control" placeholder="Apportez vos modifications" id="updatedrecipe" name="updatedrecipe"></textarea>
            </div>
            <div class="mb-3">
           
            <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
        <br />
    </div>
    <?php require_once(__DIR__ . '/footerclassroom.php'); ?>
</body>


</html>