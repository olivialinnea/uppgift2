<?php
// Startsidan. Glöm inte inkludera footer/header/functions-filerna på de sidor
// som behöver dom. Glöm inte heller session_start när det behövs!
require_once "includes/header.php";
?>
<!-- Kör en kontroll om vi är inloggade eller inte. Detta bestämmer vad som ska visas på home-sidan. -->
<main>
    <?php if (!isset($_SESSION["loggedIn"])) { ?>
        <div class="home">
            <h1> Welcome to IDDB! <br> The greatest dog database <br> in the world!</h1>
        </div>
    <?php } else { ?>
        <div class="home">
            <h1>Welcome back <?php echo $_SESSION["user"] ?>!</h1>
            <div id="happyDog"><img src="/assets/images/log-in.png"></div>
        </div>
    <?php } ?>
</main>

<?php
include "includes/footer.php";
?>