<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

if ($_SESSION['roles'] == 'utilisateur') {
        header('Location: index_utilisateur.php');
        exit;
    }

include 'connexionbdd.php';

$id_compte = $_GET['id_compte'];

$requete1 = "SELECT etatcompte FROM utilisateur WHERE id = :id";
$maj1 = $bdd->prepare($requete1);
$maj1->bindValue(':id', $id_compte, PDO::PARAM_INT);
$maj1->execute();
$etatcompte = $maj1->fetch(PDO::FETCH_ASSOC);

if($etatcompte['etatcompte'] == 'actif') {
    $requete2 = "UPDATE utilisateur SET etatcompte = 'inactif' WHERE id = :id";
    $maj2 = $bdd->prepare($requete2);
    $maj2->bindValue(':id', $id_compte, PDO::PARAM_INT);
    $maj2->execute();
    header('Location: compte_utilisateur.php');
} else {
    $requete3 = "UPDATE utilisateur SET etatcompte = 'actif' WHERE id = :id";
    $maj3 = $bdd->prepare($requete3);
    $maj3->bindValue(':id', $id_compte, PDO::PARAM_INT);
    $maj3->execute();
    header('Location: compte_utilisateur.php');
}






?>