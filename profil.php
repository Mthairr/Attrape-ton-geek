<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: connexion.php");
    exit;
}

// Vérifiez si un pseudo est passé dans l'URL
if (!isset($_GET['username'])) {
    echo "Aucun utilisateur spécifié.";
    exit;
}

$username = $_GET['username'];
$fichier = 'donnee/log.txt';
$utilisateur_info = [];

// Lire le fichier et trouver les informations de l'utilisateur
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
<?php
    if (count($_COOKIE) > 0) {
        if (empty($_SESSION["name"])) {
            header('Location: php/page3.php');
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
        <h1>Profil de <?php echo htmlspecialchars($username); ?></h1>
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
        <p>Prénom: <?php echo htmlspecialchars($utilisateur_info[5]); ?></p>
        <p>Nom: <?php echo htmlspecialchars($utilisateur_info[6]); ?></p>
        <p>Email: <?php echo htmlspecialchars($utilisateur_info[4]); ?></p>
        <p>Ville: <?php echo htmlspecialchars($utilisateur_info[8]); ?></p>
        <p>Pays: <?php echo htmlspecialchars($utilisateur_info[9]); ?></p>
        <p>Adresse: <?php echo htmlspecialchars($utilisateur_info[7]); ?></p>
        <p>Je suis intéressé par: <?php echo htmlspecialchars($utilisateur_info[12]); ?></p>
        <p>Taille: <?php echo htmlspecialchars($utilisateur_info[10]); ?> cm</p>
        <p>Couleur des yeux: <?php echo htmlspecialchars($utilisateur_info[11]); ?></p>
    </div>
</body>
</html>
