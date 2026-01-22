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

    $id_candidature = $_GET['id_candidature'];

    $requete = "SELECT user_id FROM candidature WHERE id = :id";
    $verification = $bdd->prepare($requete);
    $verification->bindValue(':id', $id_candidature, PDO::PARAM_INT);
    $verification->execute();
    $candidature_info = $verification->fetch(PDO::FETCH_ASSOC);

    $user_id = $candidature_info['user_id'];
    $requete2 = "UPDATE utilisateur SET roles = 'administrateur' WHERE id = :user_id";
    $verification2 = $bdd->prepare($requete2);
    $verification2->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $verification2->execute();

    $requete3 = "UPDATE candidature SET statut = 'acceptée' WHERE id = :id";
    $verification3 = $bdd->prepare($requete3);
    $verification3->bindValue(':id', $id_candidature, PDO::PARAM_INT);
    $verification3->execute();

    header('Location: index_admin.php');
    exit;