<?php
// Utloggning. Töm sessionen på data innan du slussar vidare dom till start-
// eller inloggningssidan.
session_start();
//raderar sessionen helt
session_destroy();

//Skickar tillbaka användaren till home-sidan.
header("Location: /index.php");
exit();
