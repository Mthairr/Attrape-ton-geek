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

    if($_SESSION["admin"] == 1){
        $fileLines = count(file("../donnee/log.txt"));
        $file = fopen("../donnee/log.txt", "c+");
        for($i=1; $i<=$fileLines; $i++){
            $tab = explode(";" ,fgets($file));
            if($tab[0] == $_GET["username"]){
                $_SESSION['username'] = $_GET["username"];
                $_SESSION['password'] = $tab[1];
                $_SESSION['age'] = $tab[2];
                $_SESSION['sexualindentity'] = $tab[3];
                $_SESSION['email'] = $tab[4];
                $_SESSION['name'] = $tab[5];
                $_SESSION['lastname'] = $tab[6];
                $_SESSION['adress'] = $tab[7];
                $_SESSION['town'] = $tab[8];
                $_SESSION['country'] = $tab[9];
                $_SESSION['character'] = $tab[10];
                $_SESSION['game'] = $tab[11];
                $_SESSION['type_game'] = $tab[12];
                $_SESSION['height'] = $tab[13];
                $_SESSION['eyes'] = $tab[14];
                $_SESSION['target_gender'] = $tab[15];
                $_SESSION['description'] = $tab[16];
                $_SESSION['abonnement']=$tab[17];
                if(isset($_GET["goto"])){
                    header('Location: ../message.php?username=' . $_GET["goto"]);
                    exit();
                }
                header('Location: ../Bienvenue.php');
                exit();
            }
        }
    }
?>