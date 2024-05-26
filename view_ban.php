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
<h1>View Ban</h1>
<?php
    session_start();

    if (count($_COOKIE) > 0) {
        if (empty($_SESSION["name"])) {
            header('Location: php/page3.php');
        }
    }else {
        header('Location: index.php');
    }

    $file = fopen("donnee/ban.txt", 'r');
    $reports = [];

    // Lire le fichier ligne par ligne
    while (($line = fgets($file)) !== false) {
        // Supprimer les espaces blancs en début et fin de ligne
        $line = trim($line);

        // Ignorer les lignes vides
        if (empty($line)) {
            continue;
        }

        // Séparer les données en utilisant le séparateur ";"
        $data = explode(';', $line);

        // Vérifier que chaque ligne contient le bon nombre de données
        if (count($data) === 3) {
            // Ajouter les données au tableau des bans
            $reports[] = [
                'email' => $data[0],
                'raison' => $data[1]
            ];
        } else {
            echo "La ligne suivante ne contient pas le bon nombre de données : $line\n";
        }
    }

    // Fermer le fichier
    fclose($file);

    $html = '<table border="1">';
    $html .= '<tr>';
    $html .= '<th>Adresse email</th>';
    $html .= '<th>Raison du ban</th>';
    $html .= '</tr>';

    // Ajouter les lignes du tableau avec les données des signalements
    foreach ($reports as $report) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($report['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($report['raison']) . '</td>';
        $html .= '</tr>';
    }

    // Fermer le tableau HTML
    $html .= '</table>';



    echo "<h2>Ban</h2>";
    echo $html;


?>

<script src="js/app.js"></script>
</body>
</html>