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
        <form method="post" action="php/page1.php">
            <h1>~ Login ~</h1>
            <div class="input-box">
                <input type="text", placeholder="Username" class="text1" name="username">
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" class="text1" name="password">
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot password ?</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <?php
            if(isset($_GET['d'])){
                echo "<p id='error'>please enter a valid username or password</p>";
            }
            ?>
            <div class="register-link">
                <p>Dont have an account ? <a href="signup.html">Register</a></p>
            </div>
        </form>
    </div>
    <script src="js/app.js"></script>
</body>
</html>