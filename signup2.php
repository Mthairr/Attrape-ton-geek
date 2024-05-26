<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Attrape ton geek</title>
        <link rel="stylesheet" href="css/signup.css">
        <meta name="description" content="">
        <link rel="icon" href="favicon2.ico" sizes="any">
    </head>

    <body>
        <nav class="navbar">
            <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
        </nav>

        <div class="wrapper">
            <form method="post" action="php/page2,5.php" enctype="multipart/form-data">
                <h1>~ Sign up ~</h1>
                <div class="input-box">
                    <input type="text", placeholder="Prénom" class="text1" name="name">
                </div>
                <div class="input-box">
                    <input type="text", placeholder="Nom" class="text1" name="lastname">
                </div>
                <div class="input-box">
                    <input type="email", placeholder="Email" class="text1" name="email">
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Confirme ton email" class="text1" name="email2">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Ville" class="text1" name="town">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Pays" class="text1" name="country">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Adresse" class="text1" name="adress">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Ton personnage de jeux vidéo préféré" class="text1" name="character">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Ton jeux vidéo préféré" class="text1" name="game">
                </div>
                <div class="input-box">
                    <p>Ton genre de jeux vidéo préféré :</p>
                    <select class="type_game" name="type_game">
                        <option value="FPS">FPS</option>
                        <option value="RPG">RPG</option>
                        <option value="MMORPG">MMORPG</option>
                        <option value="MOBA">MOBA</option>
                        <option value="Jeux d'horreur">Jeux d'horreur</option>
                        <option value="Jeux de plateforme">Jeux de plateforme (Super Mario etc)</option>
                    </select>
                </div>
                <div class="input-box">
                    <p>Ta photo de profil :</p>
                    <input type="file" name="img" accept="image/png, image/jpeg">
                </div>
                <div class="input-box">
                    <p>Je suis intérressé par :</p>
                    <select class="gender" name="target_gender">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="input-box">
                <p>Ma taille :</p>
                    <select class="height" name="height" >
                    <?php
                    session_start();
                    for ($i = 130; $i <= 230; $i++) {
                        echo "<option value=\"$i\">$i cm</option>";
                    }
                    ?>
                    </select>
                </div>
                <div class="input-box">
                    <p>Ta couleur des yeux :</p>
                    <select class="eyes" name="eyes">
                        <option value="Bleue">Bleue</option>
                        <option value="Marron">Marron</option>
                        <option value="Vert">Vert</option>
                        <option value="Gris">Gris</option>
                        <option value="Noire">Noire</option>
                        <option value="Albinos">Albinos</option>
                    </select>
                </div>
                <div class="input-box">
                    <textarea for="comment" placeholder="Décris-toi en quelques phrases" name="description" rows="4" cols="50"></textarea>
                </div>

                <button type="submit" class="btn">Sign up</button>
                <?php
                    if(isset($_GET['d'])){
                        echo "<p id='error'>please enter a valid informations</p>";
                    }

                    if(count($_COOKIE) == 0){
                        header('Location: signup.php');
                        exit();
                    }

                    if(!empty($_SESSION["name"])){
                        header('Location: Bienvenue.php');
                    }
                ?>
            </form>
        </div>
        <script src="js/app.js"></script>
        <script src="js/signup.js"></script>
    </body>
</html>
