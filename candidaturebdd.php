<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'connexionbdd.php';

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

if ($_SESSION['roles'] == 'utilisateur') {
        header('Location: index_utilisateur.php');
        exit;
    }

$verif_sql = "SELECT id FROM candidature WHERE user_id = :id";
$verif = $bdd->prepare($verif_sql);
$verif->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
$verif->execute();
$nb_candidature = $verif->rowCount();

if ($nb_candidature > 0) {
    header('Location: candidature.php');
    exit;
}


$insert_candidature = "INSERT INTO candidature (user_id, message) VALUES (:user_id, :message)";
$candidature = $bdd->prepare($insert_candidature);
$candidature->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$candidature->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
$candidature->execute();

header('Location: candidature.php');
exit;