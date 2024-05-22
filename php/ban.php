<?php
session_start();
$filePath = '../donnee/log.txt';
$fichierban = '../donnee/ban.txt';
$nom_utilisateur_a_supprimer = $_SESSION['username'];
file_put_contents('../donnee/ban.txt', $_SESSION["email"] . ";" . "\n", FILE_APPEND);


$sessionUsername = $_SESSION['username'];

$lines = file($filePath, FILE_IGNORE_NEW_LINES);

// Iterate through each line to find and remove the line with the session's username
foreach ($lines as $key => $line) {
    $data = explode(';', $line);
    if ($data[0] === $sessionUsername) {
        unset($lines[$key]);
        break; // Stop searching after the first occurrence
    }
}

// Write the modified data back to the file
file_put_contents($filePath, implode("\n", $lines));

echo "La ligne contenant le nom d'utilisateur a été supprimée avec succès !";


echo "La ligne contenant le nom d'utilisateur a été supprimée avec succès !";
header('Location: ../Bienvenue.php');
exit();