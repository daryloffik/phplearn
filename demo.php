<?php 

$note = [10,20,13];

$moyenne =sum($note)/count;

$etudiant = [
    'nom' => 'Doe',
    'prenom' => "Akiil",
    'notes' => [10,20]

];

$etudiant['notes'][] = 16;


echo 'Bonjour'.' '.$etudiant['nom']. ' ' . $etudiant['prenom'].' '.$etudiant['notes'][2];

?>