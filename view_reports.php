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
<h1>View_reports</h1>
<?php
    session_start();

    if(count($_COOKIE) == 0){
        header('Location: index.php');
    }


    $reports = file_get_contents('donnee/reports.txt');

    $reports = nl2br($reports);

    echo "<h2>Signalements</h2>";
    echo "<pre>$reports</pre>";

?>

<script src="js/app.js"></script>
</body>
</html>