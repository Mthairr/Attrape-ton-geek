<?php

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des visiteurs de <?php echo htmlspecialchars($username_connecte); ?></title>
    <link rel="stylesheet" href="css/profil.css">
</head>

<body>
<h1>Liste des visiteurs de <?php session_start(); 
echo htmlspecialchars($_SESSION['username']); ?></h1>
<ul>
    <?php 

    if (count($_COOKIE) > 0) {
        if (empty($_SESSION["name"])) {
            header('Location: php/page3.php');
        }
    }else {
        header('Location: index.php');
    }

    $username_connecte = $_SESSION['username'];
    $chemin_fichier_amis = 'donnee/visites.txt';
    $visites = [];

    if (file_exists($chemin_fichier_amis)) {
        $lignes = file($chemin_fichier_amis, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lignes as $ligne) {
            $champs = explode(';', $ligne);
            if ($champs[0] === $username_connecte) {
                for($i=1;$i<count($champs);$i++){
                    $visites[$i-1] = $champs[$i];
                }
            }
        }
    } else {
        echo "Le fichier des visites n'existe pas.";
        exit;
    }
        for($i=0;$i<count($visites);$i++){
            echo '<li>'. htmlspecialchars($visites[$i]) .'</li>';
        }

        
    ?>
</ul>
<a href="Bienvenue.php">Retour au profil</a>
</body>

</html>