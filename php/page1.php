<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try{
        if(!isset($_POST["username"]) || empty($_POST["username"])){
            header('Location: index.php');
            throw new Exception("Le nom est incorrect");
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])){
            header('Location: index.php');
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
    echo $_POST["username"] . "<br>" . "password : " . $_POST["password"];
}

?>