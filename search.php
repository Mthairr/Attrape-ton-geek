<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek - Bienvenue</title>
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
    <link rel="stylesheet" href="css/search.css">


</head>
<body>

<?php
    if(count($_COOKIE) > 0){
        session_start();
        if(empty($_SESSION["name"])){
            header('Location: php/page3.php');
        }
    }
    else{
        header('Location: index.php');
    }
?>

<nav class="navbar">
    <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
    <form method="post" action="php/page4.php">
        <button type="submit" name="log_out">Log out</button>
    </form>
    <ul class="menu">
        <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
        <li><a class="active1" href="message.php">Message</a></li>
        <li><a class="active2" href="search.php">Recherche</a></li>
    </ul>
</nav>
<div class="search" >
    <?php
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { // Afficher le formulaire uniquement si la requête n'est pas de type POST
    ?>
    <form onsubmit="return false;">
        <input type="text" id="search" placeholder="Rechercher un pseudo" onkeyup="rechercher()">
    </form>
    <div id="resultats">
        <!-- Contenu des résultats ici -->
    </div>
    <?php
    } // Fin de la condition pour afficher le formulaire
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
        // Récupérer le terme de recherche
        $termeRecherche = $_POST['search'];

        // Chemin vers le fichier texte
        $fichier = 'donnee/log.txt';

        // Vérifier si le fichier existe et si le terme de recherche n'est pas vide
        if (file_exists($fichier) && !empty($termeRecherche)) {
            // Lire le fichier ligne par ligne
            $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            // Initialiser un booléen pour vérifier si au moins un résultat a été trouvé
            $resultatTrouve = false;

            // Parcourir chaque ligne
            foreach ($lignes as $ligne) {
                // Ignorer l'en-tête (première ligne)
                if (strpos($ligne, 'pseudo|id|email') === false) {
                    // Séparer les champs par le délimiteur ';'
                    $champs = explode(';', $ligne);

                    // Récupérer le pseudo (premier champ)
                    $pseudo = $champs[0];

                    // Afficher le pseudo s'il correspond au terme de recherche
                    if (stripos($pseudo, $termeRecherche) === 0) {
                        echo htmlspecialchars($pseudo) . '<br>';
                        $resultatTrouve = true;
                    }
                }
            }

            // Si aucun résultat n'a été trouvé, afficher "Aucun résultat trouvé"
            if (!$resultatTrouve) {
                echo "Aucun résultat trouvé.";
            }
        } else {
            echo "Aucun résultat trouvé.";
        }
    }
    ?>
    
</div>
<script src="js/app.js"></script>
</body>
</html>