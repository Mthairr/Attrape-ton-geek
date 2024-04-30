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
            <form method="post" action="php/page2.php">
                <h1>~ Sign up ~</h1>
                <div class="input-box">
                    <input type="text", placeholder="Username" class="text1" name="username">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" class="text1" name="password">
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Confirm your password" class="text1" name="password2">
                </div>
                <div class="input-container">
                    <div class="select-one">
                        <p>I am a :</p>
                        <select name="sexualindentity">
                            <option value="null"></option>
                            <option value="Man">Man</option>
                            <option value="Woman">Woman</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="age">
                        <select name="age" id="age">
                            <option value="" disbaled selected>Choose your age</option>
                        </select>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox">Remember me</label>
                </div>
                
    
                <button type="submit" class="btn">Sign up</button>
                <?php
                if(isset($_GET['d'])){
                    echo "<p id='error'>please enter a valid informations</p>";
                }
                ?>
    
            </form>
        </div>



        <script src="js/signup.js"></script>
    </body>
</html>