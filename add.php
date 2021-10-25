<?php
// Sidan för att lägga till en ny hund, tänk på att man måste vara inloggad för
// att se och kunna besöka denna.
error_reporting(-1);

require_once "includes/functions.php";
require_once "includes/header.php";

if (!isset($_SESSION["loggedIn"])) {
    header("Location: /check-login.php");
    exit();
}
