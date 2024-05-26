<?php
session_start();
if (count($_COOKIE) > 0) {
    if (empty($_SESSION["name"])) {
        header('Location: page3.php');
    }
}else {
    header('Location: ../index.php');
}


$fileLines = file('../donnee/bloque.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
for($i=0; $i<count($fileLines); $i++){
    $message = explode(";", $fileLines[$i]);
    if($message[1] == $_GET['username'] && $message[0] == $_SESSION['username']){
        unset($fileLines[$i]);
        file_put_contents("../donnee/bloque.txt", implode("", $fileLines));
        header('Location: ../profil.php?username=' . $_GET['username']);
        exit();
    }
}

file_put_contents('../donnee/bloque.txt', "\n" . $_SESSION['username'] . ";" . $_GET['username'] . ';', FILE_APPEND);


header('Location: ../profil.php?username=' . $_GET['username']);
exit();
