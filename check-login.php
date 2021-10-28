<?php
error_reporting(-1);
session_start();

require_once "includes/functions.php"
?>
<?php
//Ny php-fil skapad för att undvika header error som krockade med location i sign-in. Ingen vet varför detta händer hela tiden.

//Hämtar användare
$users = getUsersFromDB();

if (isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    foreach ($users as $user) {
        if ($user["email"] == $email && $user["password"] == $password) {
            //Skapar en sessionsanvändare
            $_SESSION["loggedIn"] = true;
            //skapar nyckel för användarnamn.
            $_SESSION["user"] = $user["username"];
            //skapar nyckel för id
            $_SESSION["id"] = $user["id"];
            //väl sparat så skickas man vidare till listan av hundar.
            header("Location: /list.php");
            exit();
        }
    }
    //Error för tomma fält
    if ($email == "" || $password == "") {
        header("Location: /sign-in.php?error=1");
        exit();
        //email stämmer inte
    } elseif ($email == $user["email"] && $password !== $user["password"]) {
        header("Location: /sign-in.php?error=2");
        exit();
        //lösenordet stämmer inte med emailen
    } elseif ($email !== $user["email"] && $password == $user["password"]) {
        header("Location: /sign-in.php?error=3");
        exit();
    } else { //användarnamn/lösen stämmer inte
        header("Location: /sign-in.php?error=4");
        exit();
    }
}
