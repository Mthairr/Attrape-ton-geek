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
        if(!isset($_FILES["img"]) || empty($_FILES["img"])){
            header('Location: ../signup2.php?d=8');
            throw new Exception("Le pays est incorrect");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
        exit();
    }

    if($_POST["email"] != $_POST["email2"]){
        header('Location: ../signup2.php?d=10');
        exit();
    }
    $fileLines = count(file("../donnee/log.txt"));
    $file = fopen("../donnee/log.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if($tab[4] == $_POST["email"]){
            header('Location: ../signup2.php?d=9');
            exit();
        }
    }
    session_start();
    move_uploaded_file($_FILES["img"]["tmp_name"], "../img/" . $_SESSION["username"] . "." . pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
    file_put_contents('../donnee/log.txt', "\n" . $_SESSION["username"] . ';' . $_SESSION["password"] . ';' . $_SESSION["age"] . ';' . $_SESSION["sexualindentity"] . ";" . $_POST["email"] . ';' . $_POST["name"] . ';' . $_POST["lastname"] . ';' . $_POST["adress"] . ";" . $_POST["town"] . ";" . $_POST["country"] . ";" . $_POST["height"] . ";" . $_POST["eyes"] . ";" . $_POST["target_gender"] . ";0", FILE_APPEND);
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['adress'] = $_POST['adress'];
    $_SESSION['town'] = $_POST['town'];
    $_SESSION['country'] = $_POST['country'];
    $_SESSION['height'] = $_POST['height'];
    $_SESSION['eyes'] = $_POST['eyes'];
    $_SESSION['target_gender'] = $_POST['target_gender'];
    $_SESSION["admin"] = 0;
    $_SESSION['abonnement']=0;
    header('Location: ../Bienvenue.php');
}

?>