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

$id_ticket = $_GET['ticket_id'];

$statut = "UPDATE ticket SET statut = 'Resolu' WHERE id = :id";
$changement = $bdd->prepare($statut);
$changement->bindValue(':id', $id_ticket, PDO::PARAM_INT);
$changement->execute();
$changement->closeCursor();
header('Location: ticket_admin.php');


?>