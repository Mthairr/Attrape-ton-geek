<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        if(!isset($_POST["username"]) || empty($_POST["username"])){
            header('Location: ../signup.php?d=1');
            throw new Exception("Le nom est incorrect");
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            header('Location: ../signup.php?d=1');
            throw new Exception("Le password est incorrect");
        }
        if(!isset($_POST["password2"]) || empty($_POST["password2"])){
            header('Location: ../signup.php?d=1');
            throw new Exception("Le password est incorrect");
        }
        if(!isset($_POST["age"]) || empty($_POST["age"])){
            header('Location: ../signup.php?d=1');
            throw new Exception("L'age' est incorrect");
        }
        if(!isset($_POST["sexualindentity"]) || empty($_POST["sexualindentity"])){
            header('Location: ../signup.php?d=1');
            throw new Exception("L'indentite est incorrect");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
        exit();
    }

    if(!(strpos($_POST["username"], ' ') === false) || $_POST["password"] != $_POST["password2"]){
        header('Location: ../signup.php?d=1');
        exit();
    }
    $date = $_POST["age"];
    $ajd = new DateTime();
    $date = new DateTime($date);
    $diff = $ajd->diff($date);
    $age = $diff->y;
    if($age < 18){
        header("Location: forbidden.php");
        exit();
    }
    $fileLines = count(file("../donnee/log.txt"));
    $file = fopen("../donnee/log.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if($tab[0] == $_POST["username"]){
            header('Location: ../signup.php?d=1');
            exit();
        }
    }
    file_put_contents('../donnee/log.txt', "\n" . $_POST["username"] . ';' . hash('sha512',$_POST["password"]) . ';' . $_POST["age"] . ';' . $_POST["sexualindentity"] . ";", FILE_APPEND);
    session_start();
    $_SESSION["username"] = $_POST["username"];
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['password'] = $_POST['password'];
    header('Location: ../signup2.php');
}

?>