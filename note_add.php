
<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    var_dump('commentAdd');
    echo('Il faut un identifiant de recette pour la modifier.');
    return;
}

?>


<form action="submit_note.php" method="POST" >
        <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']); ?>">
        </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Votre Commentair</label>
                <textarea class="form-control" placeholder="Ecrivez un commentaire:" id="comment" name="comment"></textarea>
            </div>
            <div class="mb-3">
           
            <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>