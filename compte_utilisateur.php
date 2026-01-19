<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$requete = "SELECT id, nom, mail, etatcompte, roles FROM utilisateur";
$verification = $bdd->prepare($requete);
$verification->execute();
$listeutilisateur = $verification->fetchAll(PDO::FETCH_ASSOC);
$verification->closeCursor();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Admin</title>
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
        <?php foreach ($listeutilisateur as $utilisateur): ?>
            <div class="card mb-4" style="width:600px;">
                <div class="card-header">
                    <h5 class="fw-bold mb-2">
                        <?php echo $utilisateur['id']; ?>
                    </h5>
                    <div class="text-secondary">
                        Nom : <?php echo $utilisateur['nom']; ?>
                    </div>
                    <div class="text-secondary">
                        Mail : <?php echo $utilisateur['mail']; ?>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Etat du compte : <?php echo $utilisateur['etatcompte']; ?></h5>
                </div>
                <?php if ($utilisateur['etatcompte'] === 'inactif'): ?>
                    <form action="desactiver_compte.php" method="get" style="text-align:end; margin-top:10px;">
                        <button type="submit" class="btn btn-success mt-2">Activer le compte</button>
                        <input type="hidden" name="id_compte" value="<?php echo $utilisateur['id']; ?>">
                    </form>
                <?php else: ?>
                    <form action="desactiver_compte.php" method="get" style="text-align:end; margin-top:10px;">
                        <button type="submit" class="btn btn-danger mt-2">Désactiver le compte</button>
                        <input type="hidden" name="id_compte" value="<?php echo $utilisateur['id']; ?>">
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>