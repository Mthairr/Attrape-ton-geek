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
            <li><a class="active3" href="subscription.php">Abonnements</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <?php
            if(count($_COOKIE) > 0){
                if(empty($_SESSION["name"])){
                    header('Location: php/page3.php');
                }
            }
            else{
                header('Location: index.php');
            }

            $fileLines = count(file("donnee/log.txt"));
            $file = fopen("donnee/log.txt", "c+");
            if(!isset($_GET['username'])){
                echo "Listes des personnes inscrites : <br><br>";
                echo '<dix class="scroll-container">';
                for($i=1; $i<=$fileLines; $i++){
                    $tab = explode(";" ,fgets($file));
                     if($tab[0] != $_SESSION["username"] && $tab[0] != "admin"){
                        echo "<a style='color:yellow;' href='message.php?username=" . $tab[0] ."'>". $tab[0] ."</a><br><br>";
                     }
                }
                echo '</div>';
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
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["message"]) && !empty($_POST["message"])){
                    $tab = file('donnee/message.txt');
                    $fileLines = count($tab);
                    if($fileLines == 0){
                        $tab[0] = 0;
                    }
                    else{
                        $tab = explode(";" ,$tab[count($tab)-1]);
                    }
                    if(strpos($_POST["message"], ';') !== false){
                        $_POST["message"] = str_replace(';', '%69', $_POST["message"]);
                    }
                    file_put_contents('donnee/message.txt', $tab[0]+1 . ';' . str_replace(array("\r", "\n", "\r\n"), ' ', nl2br($_POST["message"])) . ';' . $_SESSION["username"] . ';' . $_GET["username"] . ";" . "\n", FILE_APPEND);
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

        function signal(aa) {
                var messageId = aa.id;
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
            }

        // Fonction pour ajouter le bouton
        function addButton(paragraph) {
            // Créez le bouton
            const button = document.createElement('button');
            button.textContent = 'Signaler';
            button.className = 'report-btn';
            button.setAttribute('id', paragraph.id);
            button.setAttribute('type', "button");
            
            button.setAttribute('onmouseleave', 'handleMouseLeave(this)');
            button.setAttribute('onmouseover', 'handleMouseOver(this)');

            // Ajoutez le bouton à l'intérieur du paragraphe
            paragraph.appendChild(button);
        }

        // Fonction appelée lors du survol du paragraphe
        function handleMouseOver(paragraph) {
            if (paragraph.tagName === 'BUTTON') {
                paragraph = paragraph.parentElement;
            }
            if (!paragraph.querySelector('.report-btn')) {
                addButton(paragraph);
            }
        }

        // Fonction appelée lorsque la souris quitte le paragraphe ou le bouton
        function handleMouseLeave(element) {
            setTimeout(() => {
                const paragraph = element.tagName === 'BUTTON' ? element.parentElement : element;
                const button = paragraph.querySelector('.report-btn');
                if (!paragraph.matches(':hover') && (!button || !button.matches(':hover'))) {
                    if (button) button.remove();
                }
            }, 200); // Utilisez un léger délai pour permettre la vérification
        }
    </script>
</body>
</html>