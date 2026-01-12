<?php
// https://getbootstrap.com/docs/5.3/forms/overview/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h1 class="text-center mb-4">Connexion</h1>
            <form action="authentif_connexion.php" method="post">
                <div class="mb-3">
                    <label for="mail" class="form-label">Mail</label>
                    <input type="email" id="mail" name="mail" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
