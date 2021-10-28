<?php
// Sidan för att lägga till en ny hund, tänk på att man måste vara inloggad för
// att se och kunna besöka denna.
error_reporting(-1);
require_once "includes/functions.php";
require_once "includes/header.php";

//Kontrollerar om man är inloggad eller inte
if (!isset($_SESSION["loggedIn"])) {
    header("Location: /check-login.php");
    exit();
}
//Kollar vad som är skrivet i våra inputs och skapar variabler med dess info
if (isset($_POST["dogName"], $_POST["breed"], $_POST["age"], $_POST["notes"])) {
    $name = $_POST["dogName"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $notes = $_POST["notes"];

    //Om inputsen är tomma skapas inte en ny hund och ett error visas
    if ($name == "" || $breed == "" || $age == "" || $notes == "") {
        $error = 1;
    } else {
        addNewDog($_POST);
    }
}
?>

<!-- Skapar vårt forumulär för att lägga till hunden. -->
<div id="add">
    <h2 class="title">Add your furry friend here</h2>
    <form action="/add.php" method="POST">
        <input type="text" name="dogName" placeholder="Name">
        <input type="text" name="breed" placeholder="Breed">
        <input type="number" min="0" name="age" placeholder="Age">
        <input type="text" name="notes" placeholder="Notes about them">
        <button type="submit">Add</button>
    </form>
    <?php
    //Lägger antingen till ett errormeddelande eller bekräftar att hunden har lagts till
    if (isset($error)) { ?>
        <p class="error">Please leave no empty fields!</p>
    <?php } elseif (isset($_POST["dogName"], $_POST["breed"], $_POST["age"], $_POST["notes"])) { ?>
        <p id="add">You added <?php echo $_POST["dogName"] ?>, who is a <?php echo $_POST["age"] ?> year old <?php echo $_POST["breed"] ?>!</p>
    <?php } ?>
</div>