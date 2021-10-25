<?php
// Startsidan. Glöm inte inkludera footer/header/functions-filerna på de sidor
// som behöver dom. Glöm inte heller session_start när det behövs!
require_once "includes/header.php";
?>
<!-- Kör en kontroll om vi är inloggade eller inte. Detta bestämmer vad som ska visas på home-sidan. -->
<main>
    <?php if (!isset($_SESSION["loggedIn"])) { ?>
        <div class="home">
            <h1> Welcome to IDDB! <br> The greatest dog database in the world!</h1>
            <p>You can <a href="/sign-in.php">Sign In</a> or <a href="/list.php"> See the list of our dogs.</a></p>
        </div>
    <?php } else { ?>
        <div class="home">
            <h1>Welcome back <?php echo $_SESSION["user"] ?></h1>
            <p>You can <a href="/sign-out.php">Sign Out</a> or <a href="/list.php"> see the list of the dogs.</a></p>
        </div>
    <?php } ?>
</main>

<?php
include "includes/footer.php";
?>