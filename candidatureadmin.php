<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

if ($_SESSION['roles'] == 'utilisateur') {
        header('Location: index_utilisateur.php');
        exit;
    }

include 'connexionbdd.php';

$requete_candidature_sql = "SELECT candidature.id, candidature.message, candidature.statut, utilisateur.nom FROM candidature JOIN utilisateur ON candidature.user_id = utilisateur.id WHERE candidature.statut = 'En cours'";
$requete_candidature = $bdd->prepare($requete_candidature_sql);
$requete_candidature->execute();
$candidatures = $requete_candidature->fetchAll(PDO::FETCH_ASSOC);
$nb_candidature = count($candidatures);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des candidatures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <p class="navbar-text mb-0">
            Bienvenue <?php echo $_SESSION['utilisateur_nom']; ?>
        </p>
        <div class="justify-content-end">
            <a class="btn btn-outline-primary me-2" href="/projet_ticket/index_admin.php">Accueil</a>
            <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <h1 class="text-center mb-4">Candidatures en cours</h1>

    <?php if ($nb_candidature == 0): ?>
        <div class="alert alert-info text-center">Aucune candidature en cours.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($candidatures as $candidature): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $candidature['nom']; ?></h5>
                            <p class="card-text"><?php echo $candidature['message']; ?></p>
                            <div class="d-flex justify-content-between">
                                <form action="candidatureaccepter.php" method="get">
                                    <input type="hidden" name="id_candidature" value="<?php echo $candidature['id']; ?>">
                                    <button type="submit" class="btn btn-success">Accepter</button>
                                </form>
                                <form action="candidaturerefuser.php" method="get">
                                    <input type="hidden" name="id_candidature" value="<?php echo $candidature['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Refuser</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>