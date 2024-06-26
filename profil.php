<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if(count($_COOKIE) > 0){
        if(empty($_SESSION["name"])){
            header('Location: php/page3.php');
        }
    }
    else{
        header('Location: index.php');
    }

// Vérifiez si un pseudo est passé dans l'URL
if (!isset($_GET['username'])) {
    echo "Aucun utilisateur spécifié.";
    exit;
}

$username = $_GET['username'];
$visiteur = $_SESSION['username'];
$fichier = 'donnee/log.txt';
$visitesFichier = 'donnee/visites.txt';
$utilisateur_info = [];

// Vérifie si l'utilisateur visite son propre profil
if ($_SESSION['username'] === $username) {
    echo '<p>TFKCHACAL</p>'; // Uniquement pour le débogage, peut être supprimé
    header("Location: bienvenue.php");
    exit;
}

// Lire le fichier pour trouver les informations de l'utilisateur visité
if (file_exists($fichier)) {
    $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lignes as $ligne) {
        $champs = explode(';', $ligne);
        if ($champs[0] === $username) {
            $utilisateur_info = $champs;
            break;
        }
    }
}

if (empty($utilisateur_info)) {
    echo "Utilisateur non trouvé.";
    exit;
}

// Écriture dans le fichier des visites
if (file_exists('donnee')) {
    if (file_exists($visitesFichier)) {
        $visites = file($visitesFichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $nouveau_contenu = '';
        $utilisateur_trouve = false;

        foreach ($visites as $key => $ligne) {
            $champs = explode(';', $ligne);
            if ($champs[0] === $username) {
                $utilisateur_trouve = true;
                if (!in_array($visiteur, $champs)) {
                    $visites[$key] .= ';' . $visiteur;
                }
            }
            $nouveau_contenu .= $visites[$key] . "\n";
        }

        if (!$utilisateur_trouve) {
            $nouveau_contenu .= $username . ';' . $visiteur . "\n";
        }

        file_put_contents($visitesFichier, $nouveau_contenu);
    } else {
        file_put_contents($visitesFichier, $username . ';' . $visiteur . "\n");
    }
} else {
    echo "Le répertoire 'donnee' n'existe pas.";
    exit;
}
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Profil de <?php echo htmlspecialchars($username); ?></title>
    <link rel="icon" href="favicon2.ico" sizes="any">
    <link rel="stylesheet" href="css/profil.css">
    <style>
        .profile-container {
            max-width: 500px;
            margin: auto;
        }

        .profile-picture {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo"
            onclick="index()">
        <form method="post" action="php/page3.php">
            <button type="submit" name="log_out">Log out</button>
        </form>
        <?php
        if ($_SESSION["admin"] == 1) {
            echo '<button class="admin" type="submit" onclick="document.location.href=' . "'admin.php';" . '">Return admin mode</button>';
        }
        ?>
        <ul class="menu">
            <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
            <li><a href="message.php">Message</a></li>
            <li><a href="search.php">Recherche</a></li>
            <li><a href="subscription.php">Abonnements</a></li>
        </ul>
    </nav>
    <div class="profile-container">
        <div class="profile-header">
            <h1>Profil de <?php echo htmlspecialchars($username); ?></h1>
            <?php
                $fileLines = file('donnee/bloque.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $a=0;
                for($i=0; $i<count($fileLines); $i++){
                    $message = explode(";", $fileLines[$i]);
                    if($message[1] == $_GET['username'] && $message[0] == $_SESSION['username']){
                        $a = 1;
                        break;
                    }
                }
                if($a){
                    echo "<button class='admin' type='submit' onclick=document.location.href='php/bloquer.php?username=" . $_GET["username"] . "'>Debloquer</button>";
                    exit();
                }
                else{
                    echo "<button class='admin' type='submit' onclick=document.location.href='php/bloquer.php?username=" . $_GET["username"] . "'>Bloquer</button>";
                }
                $fileLines2 = file('donnee/friends.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $b=0;
                for($i=0; $i<count($fileLines2); $i++){
                    $message2 = explode(";", $fileLines2[$i]);
                    if($message2[1] == $_GET['username'] && $message2[0] == $_SESSION['username']){
                        $b = 1;
                        break;
                    }
                }
                
                if($b){
                    echo "<button class='admin' type='submit' onclick=document.location.href='php/add_friend.php?username=" . $_GET["username"] . "'>Supprimer l'ami</button>";
                }
                else{
                    echo "<button class='admin' type='submit' onclick=document.location.href='php/add_friend.php?username=" . $_GET["username"] . "'>Ajouter en ami</button>";
                }    
            ?>
        </div>

        <?php
        $image_extensions = ['png', 'jpg', 'jpeg'];
        $image_path = '';
        foreach ($image_extensions as $ext) {
            if (file_exists("img/$username.$ext")) {
                $image_path = "img/$username.$ext";
                break;
            }
        }
        if ($image_path) {
            echo "<img src=\"$image_path\" alt=\"Profil de $username\" class=\"profile-picture\"><br>";
        } else {
            echo "<p>Aucune photo de profil.</p>";
        }
        ?>
        <p>Genre: <?php echo htmlspecialchars($utilisateur_info[3]); ?></p>
        <p>Email: <?php echo htmlspecialchars($utilisateur_info[4]); ?></p>
        <p>Ville: <?php echo htmlspecialchars($utilisateur_info[8]); ?></p>
        <p>Pays: <?php echo htmlspecialchars($utilisateur_info[9]); ?></p>
        <p>Intéressé par: <?php echo htmlspecialchars($utilisateur_info[15]); ?></p>
        <p>Taille: <?php echo htmlspecialchars($utilisateur_info[13]); ?> cm</p>
        <p>Couleur des yeux: <?php echo htmlspecialchars($utilisateur_info[14]); ?></p>
        <?php
        if(is_numeric($_SESSION['abonnement'])){
            if ($_SESSION['abonnement']==0){
                echo '<button class="btn2" onclick="subscription()">VOIR LE PROFIL COMPLET</button>';
            }
            else{
                echo "<p>Prenom:" . htmlspecialchars($utilisateur_info[5]) . "</p>";
                echo "<p>Nom:" . htmlspecialchars($utilisateur_info[6]) . "</p>";
                echo "<p>Email:" . htmlspecialchars($utilisateur_info[4]) . "</p>";
                echo "<p>Ville:" . htmlspecialchars($utilisateur_info[8]) . "</p>";
                echo "<p>Personnage de jeu vidéo préféré:" .  htmlspecialchars($utilisateur_info[10]) . "</p>";
                echo "<p>Jeu vidéo préféré:" .  htmlspecialchars($utilisateur_info[11]) . "</p>";
                echo "<p>Type de jeu vidéo préféré:" .  htmlspecialchars($utilisateur_info[12]) . "</p>";
                echo "<p>Description:" .  htmlspecialchars($utilisateur_info[16]) . "</p>";
            }
        }
        else{
                echo "<p>Prenom:" . htmlspecialchars($utilisateur_info[5]) . "</p>";
                echo "<p>Nom:" . htmlspecialchars($utilisateur_info[6]) . "</p>";
                echo "<p>Email:" . htmlspecialchars($utilisateur_info[4]) . "</p>";
                echo "<p>Ville:" . htmlspecialchars($utilisateur_info[8]) . "</p>";
                echo "<p>Personnage de jeu vidéo préféré:" .  htmlspecialchars($utilisateur_info[10]) . "</p>";
                echo "<p>Jeu vidéo préféré:" .  htmlspecialchars($utilisateur_info[11]) . "</p>";
                echo "<p>Type de jeu vidéo préféré:" .  htmlspecialchars($utilisateur_info[12]) . "</p>";
                echo "<p>Description:" .  htmlspecialchars($utilisateur_info[16]) . "</p>";
        }
        
        ?>
    </div>

<script>
    function ajouterAmi(ami_username) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "php/add_friend.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var bouton = document.getElementById("btnAddFriend");
                        bouton.innerHTML = '<img src="success-icon.svg" alt="Ajouté en ami" style="width: 18.5px; height: 18.5px; margin-right: 8px;"> Ami ajouté';
                        bouton.classList.add("added");
                        bouton.disabled = true;
                    } else {
                        if (response.message === "Ami déjà ajouté.") {
                            alert("Cet ami a déjà été ajouté.");
                            var bouton = document.getElementById("btnAddFriend");
                            bouton.innerHTML = '<img src="success-icon.svg" alt="Ajouté en ami" style="width: 18.5px; height: 18.5px; margin-right: 8px;"> Ami ajouté';
                            bouton.classList.add("added");
                            bouton.disabled = true;
                        }
                    } else {
                    alert("Erreur lors de la requête.");
                    }
                }
            };
        xhr.send("ami_username=" + encodeURIComponent(ami_username));
        }
    }
</script>
<script src="js/app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
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
