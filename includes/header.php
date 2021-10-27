<?php
// Start på er HTML (doctype, body, navigation)//Kontrollerar fel
error_reporting(-1);
//Startar en ny session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">

    <title>IDDB</title>
</head>

<body>
    <main>
        <header>
            <div id="header-image">
                <p>The Internet <br> Dog Database</p>
            </div>
        </header>
        <div id="wrapper">
            <!-- Kontrollerar vilken nav som ska visas beroende på om man är inloggad eller inte. -->
            <?php
            if (!isset($_SESSION["loggedIn"])) { ?>
                <nav>
                    <h2><a href='/index.php'>Home</a></h2>
                    <h2><a href='/list.php'>Dogs</a></h2>
                    <h2><a href='/sign-in.php'>Sign In</a></h2>
                    <h2><a href='/register.php'>Register Here</a></h2>
                </nav>
            <?php } else { ?>
                <nav>
                    <h2><a href='/index.php'>Home</a></h2>
                    <h2><a href='/list.php'>Dogs</a></h2>
                    <h2><a href='/add.php'>Add</a></h2>
                    <h2><a href='/profile.php'>Profile</a></h2>
                    <h2><a href='/sign-out.php'>Sign Out</a></h2>
                </nav>
            <?php } ?>
        </div>