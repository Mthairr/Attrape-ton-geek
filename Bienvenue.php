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
if(count($_COOKIE) == 0){
    header('Location: index.php');
}
?>

<nav class="navbar">
    <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
    <form method="post" action="php/page3.php">
        <button type="submit" name="log_out">Log out</button>
    </form>
    <div class="menu">
        <a class="active" href="profil.php">Votre profil</a>
        <a href="message.php">Message</a>
    </div>
</nav>
<div class="content">
<h1>Votre profil</h1>
<button type="submit" onclick="updateprofile()">Modifier votre profil ?</button>
</div>

<script src="js/app.js"></script>
</body>
</html>