<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (empty($_SESSION['utilisateur'])) {
    header('Location: accueil_choix.html');
    exit;
}

include 'connexionbdd.php';

$requete = "SELECT DISTINCT ticket.id, ticket.titre, ticket.description, ticket.user_id, ticket.statut, ticket.modifie, ticket.priorite, ticket.datecreation, utilisateur.nom  FROM ticket  LEFT JOIN utilisateur ON ticket.user_id = utilisateur.id  ORDER BY priorite DESC";
$verification = $bdd->prepare($requete);
$verification->execute();
$listeticket = $verification->fetchAll(PDO::FETCH_ASSOC);
$verification->closeCursor();

$requete2 = "SELECT commentaire.commentaire, commentaire.datecommentaire, commentaire.ticket_id, utilisateur.nom, utilisateur.roles FROM commentaire JOIN utilisateur ON commentaire.user_id = utilisateur.id ORDER BY commentaire.id_commentaire ASC";
$verification2 = $bdd->prepare($requete2);
$verification2->execute();
$listecommentaire = $verification2->fetchAll(PDO::FETCH_ASSOC);
$verification2->closeCursor();
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
    <?php if ((!empty($listeticket))): ?>
        <div class="container" style="max-width:600px; margin-top:120px;">
            <?php foreach ($listeticket as $ticket): ?>
                <div class="card mb-4" style="width:600px;">
                    <div class="card-header">
                        <h5 class="fw-bold mb-2">
                            <?php echo $ticket['titre']; ?>
                        </h5>
                        <div class="text-secondary">
                            Créé par : <?php echo $ticket['nom']; ?>
                        </div>
                        <div class="text-secondary">
                            Statut : <?php echo $ticket['statut']; ?>
                        </div>
                        <div class="text-secondary">
                            Priorite : <?php echo $ticket['priorite']; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $ticket['description']; ?></h5>
                    </div>
                    <?php if ($ticket['modifie'] === 'oui'): ?>
                        <div class="alert alert-info m-3" role="alert">
                            Le ticket a été modifié.
                        </div>
                    <?php endif; ?>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center gap-3 mb-3">
                            <form action="commentaire.php" method="get">
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                <button type="submit" class="btn btn-primary btn-sm" style="font-size: 17px;">Écrire un commentaire</button>
                            </form>
                            <form action="suppression_ticket.php" method="get">
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" style="font-size: 17px;">Supprimer</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-between text-muted">
                            <p>Ticket n°<?php echo $ticket['id']; ?></p>
                            <p>Créé le : <?php echo $ticket['datecreation']; ?></p>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <h5>Commentaires :</h5>
                        <?php
                        
                        if (empty($listecommentaire)) {
                            echo '<p class="text-muted">Aucun commentaire.</p>';
                        }
                        foreach ($listecommentaire as $com) {
                            if($com['roles'] == 'administrateur') {
                                $nomecrit = $com['nom'];
                                $role = 'Administrateur';
                            } else {
                                $nomecrit = $com['nom'];
                                $role = 'Utilisateur';
                            };
                            if ($com['ticket_id'] == $ticket['id']) {
                                echo '<div class="mb-2 p-2 border rounded bg-light d-flex flex-column justify-content-between" style="height: 80px;">';
                                echo "<div><strong>$nomecrit ($role): </strong>{$com['commentaire']}</div>";
                                echo '<div class="text-end text-muted" style="font-size: 0.8rem;">';
                                echo $com['datecommentaire'];
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="card mb-4" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;text-align:center;">
            <h5 class="card-header">Aucun ticket en cours !</h5>
            <div class="card-body">
                <h5 class="card-title">Personne n'a ouvert de ticket.</h5>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>