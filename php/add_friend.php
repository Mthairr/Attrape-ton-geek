<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_POST['ami_username'])) {
    echo "Aucun utilisateur spécifié.";
    exit;
}

// Identifiant de l'ami à ajouter
$ami_username = $_POST['ami_username'];
$utilisateur_connecte = $_SESSION['username'];
// Chemin vers le fichier contenant les données d'amis
$chemin_fichier_amis = "../donnee/friends.txt";

// Lire les amis existants
$amis_utilisateur_connecte = [];
if (file_exists($chemin_fichier_amis)) {
    $amis_utilisateur_connecte = file($chemin_fichier_amis, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    file_put_contents($chemin_fichier_amis,'');
}

// Ajoute l'ami à la liste d'amis de l'utilisateur connecté
$amis_utilisateur_connecte[] = $utilisateur_connecte . ';' .  $ami_username;
$amis_utilisateur_connecte_unique = array_unique($amis_utilisateur_connecte);
file_put_contents($chemin_fichier_amis, implode("\n", $amis_utilisateur_connecte_unique)); // Enregistre la liste mise à jour

$response = array(
    "success" => true,
    "ami_username" => $ami_username
);

echo json_encode($response);
header("Location: ../profil.php?username=$ami_username");
exit();
?>
