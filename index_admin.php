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
    <title>utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
    <form class="container-fluid justify-content-end">
        <a href="creation_ticket.php" class="btn btn-outline-primary me-2" target="_blank">Créer un ticket</a> 
        <a href="creation_ticket.php" class="btn btn-outline-danger me-2" target="_blank">Déconnexion</a> 
    </form>
    </nav>
    
</body>
</html>