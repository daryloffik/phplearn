<?php
function displayAuthor(string $authorEmail, array $users): string
{
    foreach ($users as $user) {
        if ($authorEmail === $user['email']) {
            return $user['full_name'] . '(' . $user['age'] . ' ans)';
        }
    }
    return 'Auteur inconnu';
}
function isValidRecipe(array $recipe): bool
{
    if (array_key_exists('is_enabled', $recipe)) {
        $isEnabled = $recipe['is_enabled'];
    } else {
        $isEnabled = false;
    }


    return $isEnabled;
}


function getRecipes(array $recipes): array
{
    $valid_recipes = [];
    foreach ($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $valid_recipes[] = $recipe;
        }
    }
    return $valid_recipes;
}

/*En utilisant la fonction  header("Location: {$url}")  , on indique au navigateur web qu'il doit charger une nouvelle page dont l'adresse est spécifiée par $url.

Ensuite,  exit()  est utilisé pour arrêter immédiatement le reste du code PHP. Cela garantit que la redirection s'effectue sans problème, sans que d'autres instructions perturbent ce processus.

En somme, la fonction  redirectToUrl  est utile pour envoyer vers une autre page web, par exemple après une connexion réussie, une action sur un formulaire ou toute autre situation où l'on souhaite que l'utilisateur soit redirigé vers une nouvelle page.*/
function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}