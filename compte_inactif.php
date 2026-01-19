<?php
session_start();
if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket résolu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        echo '/projet_ticket/index_admin.php';
                    } else {
                        echo '/projet_ticket/index_utilisateur.php';
                    }
                ?>
            ">Accueil</a>
            <a href="ticket_utilisateur.php" class="btn btn-outline-primary me-2">Mes Tickets</a>
            <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </div>
    </div>
</nav>
<div class="d-flex align-items-center justify-content-center" style="height: 100vh; padding-top: 70px;">
    <div class="alert alert-warning p-5 text-center" style="max-width: 600px;">
        <h2 class="mb-3">Compte inactif</h2>
        <p class="fs-5">Un administrateur a desactiver votre compte, vous ne pouvez plus créer de tickets.</p>
        <a href="ticket_utilisateur.php" class="btn btn-primary mt-4">Retour à mes tickets</a>
    </div>
</div>
</body>
</html>
