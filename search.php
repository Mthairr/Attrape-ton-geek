<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek - Bienvenue</title>
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
    <link rel="stylesheet" href="css/search.css">
</head>
<body>

<?php
if(count($_COOKIE) == 0){
    header('Location: index.php');
}
?>

<nav class="navbar">
    <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
    <form method="post" action="php/page4.php">
        <button type="submit" name="log_out">Log out</button>
    </form>
    <ul class="menu">
        <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
        <li><a class="active1" href="message.php">Message</a></li>
        <li><a class="active2" href="search.php">Recherche</a></li>
    </ul>
</nav>

<div class="search">
    <form id="form-search" method="post" action="php/search.php"></form>
    <h1>Recherche ton geek</h1>
    <input type="text" id="name" placeholder="Name" name="name">
    <input type="number" id="age" placeholder="Age" name="age">
    <div class="select-one">
        <p>I am looking for :</p>
        <select name="sexualindentity">
            <option value="null"></option>
            <option value="Man">Man</option>
            <option value="Woman">Woman</option>
            <option value="Other">Other</option>
        </select>
    </div>
    <button type="submit" onclick="results_search()" >Search</button>
</div>
<script src="js/app.js"></script>
</body>
</html>