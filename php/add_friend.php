<?php
session_start();
if (count($_COOKIE) > 0) {
    if (empty($_SESSION["name"])) {
        header('Location: page3.php');
    }
}else {
    header('Location: ../index.php');
}


$fileLines = file('../donnee/friends.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
for($i=0; $i<count($fileLines); $i++){
    $message = explode(";", $fileLines[$i]);
    if($message[1] == $_GET['username'] && $message[0] == $_SESSION['username']){
        unset($fileLines[$i]);
        file_put_contents("../donnee/friends.txt", implode("", $fileLines));
        header('Location: ../profil.php?username=' . $_GET['username']);
        exit();
    }
}


$amis_utilisateur_connecte[] = $_SESSION['username'] . ';' .  $_GET['username'];
file_put_contents('../donnee/friends.txt', implode("\n", $amis_utilisateur_connecte));
$ami_username=$_GET['username'];
$response = array(
    "success" => true,
    "ami_username" => $ami_username
);

echo json_encode($response);

header("Location: ../profil.php?username=$ami_username");
exit();
