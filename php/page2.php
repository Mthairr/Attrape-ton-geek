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
    }
}
if(!(strpos($_POST["username"], ' ') === false) || $_POST["password"] != $_POST["password2"]){
    header('Location: ../signup.php?d=1');
}
else{
    file_put_contents('../donnee/log.txt', "\n" . $_POST["username"] . ';' . $_POST["password"] . ';' . $_POST["age"] . ';' . $_POST["sexualindentity"], FILE_APPEND);
    echo "age : " . $_POST["age"] . "<br> selct : " . $_POST["sexualindentity"] . "<br> username : " . $_POST["username"] . "<br>" . "password : " . $_POST["password"];
}

?>