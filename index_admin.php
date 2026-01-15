<?php
session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <p class="navbar-text mb-0">
                Bienvenue <?php echo $_SESSION['utilisateur_nom']; ?>
            </p>
            <div class="justify-content-end">
                <a href="ticket_admin.php" class="btn btn-outline-primary me-2">Tickets</a>
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
        </div>
    </div>
</body>
</html>
