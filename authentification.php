<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include 'connexionbdd.php';

$nom = $_POST['nom'];
$mail = $_POST['mail'];
$mdp = $_POST['mdp'];
$options = [
    'cost' => 12,
];

$mdp_hache = password_hash($mdp, PASSWORD_BCRYPT, $options);

$requete = 'SELECT mail FROM utilisateur WHERE mail = :mail';
$verification = $bdd->prepare($requete);
$verification->bindValue(':mail', $mail, PDO::PARAM_STR);
$verification->execute();
$connexion = $verification->fetchAll();
$verification->closeCursor();
var_dump($connexion);
if (empty($connexion)) {
    $requete = 'INSERT INTO utilisateur(nom, mail, mdp) VALUES (:nom, :mail, :mdp)';
    $enregistrements=$bdd->prepare($requete);
    $enregistrements->bindvalue(':nom', $nom, PDO::PARAM_STR);
    $enregistrements->bindvalue(':mail', $mail, PDO::PARAM_STR);
    $enregistrements->bindvalue(':mdp', $mdp_hache, PDO::PARAM_STR);
    $enregistrements->execute();
    header('Location:connexion.php');
} else {
    header('Location:connexion_deja_compte.php');
}

?>