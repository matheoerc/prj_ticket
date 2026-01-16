<?php
session_start();
if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$ticket_id = $_POST['ticket_id'];
$titre = $_POST['titre'];
$descri = $_POST['descri'];
$priorite = $_POST['priorite'];

$requete = "UPDATE ticket SET titre = :titre, description = :descri, priorite = :priorite WHERE id = :id AND user_id = :user_id";
$maj = $bdd->prepare($requete);
$maj->bindValue(':titre', $titre, PDO::PARAM_STR);
$maj->bindValue(':descri', $descri, PDO::PARAM_STR);
$maj->bindValue(':priorite', $priorite, PDO::PARAM_STR);
$maj->bindValue(':id', $ticket_id, PDO::PARAM_INT);
$maj->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$maj->execute();

header('Location: ticket_utilisateur.php');

?>