<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Attrape ton geek</title>
        <link rel="stylesheet" href="css/signup.css">
        <meta name="description" content="">
        <link rel="icon" href="favicon2.ico" sizes="any">
    </head>
    
    <body>
        <nav class="navbar">
            <img src="img/_6b17619c-9f60-47a6-a1dc-98336a5b2e7a-removebg-preview.png" alt="Logo" class="logo" onclick="index()">
        </nav>

        <div class="wrapper">
            <form method="post" action="php/page2,5.php" enctype="multipart/form-data">
                <h1>~ Sign up ~</h1>
                <div class="input-box">
                    <input type="text", placeholder="Name" class="text1" name="name">
                </div>
                <div class="input-box">
                    <input type="text", placeholder="Last name" class="text1" name="lastname">
                </div>
                <div class="input-box">
                    <input type="email", placeholder="Email" class="text1" name="email">
                </div>
                <div class="input-box">
                    <input type="email" placeholder="Confirm your email" class="text1" name="email2">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Adress" class="text1" name="adress">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Town" class="text1" name="town">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Country" class="text1" name="country">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Adress" class="text1" name="adress">
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Favourite video game character" class="text1" name="character">
                </div>
                <div class="input-box">
                    <input type="file" name="img" accept="image/png, image/jpeg">
                </div>


                <button type="submit" class="btn">Sign up</button>

                <?php
                    
                    if(isset($_GET['d'])){
                        echo "<p id='error'>please enter a valid informations</p>";
                    }

                    session_start();
                    if(isset($_SESSION["name"])){
                        header('Location: Bienvenue.php');
                    }
                ?>

            </form>
        </div>



        <script src="js/app.js"></script>
        <script src="js/signup.js"></script>
    </body>
</html>