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
            <form method="post" action="php/page2.php">
                <h1>~ Sign up ~</h1>
                <div class="input-box">
                    <input type="text", placeholder="Nom d'utilisateur" class="text1" name="username">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Mot de passe" class="text1" name="password">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Confirme ton mot de passe" class="text1" name="password2">
                </div>
                <div class="input-container">
                    <div class="select-one">
                        <p>Je suis :</p>
                        <select name="sexualindentity">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="age">
                        <label>
                            Votre date de naissance :
                            <input type="date" name="age"/>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn">Sign up</button>

                <?php
                    if(isset($_GET['d'])){
                        echo "<p id='error'>please enter a valid informations</p>";
                    }

                    if(count($_COOKIE) > 0){
                        session_start();
                        if(!empty($_SESSION["name"])){
                            header('Location: Bienvenue.php');
                        }
                        else{
                            header('Location: php/page3.php');
                        }
                    }
                ?>

            </form>
        </div>



        <script src="js/app.js"></script>
        <script src="js/signup.js"></script>
    </body>
</html>
