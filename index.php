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
            <h3 class="start">You can <a href='/sign-in.php'>sign in</a> or <a href='/list.php'>see the list of dogs.</a></h3>
            <!-- Tycker dessa är lite onödiga och dubbeltydliga eftersom vi har en nav med sign-in och dogs. Hade föredragit att lämna dem utanför men det stod som ett krav. -->
        </div>
    <?php } else { ?>
        <div class="home">
            <h1>Welcome <?php echo $_SESSION["user"] ?>!</h1>
            <h3 class="start">You can <a href='/sign-out.php'>sign out</a> or <a href='/list.php'>see the list of dogs.</a></h3>
            <!-- Tycker dessa är lite onödiga och dubbeltydliga eftersom vi har en nav med sign-in och dogs. Hade föredragit att lämna dem utanför men det stod som ett krav. -->
        </div>
    <?php } ?>
</main>

<?php
include "includes/footer.php";
?>