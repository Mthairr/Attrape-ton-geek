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
    }else {
        header('Location: index.php');
    }

    $username_connecte = $_SESSION['username'];
    $fichier = 'donnee/log.txt';
    $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $utilisateur_info = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if($_SESSION['username'] != $_POST['username']){
            for($i=0; $i<count($lignes); $i++){
                $a = explode(";", $lignes[$i])[0];
                if($a == $_POST['username']){
                    header("Location: updateprofile.php?d=1");
                    exit();
                }
            }
            if(file_exists("img/" . $_SESSION['username'] . ".jpg")){
                rename("img/" . $_SESSION['username'] . ".jpg", "img/" . $_POST['username'] . ".jpg");
            }
            if(file_exists("img/" . $_SESSION['username'] . ".jpeg")){
                rename("img/" . $_SESSION['username'] . ".jpeg", "img/" . $_POST['username'] . ".jpeg");
            }
            if(file_exists("img/" . $_SESSION['username'] . ".png")){
                rename("img/" . $_SESSION['username'] . ".png", "img/" . $_POST['username'] . ".png");
            }
            $_SESSION['username'] = $_POST['username'];
        }
        if(!empty($_POST["password"])){
            $_SESSION["password"] = hash('sha512', $_POST["password"]);
        }
        $_SESSION['sexualindentity'] = $_POST['sexualindentity'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['ville'] = $_POST['ville'];
        $_SESSION['pays'] = $_POST['pays'];
        $_SESSION['adresse'] = $_POST['adresse'];
        $_SESSION['target_gender'] = $_POST['target_gender'];
        $_SESSION['height'] = $_POST['height'];
        $_SESSION['eyes'] = $_POST['eyes'];

        // Handle photo upload
        $photo_ext = null;
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Check if the uploaded file is an image
            $allowed_types = ['image/jpeg', 'image/png']; // Allowed image types
            $uploaded_type = $_FILES['img']['type'];

            if (!in_array($uploaded_type, $allowed_types)) {
                $error_message = "Le fichier téléchargé n'est pas une image valide. Veuillez télécharger une image au format JPEG ou PNG.";
                // Vous pouvez traiter ce message d'erreur de différentes manières, par exemple, en l'affichant à l'utilisateur.
                // Vous pouvez également rediriger l'utilisateur vers une autre page avec un message d'erreur.
                // Ici, nous allons simplement afficher le message d'erreur dans la page actuelle.
                echo "<p>$error_message</p>";
            } else {
                // Check if there's an existing profile picture
                $existing_photo_path = "img/" . $_POST['username'] . ".*"; // Pattern to match any file for this user
                $existing_photos = glob($existing_photo_path);

                // If existing photo(s) found, delete them
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

        foreach ($lignes as $ligne) {
            $champs = explode(';', $ligne);
            if ($champs[0] === $username_connecte) {
                $nouvelle_ligne = implode(';', [
                    $_SESSION['username'],
                    $_SESSION['password'],
                    $_SESSION['age'],
                    $_SESSION['sexualindentity'],
                    $_SESSION['email'],
                    $_SESSION['prenom'],
                    $_SESSION['nom'],
                    $_SESSION['adresse'],
                    $_SESSION['ville'],
                    $_SESSION['pays'],
                    $_SESSION['height'],
                    $_SESSION['eyes'],
                    $_SESSION['target_gender']
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
                <input type="text" placeholder="Prénom" class="text1" name="prenom"
                    value="<?php echo $_SESSION['name']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Nom" class="text1" name="nom"
                    value="<?php echo $_SESSION['lastname']; ?>">
            </div>
            <div class="input-box">
                <input type="email" placeholder="Email" class="text1" name="email"
                    value="<?php echo $_SESSION['email']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Ville" class="text1" name="ville"
                    value="<?php echo $_SESSION['town']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Pays" class="text1" name="pays"
                    value="<?php echo $_SESSION['country']; ?>">
            </div>
            <div class="input-box">
                <input type="text" placeholder="Adresse" class="text1" name="adresse"
                    value="<?php echo $_SESSION['adress']; ?>">
            </div>
            <div class="input-box">
                <p>Votre photo de profil :</p>
                <input type="file" name="img" accept="image/png, image/jpeg">
            </div>
            <div class="input-box">
                <p>Je suis un :</p>
                <select class="gender" name="sexualindentity">
                    <option value="Man" <?php if ($_SESSION['target_gender'] == 'Man')
                        echo 'selected'; ?>>Man</option>
                    <option value="Woman" <?php if ($_SESSION['target_gender'] == 'Woman')
                        echo 'selected'; ?>>Woman
                    </option>
                    <option value="Other" <?php if ($_SESSION['target_gender'] == 'Other')
                        echo 'selected'; ?>>Other
                    </option>
                </select>
            </div>
            <div class="input-box">
                <p>Je suis intéressé par :</p>
                <select class="gender" name="target_gender">
                    <option value="Man" <?php if ($_SESSION['target_gender'] == 'Man')
                        echo 'selected'; ?>>Man</option>
                    <option value="Woman" <?php if ($_SESSION['target_gender'] == 'Woman')
                        echo 'selected'; ?>>Woman
                    </option>
                    <option value="Other" <?php if ($_SESSION['target_gender'] == 'Other')
                        echo 'selected'; ?>>Other
                    </option>
                </select>
            </div>
            <div class="input-box">
                <p>Votre taille :</p>
                <select class="height" name="height">
                    <?php
                    for ($i = 0; $i <= 230; $i++) {
                        $selected = ($i == $_SESSION['height']) ? 'selected' : '';
                        echo "<option value=\"$i\" $selected>$i cm</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-box">
                <p>Couleur de vos yeux :</p>
                <select class="eyes" name="eyes">
                    <option value="Blue" <?php if ($_SESSION['eyes'] == 'Blue')
                        echo 'selected'; ?>>Blue
                    </option>
                    <option value="Brown" <?php if ($_SESSION['eyes'] == 'Brown')
                        echo 'selected'; ?>>Brown
                    </option>
                    <option value="Green" <?php if ($_SESSION['eyes'] == 'Green')
                        echo 'selected'; ?>>Green
                    </option>
                    <option value="Gray" <?php if ($_SESSION['eyes'] == 'Gray')
                        echo 'selected'; ?>>Gray
                    </option>
                    <option value="Amber" <?php if ($_SESSION['eyes'] == 'Amber')
                        echo 'selected'; ?>>Amber
                    </option>
                    <option value="Hazel" <?php if ($_SESSION['eyes'] == 'Hazel')
                        echo 'selected'; ?>>Hazel
                    </option>
                </select>
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