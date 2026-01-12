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
    <title>Créer un ticket</title>
</head>
<body>
    <h2>Créer un ticket</h2>
    <form action="envoieticketbdd.php" method="POST" >
        <label for="titre">Titre</label><br>
        <input type="text" name="titre" required><br><br>
        <label for="descri">Description</label><br>
        <textarea id="descri"name="descri" required></textarea><br><br>
        <button type="submit">Créer le ticket</button>
    </form>
</body>
</html>
