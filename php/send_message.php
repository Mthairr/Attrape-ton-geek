 <?php
    $fileLines = count(file("../donnee/message.txt"));
    $file = fopen("../donnee/message.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if(($tab[2] == $_COOKIE["username"] && $tab[3] == $_GET["username"])){
            echo "<br><br>" . $_COOKIE["username"] . " : " . $tab[1];
        }
        else if(($tab[2]==$_GET["username"] && $tab[3] == $_COOKIE["username"])){
            echo "<br><br><p style='color:red;'>" . $_GET["username"] . " : " . $tab[1] . "</p>";
        }
    }
?>