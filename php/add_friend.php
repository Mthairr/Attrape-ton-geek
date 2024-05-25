<?php
session_start();

if(count($_COOKIE) > 0){
    if(empty($_SESSION["name"])){
        header('Location: page3.php');
    }
}
else{
    header('Location: ../index.php');
}

if (!isset($_POST['ami_username'])) {
    echo json_encode(["success" => false, "message" => "Aucun utilisateur spécifié."]);
    exit;
}

$ami_username = $_POST['ami_username'];
$utilisateur_connecte = $_SESSION['username'];
$chemin_fichier_amis = "../donnee/friends.txt";

$amis_utilisateur_connecte = [];
if (file_exists($chemin_fichier_amis)) {
    $amis_utilisateur_connecte = file($chemin_fichier_amis, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    file_put_contents($chemin_fichier_amis, '');
}

// Vérifie si l'ami est déjà ajouté
foreach ($amis_utilisateur_connecte as $ligne) {
    $champs = explode(';', $ligne);
    if ($champs[0] === $utilisateur_connecte && $champs[1] === $ami_username) {
        echo json_encode(["success" => false, "message" => "Ami déjà ajouté."]);
        header("Location: ../profil.php?username=$ami_username");
        exit;
    }
}

// Ajoute l'ami
$amis_utilisateur_connecte[] = $utilisateur_connecte . ';' .  $ami_username;
file_put_contents($chemin_fichier_amis, implode("\n", $amis_utilisateur_connecte));

$response = array(
    "success" => true,
    "ami_username" => $ami_username
);

echo json_encode($response);

header("Location: ../profil.php?username=$ami_username");
exit();
?>