 <?php
    session_start();

    if(count($_COOKIE) > 0){
        if(empty($_SESSION["name"])){
            header('Location: page3.php');
        }
    }
    else{
        header('Location: ../index.php');
    }

    if(is_numeric($_SESSION['abonnement'])){
         if ($_SESSION['abonnement']==0){
             echo "Vous devez être abonné pour accéder à la messagerie.";
             exit();
         }
     }

    $fileLines = count(file("../donnee/message.txt"));
    $file = fopen("../donnee/message.txt", "c+");
    for($i=1; $i<=$fileLines; $i++){
        $tab = explode(";" ,fgets($file));
        if(strpos($tab[1], '%69') !== false) {
            $tab[1] = str_replace('%69', ';', $tab[1]);
        }
        if($_SESSION["admin"] == 1){
            if(($tab[2] == $_SESSION["username"] && $tab[3] == $_GET["username"])){
                echo "<br><p id=" . $tab[0] . ">" . $_SESSION["username"] . " : " . $tab[1] . "<button type='button' id=" . $tab[0] . " class='report-btn' onclick='suppr(this);'>supprimer</button></p>";
            }
            else if(($tab[2]==$_GET["username"] && $tab[3] == $_SESSION["username"])){
                echo "<br><p id=" . $tab[0] . " class=mouse style='color:red;'>" . $_GET["username"] . " : " . $tab[1] . "<button type='button' id=" . $tab[0] . " class='report-btn' onclick='suppr(this);'>supprimer</button></p>";
            }
        }
        else{
            if(($tab[2] == $_SESSION["username"] && $tab[3] == $_GET["username"])){
                echo "<br><p id=" . $tab[0] . ">" . $_SESSION["username"] . " : " . $tab[1] . "</p>";
            }
            else if(($tab[2]==$_GET["username"] && $tab[3] == $_SESSION["username"])){
                echo "<br><p id=" . $tab[0] . " class=mouse style='color:red;' onmouseover='handleMouseOver(this)' onmouseleave='handleMouseLeave(this)' onclick='signal(this);'>" . $_GET["username"] . " : " . $tab[1] . "</p>";
            }
        }
        
    }
?>


