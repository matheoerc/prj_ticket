<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
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
            <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </div>
    </div>
</nav>
<div class="container" style="max-width:600px; margin-top:120px;">
    <div class="card shadow mb-4" style="width:600px;">
        <div class="card-header">
            <h5 class="fw-bold mb-0">Mon profil</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p class="fw-bold">Nom :</p>
                <div class="text-secondary">
                    <?php echo $_SESSION['utilisateur_nom']; ?>
                </div>
            </div>
            <div class="mb-3">
                <p class="fw-bold">Email :</p>
                <div class="text-secondary">
                    <?php echo $_SESSION['utilisateur']; ?>
                </div>
            </div>
            <div class="mb-3">
                <p class="fw-bold">ID utilisateur :</p>
                <div class="text-secondary">
                    <?php echo $_SESSION['id']; ?>
                </div>
            </div>
            <div class="mb-3">
                <p class="fw-bold">Rôle :</p>
                <div class="text-secondary">
                    <?php echo $_SESSION['roles']; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


