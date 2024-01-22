<?php

// Récupération des variables à l'aide du client MySQL
$usersStatement = $mysqlClient->prepare('SELECT * FROM users');
$usersStatement->execute() or die(print_r($mysqlClient->errorInfo()));
$users = $usersStatement->fetchAll();

$recipesStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE is_enabled is TRUE');
$recipesStatement->execute() or die(print_r($mysqlClient->errorInfo()));
$recipes = $recipesStatement->fetchAll();