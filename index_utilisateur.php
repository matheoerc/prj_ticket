<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'connexionbdd.php';

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
}

$requete_total = "SELECT id FROM ticket WHERE user_id = :user_id";
$verification_total = $bdd->prepare($requete_total);
$verification_total->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$verification_total->execute();
$total_tickets = $verification_total->rowCount();
$verification_total->closeCursor();

$requete_resolu = "SELECT id FROM ticket WHERE user_id = :user_id AND statut = 'Resolu'";
$verification_resolu = $bdd->prepare($requete_resolu);
$verification_resolu->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
$verification_resolu->execute();
$tickets_resolus = $verification_resolu->rowCount();
$verification_resolu->closeCursor();

$tickets_non_resolus = $total_tickets - $tickets_resolus;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <p class="navbar-text mb-0">
                Bienvenue <?php echo $_SESSION['utilisateur_nom']; ?>
            </p>
            <div class="justify-content-end">
                <a href="profil.php" class="btn btn-outline-primary me-2">Mon profil</a>
                <a href="ticket_utilisateur.php" class="btn btn-outline-primary me-2">Mes tickets</a>
                <a href="liste_candidature.php" class="btn btn-outline-primary me-2">Mes candidatures</a>
                <a href="creation_ticket.php" class="btn btn-outline-primary me-2">Créer un ticket</a>
                <a href="candidature.php" class="btn btn-outline-primary me-2">Devenir admin</a>
                <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow">
                    <img src="cahier_charges.png" class="img-fluid" alt="Cahier des charges">
                    <div class="card-body">
                        <h5 class="card-title">Cahier des charges</h5>
                        <a href="cahier_charges.pdf" target="_blank" class="btn btn-outline-primary">Voir plus</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tickets totaux</h5>
                        <p class="display-4"><?php echo $total_tickets; ?></p>
                    </div>
                </div>
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-success">Tickets résolus</h5>
                        <p class="display-4 text-success"><?php echo $tickets_resolus; ?></p>
                    </div>
                </div>
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Tickets non résolus</h5>
                        <p class="display-4 text-danger"><?php echo $tickets_non_resolus; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
