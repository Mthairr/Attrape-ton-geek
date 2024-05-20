<?php
session_start();

if (count($_COOKIE) == 0) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['message_id'])) {
        $messageId = intval($_POST['message_id']);
        $fileLines = file("../donnee/message.txt");
        if ($messageId > 0 && $messageId <= count($fileLines)) {
            $message = $fileLines[$messageId - 1];
            file_put_contents('../donnee/reports.txt', $message . "\n", FILE_APPEND);
            echo "Message signalé avec succès.";
            exit();
        } else {
            http_response_code(400);
            echo "ID de message invalide.";
        }
    } else {
        http_response_code(400);
        echo "Paramètre message_id manquant.";
    }
} else {
    http_response_code(405);
    echo "Méthode non autorisée.";
}
?>
