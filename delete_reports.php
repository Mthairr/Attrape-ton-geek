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
<h1>Delete_reports</h1>
<?php
session_start();

if(count($_COOKIE) == 0){
    header('Location: index.php');
}


$reportsFilePath = 'donnee/reports.txt';

if (!file_exists($reportsFilePath)) {
    echo "Le fichier des signalements n'existe pas.";
    exit();
}
$file = fopen($reportsFilePath, 'w');
if ($file) {
    fwrite($file, '');
    fclose($file);
    echo "Signalements supprimés avec succès.";
} else {
    echo "Une erreur est survenue lors de la suppression des signalements.";
}


?>

<script src="js/app.js"></script>
</body>
</html>