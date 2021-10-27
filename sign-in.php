<?php
// Inloggningssidan. Tänk på att formuläret kan skicka uppgifterna till denna
// filen också. Det gäller då att du t.ex. kontrollerar om $_POST innehåller
// något. Om inloggningen lyckas slussar du vidare dom till listningssidan.
//Kopplar headern
require_once "includes/header.php";

//Hanterar JSON
?>

<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];

    if ($error == 1) { //Fälten är tomma
        echo '<p class="error">Please fill out all fields.</p>';
    } elseif ($error == 2) { //fel lösenord
        echo '<p class="error">Incorrect password.</p>';
    } elseif ($error == 3) { //fel email
        echo '<p class="error">The email does not exist.</p>';
    } elseif ($error == 4) { //fel kombination av lösenord och
        echo '<p class="error">Incorrect username or password.</p>';
    }
}
?>

<!-- Inloggningsformulär -->
<div id="sign-in">
    <h2>Sign In</h2>
    <form method="POST" action="/check-login.php">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Sign In</button>
    </form>
</div>

<?php

require_once "includes/footer.php"; ?>