<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
}

include 'connexionbdd.php';

$commentaire = $_POST['commentaire'];
$ticket_id = $_POST['ticket_id'];

$requete = 'INSERT INTO `commentaire`(`ticket_id`, `commentaire`, `user_id`, `roles`) VALUES (:ticket_id, :commentaire, :user_id, :roles)';
$enregistrement = $bdd->prepare($requete);
$enregistrement->bindValue(':ticket_id', $ticket_id, PDO::PARAM_INT);
$enregistrement->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
$enregistrement->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$enregistrement->bindValue(':roles', $_SESSION['roles'], PDO::PARAM_STR);
$enregistrement->execute();
$enregistrement->closeCursor();

if ($_SESSION['roles'] === 'administrateur') {
    header("Location:/projet_ticket/ticket_admin.php");
} else {
    header("Location:/projet_ticket/ticket_utilisateur.php");
}

?>