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

    $file = fopen("donnee/reports.txt", 'r');
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
        if (count($data) === 5) {
            // Ajouter les données au tableau des signalements
            $reports[] = [
                'message_id' => $data[0],
                'message_content' => $data[1],
                'reported_user' => $data[2],
                'reporting_user' => $data[3],
                'report_reason' => $data[4]
            ];
        } else {
            echo "La ligne suivante ne contient pas le bon nombre de données : $line\n";
        }
    }

    // Fermer le fichier
    fclose($file);

    $html = '<table border="1">';
    $html .= '<tr>';
    $html .= '<th>ID du message</th>';
    $html .= '<th>Contenu du message</th>';
    $html .= '<th>Utilisateur signalé</th>';
    $html .= '<th>Utilisateur signalant</th>';
    $html .= '<th>Raison du signalement</th>';
    $html .= '<th>Direction</th>';
    $html .= '</tr>';

    // Ajouter les lignes du tableau avec les données des signalements
    foreach ($reports as $report) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($report['message_id']) . '</td>';
        $html .= '<td>' . htmlspecialchars($report['message_content']) . '</td>';
        $html .= '<td>' . htmlspecialchars($report['reported_user']) . '</td>';
        $html .= '<td>' . htmlspecialchars($report['reporting_user']) . '</td>';
        $html .= '<td>' . htmlspecialchars($report['report_reason']) . '</td>';
        $html .= '<td><a href="php/connexion.php?username=' . htmlspecialchars($report['reporting_user']) . '&goto=' . htmlspecialchars($report['reported_user']) . '">Y aller</a></td>';
        $html .= '</tr>';
    }

    // Fermer le tableau HTML
    $html .= '</table>';



    echo "<h2>Signalements</h2>";
    echo $html;


?>

<script src="js/app.js"></script>
</body>
</html>