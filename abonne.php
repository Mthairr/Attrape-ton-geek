<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek - Bienvenue</title>
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
    <link rel="stylesheet" href="css/profil.css">
</head>
<body>
    <?php
    if (count($_COOKIE) > 0) {
        session_start();
        if (empty($_SESSION["name"])) {
            header('Location: php/page3.php');
        }
        else if(empty($_SESSION["abonnement"])) {
            header('Location: Bienvenue.php');
        }

    }
    else {
        header('Location: index.php');
    }
    ?>
    <nav class="navbar">
        <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo"
            onclick="index()">
        <form method="post" action="php/page3.php">
            <button type="submit" name="log_out">Log out</button>
        </form>
        <?php
        if ($_SESSION["admin"] == 1) {
            echo '<button class="admin" type="submit" onclick="document.location.href=' . "'admin.php';" . '">Return admin mode</button>';
            echo '<button class="admin" type="button" class="btn" onclick="ban();">Bannir utilisateur</button>';
        }
        ?>
        <ul class="menu">
            <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
            <li><a href="message.php">Message</a></li>
            <li><a href="search.php">Recherche</a></li>
            <li><a href="subscription.php">Abonnements</a></li>
        </ul>
    </nav>
    <div class="content">
        <h1>Votre profil</h1>
        <button type="submit" onclick="updateprofile()">Modifier votre profil ?</button>
    </div>
    <?php
    if (isset($_SESSION['username'])) {


        
        $fichier_visites = 'donnee/visites.txt';
        $username_connecte = $_SESSION['username'];
        
        $lignes2 = file($fichier_visites, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $nombre_visites=0;
        
        foreach ($lignes2 as $ligne2) {
            
            $champs2 = explode(';', $ligne2);
            if ($champs2[0] === $username_connecte) {
                $nombre_visites = count($champs2) - 1;

            }
        }
            
        $fichier_amis = 'donnee/friends.txt';
        $amis = [];
        if (file_exists($fichier_amis)) {
            $lignes3 = file($fichier_amis, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lignes3 as $ligne3) {
                $champ3s = explode(';', $ligne3);
                if ($champ3s[0] === $username_connecte) {
                    $amis[] = $champ3s[1];
                }
            }
        }



        
        $username_connecte = $_SESSION['username'];
        

        
        $dossierImages = 'img/';

        
        $fichier = 'donnee/log.txt';

        
        if (file_exists($fichier)) {
            
            $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lignes as $ligne) {
                
                $champs = explode(';', $ligne);
                
                if ($champs[0] === $username_connecte) {
                    
                    $cheminImage = $dossierImages . $username_connecte . '.png';
                    if (!file_exists($cheminImage)) {
                        $cheminImage = $dossierImages . $username_connecte . '.jpg';
                    }
                    if (!file_exists($cheminImage)) {
                        $cheminImage = $dossierImages . $username_connecte . '.jpeg';
                    }
                    
                    echo '<h2>Bienvenue, ' . htmlspecialchars($username_connecte) . '!</h2>';
                    if (file_exists($cheminImage)) {
                        echo '<img src="' . htmlspecialchars($cheminImage) . '" alt="Photo de profil" style="max-width: 150px; max-height: 150px; margin-right: 10px;">';
                    }
                    echo '<p><strong>Nom d\'utilisateur:</strong> ' . htmlspecialchars($champs[0]) . '</p>';
                    echo '<p><strong>Date de naissance:</strong> ' . htmlspecialchars($champs[2]) . '</p>';
                    echo '<p><strong>Genre:</strong> ' . htmlspecialchars($champs[3]) . '</p>';
                    echo '<p><strong>Email:</strong> ' . htmlspecialchars($champs[4]) . '</p>';
                    echo '<p><strong>Prénom:</strong> ' . htmlspecialchars($champs[5]) . '</p>';
                    echo '<p><strong>Nom:</strong> ' . htmlspecialchars($champs[6]) . '</p>';
                    echo '<p><strong>Adresse:</strong> ' . htmlspecialchars($champs[7]) . '</p>';
                    echo '<p><strong>Ville:</strong> ' . htmlspecialchars($champs[8]) . '</p>';
                    echo '<p><strong>Pays:</strong> ' . htmlspecialchars($champs[9]) . '</p>';
                    echo '<p><strong>Taille (cm):</strong> ' . htmlspecialchars($champs[13]) . '</p>';
                    echo '<p><strong>Couleur des yeux:</strong> ' . htmlspecialchars($champs[14]) . '</p>';
                    echo '<p><strong>Genre intéressé:</strong> ' . htmlspecialchars($champs[15]) . '</p>';
                    echo '<p><strong>Mon personnage de jeu vidéo préféré:</strong> ' . htmlspecialchars($champs[10]) . '</p>';
                    echo '<p><strong>Jeu vidéo préféré:</strong> ' . htmlspecialchars($champs[11]) . '</p>';
                    echo '<p><strong>Type de jeu vidéo préféré:</strong> ' . htmlspecialchars($champs[12]) . '</p>';
                    echo '<p><strong>Description:</strong> ' . htmlspecialchars($champs[16]) . '</p>';
                    echo '<p><strong>Nombre d\'amis :</strong> ' . count($amis) . '</p>';
                    echo '<p><a href="friend_list.php">Voir la liste des amis</a></p>';
                    echo '<p><strong>Nombre de visites :</strong>   ' . $nombre_visites . '</p>';
                    echo '<p><a href="visit_list.php">Voir la liste des visiteurs</a></p>';
                }
            }
        } else {
            echo "Fichier introuvable.";
        }
    }
    ?>
    <script src="js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        function ban() {
            let raison = prompt("Pourquoi le ban ?");
            if(raison.includes(';')){
                alert("Pas de ;");
            }
            else{
                $.ajax({
                    url: 'php/ban.php',
                    type: 'POST',
                    data: {raison: raison},
                    success: function(response) {
                        alert('utilisateur ban avec succès.');
                        document.location.href="admin.php";
                    },
                    error: function() {
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    }
                });
            }
        }

        function verification(){
            $.ajax({
                url: 'php/verification_abonnement.php',
                success: function(response) {
                    document.location.href="non_abonne.php";
                }
            });
        }

        setInterval('verification()', 5000);
        verification();
    </script>
</body>
</html>