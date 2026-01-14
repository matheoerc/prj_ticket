<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    <title>Creation Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-3 mb-2 bg-info text-dark">
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid justify-content-end">
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
    </nav>
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh; padding-top: 70px;">
        <div class="card shadow p-4" style="width: 200%; max-width: 800px; height:550px; font-size: 30px">
            <div class="card-body">
                <h1 class="text-center mb-4">Créer un ticket</h1>
                <form action="envoieticketbdd.php" method="post">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="descri" class="form-label">Description</label>
                        <textarea id="descri" name="descri" class="form-control" required></textarea>
                    </div>
                    <div class="d-grid" style="padding-top:40px; font-size: 35px">
                        <button type="submit" class="btn btn-primary">Envoyer le ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
