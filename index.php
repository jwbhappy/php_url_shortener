<?php
    include 'app/config.php';
    include 'app/link_generator.php';
    include 'app/redirection.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Short URLs</title>
</head>
<body>
    <header>
        <div class="auth-links">
            <a href="/login.php">Log in</a> | 
            <a href="/signup.php">Sign up</a>
        </div>
    </header>
    <div class="main-page-title">
        <h1>Get your URL shortened!</h1>
    </div>
    <div class="form">
        <form action="" method="post" id="form">
            <input id="input" type="text" name="orig_url" placeholder="Paste your url here">
            <input id="submit" type="submit" value="submit">
        </form>
    </div>
    <div class="message"></div>
    <div class="urls">
        <div class="url hidden">
            <div class="id"><i class="uil uil-copy copy-icon"></i></div>
            <div class="short-url"><a href=""></a></div>
            <div class="long-url"></div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
