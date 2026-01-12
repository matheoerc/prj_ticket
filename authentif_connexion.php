<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connexionbdd.php';

$mail = $_POST['mail'];
$mdp = $_POST['mdp'];

echo "$mdp<br>";


$requete = 'SELECT id, mail, mdp FROM utilisateur WHERE mail = :mail';
$verification = $bdd->prepare($requete);
$verification->bindValue(':mail', $mail, PDO::PARAM_STR);
$verification->execute();
$connexion = $verification->fetch(PDO::FETCH_ASSOC);
$verification->closeCursor();
$mdp_hache = $connexion['mdp'];
echo "$mdp_hache<br>";
var_dump($connexion);
var_dump(password_verify($mdp, $mdp_hache));

$requete2 = 'SELECT roles FROM utilisateur WHERE mail = :mail';
$verification2 = $bdd->prepare($requete2);
$verification2->bindValue(':mail', $mail, PDO::PARAM_STR);
$verification2->execute();
$connexion2 = $verification2->fetch(PDO::FETCH_ASSOC);
$verification2->closeCursor();

if (password_verify($mdp, $mdp_hache)) {
    if ($connexion2['roles'] === 'administrateur') {
        session_start();
        $_SESSION['utilisateur'] = $_POST['mail'];
        $_SESSION['id'] = $connexion['id'];
        $_SESSION['utilisateur_nom'] = $_POST['nom'];
        header('Location: index_admin.php');
    } else {
        session_start();
        $_SESSION['utilisateur'] = $_POST['mail'];
        $_SESSION['utilisateur_nom'] = $_POST['nom'];
         $_SESSION['id'] = $connexion['id'];
        header('Location: index_utilisateur.php');
    }
} else {
    header('Location:connexion_mdp_incorrect.php');
}

?>