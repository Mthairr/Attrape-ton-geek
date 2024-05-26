<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attrape ton geek</title>
  <link rel="stylesheet" href="css/style.css">
  <meta name="description" content="">

  <link rel="icon" href="favicon2.ico" sizes="any">
</head>

<body>
    <?php
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

  <!-- Add your site or application content here -->
  <nav class="navbar">
      <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
      <div class="buttons">
        <button id="btn1" onclick="login()">Log in</button>
        <button id="btn2" onclick="signup()">Sign up</button>
      </div>
  </nav>
  <div class="title">
    <h1>Attrape Ton Geek</h1>
    <br><p>Bienvenue sur Attrape Ton Geek, où les univers virtuels se rencontrent pour créer des liens réels. Rencontrez des esprits brillants qui partagent votre passion pour les jeux, la technologie et la culture geek.</p><br> 
    <p>Rejoignez-nous dès maintenant et découvrez une communauté où l'amour est codé dans chaque ligne !</p>
    <button class="btn-freetour" onclick="tour_gratuit()">Tour gratuit</button>
  </div>


  <script src="js/app.js"></script>

</body>

</html>
