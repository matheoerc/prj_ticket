<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$requete = "SELECT titre, description FROM ticket WHERE user_id = :user_id";
$verification = $bdd->prepare($requete);
$verification->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$verification->execute();
$listeticket = $verification->fetch(PDO::FETCH_ASSOC);
$verification->closeCursor();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <p class="navbar-text mb-0">
                Bienvenue <?php echo $_SESSION['utilisateur_nom']; ?>
            </p>
            <div class="justify-content-end">
                <a class="btn btn-outline-primary me-2" href="
                    <?php
                        if ($_SESSION['roles'] === 'administrateur') {
                            echo "/projet_ticket/index_admin.php";
                        } else {
                            echo "/projet_ticket/index_utilisateur.php";
                        }
                    ?>
                ">Accueil</a>
                <a href="creation_ticket.php" class="btn btn-outline-primary me-2">Créer un ticket</a>
                <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
            </div>
        </div>
    </nav>
    <div class="card" style="margin-top: 100px; max-width: 600px; height: 325px;">
        <h5 class="card-header">Titre : <?php echo $listeticket['titre']; ?></h5>
        <div class="card-body">
            <h5 class="card-title">Description : <?php echo $listeticket['description']; ?></h5>
        </div>
    </div>
</body>
</html>