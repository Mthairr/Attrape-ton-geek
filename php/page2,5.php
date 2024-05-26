<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        if(!isset($_POST["name"]) || empty($_POST["name"])){
            header('Location: ../signup2.php?d=1');
            throw new Exception("L'email est incorrect");
        }
        if(!isset($_POST["lastname"]) || empty($_POST["lastname"])){
            header('Location: ../signup2.php?d=2');
            throw new Exception("L'email est incorrect");
        }
        if(!isset($_POST["email"]) || empty($_POST["email"])){
            header('Location: ../signup2.php?d=3');
            throw new Exception("L'email est incorrect");
        }
        if(!isset($_POST["email2"]) || empty($_POST["email2"])){
            header('Location: ../signup2.php?d=4');
            throw new Exception("L'email est incorrect");
        }
        if(!isset($_POST["adress"]) || empty($_POST["adress"])){
            header('Location: ../signup2.php?d=5');
            throw new Exception("L'adresse est incorrect");
        }
        if(!isset($_POST["town"]) || empty($_POST["town"])){
            header('Location: ../signup2.php?d=6');
            throw new Exception("La ville est incorrect");
        }
        if(!isset($_POST["country"]) || empty($_POST["country"])){
            header('Location: ../signup2.php?d=7');
            throw new Exception("Le pays est incorrect");
        }
        if(!isset($_POST["character"]) || empty($_POST["character"])){
            header('Location: ../signup2.php?d=8');
            throw new Exception("Le personnage de jeux vidéo est incorrect");
        }
        if(!isset($_POST["game"]) || empty($_POST["game"])){
            header('Location: ../signup2.php?d=9');
            throw new Exception("Le jeu vidéo est incorrect");
        }
        if(!isset($_FILES["img"]) || empty($_FILES["img"])){
            header('Location: ../signup2.php?d=10');
            throw new Exception("Le format de l'image est incorrect");
        }
        if(!isset($_POST["description"]) || empty($_POST["description"])){
            header('Location: ../signup2.php?d=11');
            throw new Exception("La description est incorrect");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
        exit();
    }

    if($_POST["email"] != $_POST["email2"]){
        header('Location: ../signup2.php?d=13');
        exit();
    }

    if(!(strpos($_POST["email"], ';') === false) || !(strpos($_POST["name"], ';') === false) || !(strpos($_POST["lastname"], ';') === false) || !(strpos($_POST["adress"], ';') === false) || !(strpos($_POST["town"], ';') === false) || !(strpos($_POST["country"], ';') === false) || !(strpos($_POST["character"], ';') === false) || !(strpos($_POST["description"], ';') === false)){
        header('Location: ../signup2.php?d=14');
        exit();
    }

    $fileLines = count(file("../donnee/log.txt"));
    $file = fopen("../donnee/log.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if($tab[4] == $_POST["email"]){
            header('Location: ../signup2.php?d=12');
            exit();
        }
    }

    session_start();
    move_uploaded_file($_FILES["img"]["tmp_name"], "../img/" . $_SESSION["username"] . "." . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
    file_put_contents('../donnee/log.txt', "\n" . $_SESSION["username"] . ';' . $_SESSION["password"] . ';' . $_SESSION["age"] . ';' . $_SESSION["sexualindentity"] . ";" . $_POST["email"] . ';' . $_POST["name"] . ';' . $_POST["lastname"] . ';' . $_POST["adress"] . ";" . $_POST["town"] . ";" . $_POST["country"] . ";" . $_POST["character"] . ";" . $_POST["game"] . ";" . $_POST["type_game"] . ";" . $_POST["height"] . ";" . $_POST["eyes"] . ";" . $_POST["target_gender"] . ";" . $_POST["description"] . ";0", FILE_APPEND);
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['adress'] = $_POST['adress'];
    $_SESSION['town'] = $_POST['town'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['character'] = $_POST['character'];
    $_SESSION['game'] = $_POST['game'];
    $_SESSION['type_game'] = $_POST['type_game'];
    $_SESSION['height'] = $_POST['height'];
    $_SESSION['eyes'] = $_POST['eyes'];
    $_SESSION['target_gender'] = $_POST['target_gender'];
    $_SESSION['description'] = $_POST['description'];
    $_SESSION["admin"] = 0;
    $_SESSION['abonnement']=0;
    header('Location: ../Bienvenue.php');
}

?>
