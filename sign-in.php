<?php
// Inloggningssidan. Tänk på att formuläret kan skicka uppgifterna till denna
// filen också. Det gäller då att du t.ex. kontrollerar om $_POST innehåller
// något. Om inloggningen lyckas slussar du vidare dom till listningssidan.

//Kontrollerar fel
error_reporting(-1);
//Startar en ny session
session_start();
//Kopplar headern
require_once "includes/header.php";

//Hanterar JSON
$json = file_get_contents("db.json");
$data = json_decode($json, true);
?>

<?php
$users = $data["users"];

if (isset($_POST["email"], $_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    foreach ($users as $user) {
        if ($email == $user["email"] && $password == $user["password"]) {
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
        //
    } else { //användarnamn/lösen stämmer inte
        header("Location: /sign-in.php?error=4");
        exit();
    }
}

if (isset($_GET["error"])) {
    $error = $_GET["error"];

    if ($error == 1) { //Fälten är tomma
        echo '<p class="error">Please fill out all fields.</p>';
    } elseif ($error == 2) { //fel lösenord
        echo '<p class="error">Incorrect password.</p>';
    } elseif ($error == 3) { //fel email
        echo '<p class="error">The email does not exist.</p>';
    } elseif ($error == 4) { //fel kombination av user/pass - existerar inte alls
        echo '<p class="error">Incorrect username or password.</p>';
    }
}
?>

<!-- Inloggningsformulär -->
<div id="sign-in">
    <form action="POST" action="/sign-in.php">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Sign In</button>
    </form>
</div>