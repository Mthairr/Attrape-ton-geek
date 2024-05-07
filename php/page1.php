<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        if(!isset($_POST["username"]) || empty($_POST["username"])){
            header('Location: ../Login.php?d=1');
            throw new Exception("Le nom est incorrect");
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            header('Location: ../Login.php?d=1');
            throw new Exception("Le password est incorrect");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}
if(!(strpos($_POST["username"], ' ') === false)){
    header('Location: ../Login.php?d=1');
}
else{
    $fileLines = count(file("../donnee/log.txt"));
    $file = fopen("../donnee/log.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if($tab[0] == $_POST["username"]){
            if($tab[1] == hash('sha512',$_POST["password"])){
                //setcookie("username", $_POST["username"], time()+ 3600, "/");
                //setcookie("password", $_POST["password"], time()+ 3600, "/");
                session_start();
                $_SESSION['username'] = $_POST["username"];
                $_SESSION['password'] = $_POST['password'];
                header('Location: ../Bienvenue.php');
                exit();
            }
            else{
                header('Location: ../Login.php?d=1');
                exit();
            }
        }
    }
    header('Location: ../Login.php?d=1');
}

?>