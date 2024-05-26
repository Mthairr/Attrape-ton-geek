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
    <nav class="navbar">
        <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo"
            onclick="index()">
        <form method="post" action="php/page3.php">
            <button type="submit" name="log_out">Log out</button>
        </form>
        <ul class="menu">
            <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
            <li><a href="message.php">Message</a></li>
            <li><a href="search.php">Recherche</a></li>
            <li><a href="subscription.php">Abonnements</a></li>
        </ul>
    </nav>
    <div class="content">



    </div>

    <?php
    session_start();
    if (count($_COOKIE) > 0) {
        if (empty($_SESSION["name"])) {
            header('Location: php/page3.php');
        }
    } else {
        header('Location: index.php');
    }

    $username_connecte = $_SESSION['username'];
    $fichier = 'donnee/log.txt';
    $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $utilisateur_info = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_SESSION['username'] != $_POST['username']) {
            for ($i = 0; $i < count($lignes); $i++) {
                $a = explode(";", $lignes[$i])[0];
                if ($a == $_POST['username']) {
                    header("Location: updateprofile.php?d=1");
                    exit();
                }
            }
            if (file_exists("img/" . $_SESSION['username'] . ".jpg")) {
                rename("img/" . $_SESSION['username'] . ".jpg", "img/" . $_POST['username'] . ".jpg");
            }
            if (file_exists("img/" . $_SESSION['username'] . ".jpeg")) {
                rename("img/" . $_SESSION['username'] . ".jpeg", "img/" . $_POST['username'] . ".jpeg");
            }
            if (file_exists("img/" . $_SESSION['username'] . ".png")) {
                rename("img/" . $_SESSION['username'] . ".png", "img/" . $_POST['username'] . ".png");
            }
            $_SESSION['username'] = $_POST['username'];
        }
        if (!empty($_POST["password"])) {
            $_SESSION["password"] = hash('sha512', $_POST["password"]);
        }
        $_SESSION['username'] = $_POST["username"];
        $_SESSION['sexualindentity'] = $_POST["sexualindentity"];
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['adress'] = $_POST["adress"];
        $_SESSION['town'] = $_POST["town"];
        $_SESSION['country'] = $_POST["country"];
        $_SESSION['character'] = $_POST["character"];
        $_SESSION['game'] = $_POST["game"];
        $_SESSION['type_game'] = $_POST["type_game"];
        $_SESSION['height'] = $_POST["height"];
        $_SESSION['eyes'] = $_POST["eyes"];
        $_SESSION['target_gender'] = $_POST["target_gender"];
        $_SESSION['description'] = $_POST["description"];

        
        $photo_ext = null;
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
           
            $allowed_types = ['image/jpeg', 'image/png']; 
            $uploaded_type = $_FILES['img']['type'];

            if (!in_array($uploaded_type, $allowed_types)) {
                $error_message = "Le fichier téléchargé n'est pas une image valide. Veuillez télécharger une image au format JPEG ou PNG.";
                
                echo "<p>$error_message</p>";
            } else {
                
                $existing_photo_path = "img/" . $_POST['username'] . ".*"; 
                $existing_photos = glob($existing_photo_path);

                
                foreach ($existing_photos as $existing_photo) {
                    unlink($existing_photo);
                }

                // Upload the new profile picture
                $photo_tmp = $_FILES['img']['tmp_name'];
                $photo_ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
                $photo_name = $_POST['username'] . '.' . $photo_ext;
                move_uploaded_file($photo_tmp, "img/$photo_name");
            }
        }
        $nouvelle_lignes = [];
        $username = $_SESSION['username'];
        $password = $_SESSION["password"];
        $age = $_SESSION["age"];
        $sexualindentity = $_SESSION['sexualindentity'];
        $prenom = $_SESSION['name'];
        $nom = $_SESSION['lastname'];
        $email = $_SESSION['email'];
        $ville = $_SESSION['town'];
        $pays = $_SESSION['country'];
        $adresse = $_SESSION['adress'];
        $character = $_SESSION['character'];
        $game = $_SESSION['game'];
        $type_game = $_SESSION['type_game'];
        $target_gender = $_SESSION['target_gender'];
        $height = $_SESSION['height'];
        $eyes = $_SESSION['eyes'];
        $description = $_SESSION['description'];

        foreach ($lignes as $ligne) {
            $champs = explode(';', $ligne);
            if ($champs[0] === $username_connecte) {
                $nouvelle_ligne = implode(';', [
                    $username,
                    $password,
                    $age,
                    $sexualindentity,
                    $email,
                    $prenom,
                    $nom,
                    $adresse,
                    $ville,
                    $pays,
                    $character,
                    $game,
                    $type_game,
                    $height,
                    $eyes,
                    $target_gender,
                    $description,
                    $abonnement
                ]);
                $nouvelle_lignes[] = $nouvelle_ligne;
            } else {
                $nouvelle_lignes[] = $ligne;
            }
        }

        file_put_contents($fichier, implode("\n", $nouvelle_lignes));
        header("Location: Bienvenue.php");
        exit;
    }
    ?>


    <div class="wrapper">
        <form method="post" action="updateprofile.php" enctype="multipart/form-data">
            <h1>~ Modifier le profil ~</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" class="text1" name="username"
                    value="<?php echo $_SESSION['username']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Password" class="text1" name="password">
            </div>
            <div class="input-box">
                <input type="email" placeholder="Email" class="text1" name="email"
                    value="<?php echo $_SESSION['email']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="ville" class="text1" name="town"
                    value="<?php echo $_SESSION['town']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Pays" class="text1" name="country"
                    value="<?php echo $_SESSION['country']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Adresse" class="text1" name="adress"
                    value="<?php echo $_SESSION['adress']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Ton personnage de jeux vidéo préféré" class="text1" name="character"
                    value="<?php echo $_SESSION['character']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Ton jeux vidéo préféré" class="text1" name="game"
                    value="<?php echo $_SESSION['game']; ?>">
            </div>

            <div class="input-box">
                <p>Ton genre de jeux vidéo préféré :</p>
                <select class="type_game" name="type_game">
                    <option value="FPS" <?php if ($_SESSION['type_game'] == 'FPS')
                        echo 'selected'; ?>>FPS</option>
                    <option value="RPG" <?php if ($_SESSION['type_game'] == 'RPG')
                        echo 'selected'; ?>>RPG</option>
                    <option value="MMORPG" <?php if ($_SESSION['type_game'] == 'MMORPG')
                        echo 'selected'; ?>>MMORPG
                    </option>
                    <option value="MOBA" <?php if ($_SESSION['type_game'] == 'MOBA')
                        echo 'selected'; ?>>MOBA</option>
                    <option value="Jeux d'horreur" <?php if ($_SESSION['type_game'] == "Jeux d'horreur")
                        echo 'selected'; ?>>Jeux d'horreur</option>
                    <option value="Jeux de plateforme" <?php if ($_SESSION['type_game'] == 'Jeux de plateforme (Super Mario etc)')
                        echo 'selected'; ?>>Jeux de plateforme (Super Mario etc)</option>
                </select>
            </div>
            <div class="input-box">
                <p>Votre photo de profil :</p>
                <input type="file" name="img" accept="image/png, image/jpeg">
            </div>

            <div class="input-box">
                <p>Je suis un :</p>
                <select class="gender" name="sexualindentity">
                    <option value="Homme" <?php if ($_SESSION['target_gender'] == 'Homme')
                        echo 'selected'; ?>>Homme
                    </option>
                    <option value="Femme" <?php if ($_SESSION['target_gender'] == 'Femme')
                        echo 'selected'; ?>>Femme
                    </option>
                    <option value="Autre" <?php if ($_SESSION['target_gender'] == 'Autre')
                        echo 'selected'; ?>>Autre
                    </option>
                </select>
            </div>
            <div class="input-box">
                <p>Je suis intéressé par :</p>
                <select class="gender" name="target_gender">
                    <option value="Homme" <?php if ($_SESSION['target_gender'] == 'Homme')
                        echo 'selected'; ?>>Homme
                    </option>
                    <option value="Femme" <?php if ($_SESSION['target_gender'] == 'Femme')
                        echo 'selected'; ?>>Femme
                    </option>
                    <option value="Autre" <?php if ($_SESSION['target_gender'] == 'Autre')
                        echo 'selected'; ?>>Autre
                    </option>
                </select>
            </div>
            <div class="input-box">
                <p>Votre taille :</p>
                <select class="height" name="height">
                    <?php
                    for ($i = 130; $i <= 230; $i++) {
                        $selected = ($i == $_SESSION['height']) ? 'selected' : '';
                        echo "<option value=\"$i\" $selected>$i cm</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <p>Couleur de vos yeux :</p>
                <select class="eyes" name="eyes">
                    <option value="Bleue" <?php if ($_SESSION['eyes'] == 'Bleue')
                        echo 'selected'; ?>>Bleue
                    </option>
                    <option value="Marron" <?php if ($_SESSION['eyes'] == 'Marron')
                        echo 'selected'; ?>>Marron
                    </option>
                    <option value="Vert" <?php if ($_SESSION['eyes'] == 'Vert')
                        echo 'selected'; ?>>Vert
                    </option>
                    <option value="Gris" <?php if ($_SESSION['eyes'] == 'Gris')
                        echo 'selected'; ?>>Gris
                    </option>
                    <option value="Noire" <?php if ($_SESSION['eyes'] == 'Noire')
                        echo 'selected'; ?>>Noire
                    </option>
                    <option value="Albinos" <?php if ($_SESSION['eyes'] == 'Albinos')
                        echo 'selected'; ?>>Albinos
                    </option>
                </select>
            </div>
            <div class="input-box">
                <textarea for="comment" placeholder="Décris-toi en quelques phrases" name="description" rows="4"
                    cols="50"><?php echo $_SESSION['description']; ?></textarea>
            </div>
            <div class="input-submit">
                <button classe="submit" type="submit" value="Mettre à jour le profil">Mettre le profil à jour</button>
            </div>
        </form>
    </div>
</body>

</html>
<script src="js/app.js"></script>
</body>

</html>