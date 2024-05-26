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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fichier="../donnee/log.txt";
        if (file_exists($fichier)) {
            
            $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            if(isset($_POST["abonnement1"]) || isset($_POST["abonnement2"]) || isset($_POST["abonnement3"])){
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
                $target_gender = $_SESSION['target_gender'];
                $height = $_SESSION['height'];
                $eyes = $_SESSION['eyes'];
                if(isset($_POST["abonnement1"])){
                    $abonnement = new DateTime();
                    $abonnement->modify('+1 month');
                }
                if(isset($_POST["abonnement2"])){
                    $abonnement = new DateTime();
                    $abonnement->modify('+12 month');
                }
                $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
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
                            $height,
                            $eyes,
                            $target_gender,
                            (isset($_POST["abonnement3"])) ? 1 : $abonnement->format('Y-m-d')
                        ]);
                        $nouvelle_lignes[] = $nouvelle_ligne;
                    } else {
                        $nouvelle_lignes[] = $ligne;
                    }
                }
                file_put_contents($fichier, implode("\n", $nouvelle_lignes) . ";"); 
                $_SESSION['abonnement']=$abonnement;
                header('Location: ../abonne.php');
                exit;
                
            }
        }
        
    }







