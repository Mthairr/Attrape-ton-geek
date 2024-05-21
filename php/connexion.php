<?php
    session_start();
    if($_SESSION["admin"] == 1){
        $fileLines = count(file("../donnee/log.txt"));
        $file = fopen("../donnee/log.txt", "c+");
        for($i=1; $i<=$fileLines; $i++){
            $tab = explode(";" ,fgets($file));
            if($tab[0] == $_GET["username"]){
                $_SESSION['username'] = $tab[0];
                $_SESSION['password'] = $tab[1];
                $_SESSION['age'] = $tab[2];
                $_SESSION['sexualindentity'] = $tab[3];
                $_SESSION['email'] = $tab[4];
                $_SESSION['name'] = $tab[5];
                $_SESSION['lastname'] = $tab[6];
                $_SESSION['adress'] = $tab[7];
                $_SESSION['town'] = $tab[8];
                $_SESSION['country'] = $tab[9];
                $_SESSION['height'] = $tab[10];
                $_SESSION['eyes'] = $tab[11];
                $_SESSION['target_gender'] = $tab[12];
                header('Location: ../Bienvenue.php');
                exit();
            }
        }
    }
?>