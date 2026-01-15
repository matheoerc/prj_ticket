<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$id_ticket = $_GET['ticket_id'];

$suppr = "DELETE FROM ticket WHERE id = :id";
$suppression = $bdd->prepare($suppr);
$suppression->bindValue(':id', $id_ticket, PDO::PARAM_INT);
$suppression->execute();
$suppression->closeCursor();

if ($_SESSION['roles'] === 'administrateur') {
    header('Location: ticket_admin.php');
} else {
    header('Location: ticket_utilisateur.php');
}

?>