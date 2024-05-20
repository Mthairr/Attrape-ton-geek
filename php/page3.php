<?php
    // Parcours tous les cookies et les supprime en leur donnant une date d'expiration passée
    foreach($_COOKIE as $key => $value){
        setcookie($key, '', time() - 3600, "/"); // Expire une heure auparavant
    }
    session_destroy();
    // Redirige vers la page principale
    header("Location: ../index.php");

?>