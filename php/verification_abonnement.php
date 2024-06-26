<?php
    session_start();
    if(is_numeric($_SESSION["abonnement"])){
        http_response_code(400);
        exit();
    }
    $now = new DateTime();
    $then = new DateTime($_SESSION["abonnement"]);
    if($then < $now){
        $username = $_SESSION['username'];
        $password = $_SESSION["password"];
        $age = $_SESSION["age"];
        $sexualindentity = $_SESSION['sexualindentity'];
        $prenom = $_SESSION['name'];
        $nom = $_SESSION['lastname'];
        $email = $_SESSION['email'];
        $ville = $_SESSION['town'];
        $pays = $_SESSION['country'];
        $adresse = $_SESSION['adress'];
        $character = $_SESSION['character'];
        $game = $_SESSION['game'];
        $type_game = $_SESSION['type_game'];
        $target_gender = $_SESSION['target_gender'];
        $height = $_SESSION['height'];
        $eyes = $_SESSION['eyes'];
        $description = $_SESSION['description'];
        $lignes = file('../donnee/log.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $nouvelle_lignes = [];

        foreach ($lignes as $ligne) {
            $champs = explode(';', $ligne);
            if ($champs[0] === $_SESSION["username"]) {
                $nouvelle_ligne = implode(';', [
                $username,
                $password,
                $age,
                $sexualindentity,
                $email,
                $prenom,
                $nom,
                $adresse,
                $ville,
                $pays,
                $character,
                $game,
                $type_game,
                $height,
                $eyes,
                $target_gender,
                $description,
                "0"
                ]);
                $nouvelle_lignes[] = $nouvelle_ligne;
            } else {
                $nouvelle_lignes[] = $ligne;
            }
        }
        file_put_contents('../donnee/log.txt', implode("\n", $nouvelle_lignes));
    }
    else{
        http_response_code(400);
        exit();
    }


?>