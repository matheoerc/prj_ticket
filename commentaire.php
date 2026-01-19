<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$ticket_id = $_GET['ticket_id'];

$requete = "SELECT id FROM ticket WHERE id = :ticket_id";
$enregistrement = $bdd->prepare($requete);
$enregistrement->bindValue(':ticket_id', $ticket_id, PDO::PARAM_INT);
$enregistrement->execute();
$ticket = $enregistrement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Ticket</title>
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
                <a href="ticket_utilisateur.php" class="btn btn-outline-primary me-2">Mes Tickets</a>
                <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
            </div>
        </div>
    </nav>
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh; padding-top: 70px;">
        <div class="card shadow p-4" style="width: 200%; max-width: 800px; height:550px; font-size: 30px">
            <div class="card-body">
                <h1 class="text-center mb-4">Modifier un ticket</h1>
                <form action="commentairebdd.php" method="post">
                    <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                    <div class="mb-3">
                        <label for="commentaire" class="form-label">Commentaire</label>
                        <textarea id="commentaire" name="commentaire" class="form-control"required></textarea>
                    </div>
                    <div class="d-grid" style="padding-top:40px; font-size: 35px">
                        <button type="submit" class="btn btn-primary">Envoyer le commentaire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
