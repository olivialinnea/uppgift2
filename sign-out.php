<?php
// Utloggning. Töm sessionen på data innan du slussar vidare dom till start-
// eller inloggningssidan.
session_start();
//Raderar alla sessions nycklar


//raderar sessionen
session_destroy();

//
header("Location: /index.php");
exit();
