<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek - Bienvenue</title>
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
    <link rel="stylesheet" href="css/search.css">
    <script>
        function rechercher() {
            var termeRecherche = document.getElementById('search').value;
            if (termeRecherche.length > 0) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'recherche.php', true); // envoyer la requête à recherche.php
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById('resultats').innerHTML = xhr.responseText;
                    }
                };
                xhr.send('search=' + encodeURIComponent(termeRecherche));
            } else {
                document.getElementById('resultats').innerHTML = ''; // Efface les résultats si la recherche est vide
            }
        }
    </script>

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
    <form method="post" action="php/page3.php">
        <button type="submit" name="log_out">Log out</button>
    </form>
    <?php
        if($_SESSION["admin"] == 1){
            echo '<button class="admin" type="submit" onclick="document.location.href=' . "'admin.php';" . '">Return admin mode</button>';
        }
    ?>
    <ul class="menu">
        <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
        <li><a class="active1" href="message.php">Message</a></li>
        <li><a class="active2" href="search.php">Recherche</a></li>
        <li><a class="active3" href="subscription.php">Abonnements</a></li>

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
    
</div>

</body>
</html>