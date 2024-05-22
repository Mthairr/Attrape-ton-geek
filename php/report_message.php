<?php
session_start();

$_SESSION["oui"] = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['message_id'])) {
        $messageId = intval($_POST['message_id']);
        $fileLines = file("../donnee/message.txt");
        $line = count($fileLines);
        $_SESSION["oui"] = 1;
        if ($messageId > 0 && $messageId <= explode(";", $fileLines[$line-1])[0]) {
            $_SESSION["oui"] = 1;
            for($i=0; $i<$line; $i++){
                $message = explode(";", $fileLines[$i]);
                if($message[0] == $messageId){
                    file_put_contents('../donnee/reports.txt', implode(";", $message) . "\n", FILE_APPEND);
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
