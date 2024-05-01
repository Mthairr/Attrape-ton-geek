<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attrape ton geek</title>
    <link rel="stylesheet" href="css/login.css">
    <meta name="description" content="">
    <link rel="icon" href="favicon2.ico" sizes="any">
</head>
<body>
    <nav class="navbar">
        <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
    </nav>
    <div class="wrapper">
        <?php
            if(count($_COOKIE) == 0){
                header('Location: index.php');
                exit();
            }

            if(!isset($_GET['username'])){
                echo "<p id='error'>User don't existe</p>";
                exit();
            }

            if($_GET['username'] == $_COOKIE['username']){
                echo "<p id='error'>You can't send message to yourself</p>";
                exit();
            }
            $rep=0;
            $fileLines = count(file("donnee/log.txt"));
            $file = fopen("donnee/log.txt", "c+");
            for($i=1; $i<=$fileLines; $i++){
                $tab = explode(";" ,fgets($file));
                if($tab[0] == $_GET["username"]){
                    $rep=1;
                    break;
                }
            }
            if($rep == 0){
                echo "<p id='error'>User don't existe</p>";
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
                    file_put_contents('donnee/message.txt', "\n" . $fileLines . ';' . str_replace(array("\r", "\n", "\r\n"), ' ', nl2br($_POST["message"])) . ';' . $_COOKIE["username"] . ';' . $_GET["username"] . ";", FILE_APPEND);
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
    <script src="js/app.js"></script>
</body>
</html>