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
        if(($tab[2] == $_SESSION["username"] && $tab[3] == $_GET["username"])){
            echo "<br><p>" . $_SESSION["username"] . " : " . $tab[1] . "</p>";
        }
        else if(($tab[2]==$_GET["username"] && $tab[3] == $_SESSION["username"])){
            echo "<br><p style='color:red;'>" . $_GET["username"] . " : " . $tab[1] . "</p>";
        }
    }
?>