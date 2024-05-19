<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek</title>
    <link rel="stylesheet" href="css/login.css">
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
    <script src="js/app.js"></script>
</head>
<body>
    <nav class="navbar">
        <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
        <form method="post" action="php/page3.php">
            <button type="submit" name="log_out">Log out</button>
        </form>
        <ul class="menu">
            <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
            <li><a class="active1" href="message.php">Message</a></li>
            <li><a class="active2" href="search.php">Recherche</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <?php
            session_start();

            if(count($_COOKIE) == 0){
                header('Location: index.php');
                exit();
            }

            $fileLines = count(file("donnee/log.txt"));
            $file = fopen("donnee/log.txt", "c+");
            if(!isset($_GET['username'])){
                echo "List of persons : <br><br>";
                for($i=1; $i<=$fileLines; $i++){
                    $tab = explode(";" ,fgets($file));
                     if($tab[0] != $_SESSION["username"]){
                        echo "<a style='color:yellow;' href='message.php?username=" . $tab[0] ."'>". $tab[0] ."</a><br><br>";
                     }
                }
                exit();
            }

            if($_GET['username'] == $_SESSION['username']){
                echo "<p id='error'>You can't send message to yourself</p>";
                exit();
            }

            $rep=0;
            for($i=1; $i<=$fileLines; $i++){
                $tab = explode(";" ,fgets($file));
                if($tab[0] == $_GET["username"]){
                    $rep=1;
                    break;
                }
            }
            if($rep == 0){
                echo "<p id='error'>User doesn't exist</p>";
                exit();
            }
        ?>
        <form method="post" action="">
            <textarea name="message"></textarea>
            <br><br>
            <button type="submit" class="btn">Send</button>
            <section id=message></section>
            <?php
            $fileLines = count(file("donnee/message.txt"));
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["message"]) && !empty($_POST["message"])){
                    $fileLines = $fileLines + 1;
                    if(strpos($_POST["message"], ';') !== false){
                        $_POST["message"] = str_replace(';', '%69', $_POST["message"]);
                    }
                    file_put_contents('donnee/message.txt', "\n" . $fileLines . ';' . str_replace(array("\r", "\n", "\r\n"), ' ', nl2br($_POST["message"])) . ';' . $_SESSION["username"] . ';' . $_GET["username"] . ";", FILE_APPEND);
                }
            }
            ?>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        setInterval('load_messages()', 500);
        function load_messages(){
            var urlcourante = document.location.href;
            var urlcourante = urlcourante.replace(/\/$/, "");

            queue_url = urlcourante.substring (urlcourante.lastIndexOf( "=" )+1 );

            $('#message').load('php/send_message.php?username='+queue_url);
        }

        load_messages();
    </script>
</body>
</html>