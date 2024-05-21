<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        if(!isset($_POST["username"]) || empty($_POST["username"])){
            header('Location: ../Login.php?d=5');
            throw new Exception("Le nom est incorrect");
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            header('Location: ../Login.php?d=4');
            throw new Exception("Le password est incorrect");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

if(!(strpos($_POST["username"], ' ') === false)){
    header('Location: ../Login.php?d=3');
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
                if($_POST["username"] == "admin"){
                    $_SESSION['admin'] = 1;
                    $_SESSION['name'] = "admin" ;
                    header('Location: ../admin.php');
                    exit();
                }
                $_SESSION['username'] = $_POST["username"];
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
                $_SESSION["admin"] = 0;
                header('Location: ../Bienvenue.php');
                exit();
            }
            else{
                header('Location: ../Login.php?d=1');
                exit();
            }
        }
    }
    header('Location: ../Login.php?d=2');
}

?>