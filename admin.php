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
            <button class="logout" type="submit" name="log_out">Log out</button>
        </form>
        <?php
            session_start();
            if($_SESSION["admin"] == 1){
                echo '<button class="admin" type="submit" onclick="document.location.href=' . "'admin.php';" . '">Return admin mode</button>';
            }
        ?>
        <ul class="menu">
            <li><a class="active" href="Bienvenue.php">Votre profil</a></li>
            <li><a class="active1" href="message.php">Message</a></li>
            <li><a class="active2" href="search.php">Recherche</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <?php
            if(count($_COOKIE) > 0){
                if($_SESSION["admin"] != 1){
                    header('Location: Bienvenue.php');
                }
            }
            else{
                header('Location: index.php');
            }

            $fileLines = count(file("donnee/log.txt"));
            $file = fopen("donnee/log.txt", "c+");
            echo "List of persons : <br><br>";
            for($i=1; $i<=$fileLines; $i++){
                $tab = explode(";" ,fgets($file));
                 if($tab[0] != "admin"){
                    echo "<a style='color:yellow;' href='php/connexion.php?username=" . $tab[0] ."'>". $tab[0] ."</a><br><br>";
                 }
            }
            exit();
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.report-btn', function() {
                var messageId = $(this).data('message-id');

                $.ajax({
                    url: 'php/report_message.php',
                    type: 'POST',
                    data: { message_id: messageId },
                    success: function(response) {
                        alert('Message signalé avec succès.');
                    },
                    error: function() {
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    }
                });
            });
        });
    </script>
</body>
</html>