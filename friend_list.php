<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username_connecte = $_SESSION['username'];
$chemin_fichier_amis = 'donnee/friends.txt';
$amis = [];

if (file_exists($chemin_fichier_amis)) {
    $lignes = file($chemin_fichier_amis, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lignes as $ligne) {
        $champs = explode(';', $ligne);
        if ($champs[0] === $username_connecte) {
            $amis[] = $champs[1];
        }
    }
} else {
    echo "Le fichier des amis n'existe pas.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des amis de <?php echo htmlspecialchars($username_connecte); ?></title>
    <link rel="stylesheet" href="css/profil.css">
</head>

<body>
<h1>Liste des amis de <?php echo htmlspecialchars($username_connecte); ?></h1>
<ul>
    <?php foreach ($amis as $ami) : ?>
        <li><?php echo htmlspecialchars($ami); ?></li>
    <?php endforeach; ?>
</ul>
<a href="Bienvenue.php">Retour au profil</a>
</body>

</html>