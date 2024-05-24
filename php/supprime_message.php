<?php
session_start();

if(count($_COOKIE) > 0){
    if(empty($_SESSION["name"])){
        header('Location: php/page3.php');
    }
}
else{
    header('Location: index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['message_id'])) {
        $messageId = intval($_POST['message_id']);
        $fileLines = file("../donnee/message.txt");
        $line = count($fileLines);
        if ($messageId > 0 && $messageId <= explode(";", $fileLines[$line-1])[0]) {
            for($i=0; $i<$line; $i++){
                $message = explode(";", $fileLines[$i]);
                if($message[0] == $messageId){
                    unset($fileLines[$i]);
                    file_put_contents("../donnee/message.txt", implode("", $fileLines));
                    echo "Message signalé avec succès.";
                    exit();
                }
            }
        } 
        else{
            echo "ID de message invalide.";
            http_response_code(400);
        }
    } 
    else{
        http_response_code(400);
        echo "Paramètre message_id manquant.";
    }
} 
else{
    http_response_code(405);
    echo "Méthode non autorisée.";
}
?>
