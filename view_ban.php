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

    if (count($_COOKIE) > 0) {
        if (empty($_SESSION["name"])) {
            header('Location: php/page3.php');
        }
    }else {
        header('Location: index.php');
    }


    $ban = file_get_contents('donnee/ban.txt');

    $ban = nl2br($ban);

    echo "<h2>Bannissements</h2>";
    echo "<pre>$ban</pre>";

?>

<script src="js/app.js"></script>
</body>
</html>