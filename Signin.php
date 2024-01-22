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
        <h1>Inscrivez vous</h1>
        <form action="submit_user.php" method="POST" >
            <div class="mb-3">
                <label for="UserName" class="form-label">Nom complet:</label>
                <input type="text" class="form-control" id="UserName" name="UserName" aria-describedby="title-help">
               
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
<div class="mb-3">
                <label for="UserAge" class="form-label">Age</label>
                <input type="text" class="form-control" id="UserAge" name="UserAge" aria-describedby="title-help">
               
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
            </div>
        

            
        </form>
        <br />
    </div>
    <?php require_once(__DIR__ . '/footerclassroom.php'); ?>
</body>


</html>