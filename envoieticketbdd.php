<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
}

include 'connexionbdd.php';


$titre = $_POST['titre'];
$descri = $_POST['descri'];
$priorite = $_POST['priorite'];

$requete = 'INSERT INTO `ticket`(`user_id`, `titre`, `description`, `priorite`) VALUES (:user_id, :titre, :descri, :priorite)';
$enregistrement = $bdd->prepare($requete);
$enregistrement->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$enregistrement->bindValue(':titre', $titre, PDO::PARAM_STR);
$enregistrement->bindValue(':descri', $descri, PDO::PARAM_STR);
$enregistrement->bindValue(':priorite', $priorite, PDO::PARAM_STR);
$enregistrement->execute();
$enregistrement->closeCursor();

header('Location: ticket_utilisateur.php');
?>