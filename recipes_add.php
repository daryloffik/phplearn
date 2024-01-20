<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page dajout de recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <?php require_once(__DIR__ . '/headerclassroom.php'); ?>
        <h1>Contactez nous</h1>
        <form action="submit_recipe.php" method="POST" >
            <div class="mb-3">
                <label for="title" class="form-label">Email</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">
               
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Votre recette</label>
                <textarea class="form-control" placeholder="Exprimez vous" id="recipe" name="recipe"></textarea>
            </div>
            <div class="mb-3">
            <label for="author" class="form-label">Votre nom</label>
                <input type="text" class="form-control" id="author" name="author" aria-describedby="author-help">
               
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br />
    </div>
    <?php require_once(__DIR__ . '/footerclassroom.php'); ?>
</body>


</html>