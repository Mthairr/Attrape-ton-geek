<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek - Bienvenue</title>
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/subscription.css">
</head>

<body>

<?php
if (count($_COOKIE) > 0) {
    session_start();
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
    <ul class="menu">
        <li><a href="Bienvenue.php">Votre profil</a></li>
        <li><a href="message.php">Message</a></li>
        <li><a href="search.php">Recherche</a></li>
        <li><a class="active" href="subscription.php">Abonnements</a></li>
    </ul>
</nav>
<h1>~ Les abonnements ~</h1>
<div class="pricing-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="single-price">
                    <div class="deal-top">
                        <h3>Classique</h3>
                        <h4>3.99 <span class="sup">€</span></h4>
                    </div>
                    <div class="deal-bottom">
                        <ul class="deal-items">
                            <li>+ 10 messages</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                        </ul>
                        <div class="btn-area">
                            <button onclick="bienvenue()">Je commence dès maintenant</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-price">
                    <div class="deal-top">
                        <h3>Premium</h3>
                        <h4>6.99<span class="sup">€</span></h4>
                        <p></p>
                    </div>
                    <div class="deal-bottom">
                        <ul class="deal-items">
                            <li>Messages illimités</li>
                            <li>6</li>
                            <li>7</li>
                            <li>8</li>
                        </ul>
                        <div class="btn-area">
                            <button onclick="bienvenue()">Je commence dès maintenant</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="js/app.js"></script>
</body>

</html>