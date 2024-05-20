 <?php
    session_start();

    if(count($_COOKIE) == 0){
        header('Location: index.php');
        exit();
    }

    $fileLines = count(file("../donnee/message.txt"));
    $file = fopen("../donnee/message.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if(strpos($tab[1], '%69') !== false) {
            $tab[1] = str_replace('%69', ';', $tab[1]);
        }
        if(($tab[2] == $_SESSION["username"] && $tab[3] == $_GET["username"])){
            echo "<br><p>" . $_SESSION["username"] . " : " . $tab[1] . " <button class='report-btn' data-message-id='" . $i ."'>Signaler</button></p>";
        }
        else if(($tab[2]==$_GET["username"] && $tab[3] == $_SESSION["username"])){
            echo "<br><p style='color:red;'>" . $_GET["username"] . " : " . $tab[1] . " <button class='report-btn' data-message-id='" . $i . "'>Signaler</button></p>";
        }
    }
?>


