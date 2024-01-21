<!-- header.php -->


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="indexclassroom.php">Site de recettes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="indexclassroom.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contact.php">Contact</a>
                </li>
                <li>

<?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <form method="post" action="logout.php">
        <button type="submit" class="btn btn-primary" name="logout">Se déconnecter</button>
    </form>

    <?php endif ?>
</li>
<li class="nav-item">
                    <a class="nav-link" href="recipes_add.php">Ajouter recette</a>
                </li>
            </ul>
        </div>
       
    </div>
</nav>