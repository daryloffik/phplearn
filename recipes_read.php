<?php
session_start();


require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');



$getData = $_GET;
//var_dump(!isset($getData['id']), !is_numeric($getData['id']));
if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    var_dump('recipesRead');
    echo('Il faut un identifiant de recette pour la modifier.');
    return;
}
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';*/

$retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => (int)$getData['id'],
]);
$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);

$retrieveCommentStatement = $mysqlClient->prepare('SELECT u.full_name, c.comment,c.created_at,c.review
FROM recipes r
INNER JOIN comments c ON c.recipe_id = r.recipe_id
INNER JOIN users u ON u.user_id = c.user_id
WHERE r.recipe_id = :id
ORDER BY c.created_at DESC
');

$retrieveCommentStatement->execute([
    'id' => (int)$getData['id'],
] ) or die(print_r($mysqlClient->errorInfo()));

$comments = $retrieveCommentStatement->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($comments);
echo '</pre>';

$retrieveReviewStatement  = $mysqlClient->prepare('SELECT ROUND(AVG(c.review),1) as rating FROM recipes r LEFT JOIN comments c on r.recipe_id = c.recipe_id WHERE r.recipe_id = :id');
$retrieveReviewStatement->execute([
    'id' => (int)$getData['id'],
]);
$review = $retrieveReviewStatement->fetch(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($review);
echo '</pre>';



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
        <div class="row">
        <h1 class="col-md-6"> <?php echo($recipe['title']); ?></h1>
        <h1 class="col-md-6"> <?php echo($review['rating']); ?></h1>
        </div>
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informations</h5>
            <p class="card-text"><b>Recettes</b> : <?php echo($recipe['recipe']); ?></p>
            <p class="card-text"><b>Auteur</b> : <?php echo(strip_tags($recipe['author'])); ?></p>
            <i><?php echo displayAuthor($recipe['author'], $users); ?></i>   
        </div>
    </div>
    <!--Section Commentaires-->
   
    <?php if ($retrieveCommentStatement->rowCount() > 0) : ?>
        <div class=" my-3">
        <div class="card-body">
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <?php foreach($comments as $comment) : ?>
        <h5 class="card-title"> <?php echo($comment['full_name']) ?></h5>
        <p class="card-text"><?php echo($comment['comment']); ?></p>
        <p class="card-text"><?php echo($comment['review']); ?></p>
        <p class="card-text"><?php echo($comment['created_at']); ?></p>
        <?php endforeach  ?>
        <?php endif  ?>

        </div>  
        </div>
            <?php else :  ?>
                <h2>Aucun Commentaires</h2>
            <?php endif  ?>
             

    <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
        <?php require_once(__DIR__ . '/comments_add.php'); ?>
       
        <?php endif  ?>
</body>
</html>