<?php
// https://getbootstrap.com/docs/5.3/forms/overview/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h1 class="text-center mb-4">Inscription</h1>
            <form action="authentification.php" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Adresse email</label>
                    <input type="email" id="mail" name="mail" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>
                <div class="text-center mt-3">
                    <p class="text-muted">Déjà inscrit ?</p>
                    <a href="connexion.php" class="text-decoration-none fw-semibold" target="_blank">
                        Connectez-vous
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>



