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
<h1>Vous n'êtes plus abonné</h1>
<?php
session_start();
echo $_SESSION["abonnement"]; ?>

<script src="js/app.js"></script>
</body>
</html>