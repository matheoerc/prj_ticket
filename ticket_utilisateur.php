<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$requete = "SELECT id, titre, description, statut, datecreation FROM ticket WHERE user_id = :user_id";
$verification = $bdd->prepare($requete);
$verification->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$verification->execute();
$listeticket = $verification->fetchAll(PDO::FETCH_ASSOC);
$verification->closeCursor();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Utilisateur</title>
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
    <?php if ((!empty($listeticket))): ?>
        <div class="container" style="max-width:600px; margin-top:120px;">
            <?php foreach ($listeticket as $ticket): ?>
                <div class="card shadow mb-4" style="width:600px;">
                    <div class="card-header">
                        <h5 class="fw-bold mb-2">
                            <?php echo $ticket['titre']; ?>
                        </h5>
                        <div class="text-secondary">
                            Statut : <?php echo $ticket['statut']; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $ticket['description']; ?></h5>
                    </div>
                    <form action="maj_ticket.php" method="get" style="text-align:end; margin-top:10px;">
                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
                    </form>
                    <form action="suppression_ticket.php" method="get" style="text-align:end; margin-top:10px;">
                        <button type="submit" class="btn btn-danger mt-2" style="margin-bottom: 10px;">Supprimer</button>
                        <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                    </form>
                    <div class="card-footer text-muted d-flex justify-content-between">
                        <p>Ticket n°<?php echo $ticket['id']; ?></p>
                        <p>Créé le : <?php echo $ticket['datecreation']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="card mb-4" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;text-align:center;">
            <h5 class="card-header">Aucun ticket en cours !</h5>
            <div class="card-body">
                <h5 class="card-title">Si vous souhaitez en créer-un, vous pouvez cliquer ci dessous. On s'occupera de votre ticket le plus rapidement possible.</h5>
                <a href="creation_ticket.php" class="btn btn-primary" style="margin-top: 50px; margin-left: 400px;">Créer un ticket !</a>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>