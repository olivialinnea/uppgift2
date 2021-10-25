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

if (isset($_POST["dogName"], $_POST["breed"], $_POST["age"], $_POST["notes"])) {
    $name = $_POST["dogName"];
    $breed = $_POST["breed"];
    $age = $_POST["age"];
    $notes = $_POST["notes"];

    if ($name == "" || $breed == "" || $age == "" || $notes == "") {
        header("Location: /add.php?error=1");
        exit();
    }
    addNewDog($_POST);
}
?>

<div id="add">
    <h2 class="title">Add your doggo here!</h2>
    <form action="/add.php" method="POST">
        <input type="text" name="dogName" placeholder="Name">
        <input type="text" name="breed" placeholder="Breed">
        <input type="number" min="0" name="age" placeholder="Age">
        <input type="text" name="notes" placeholder="Notes about them">
        <button type="submit">Add</button>
    </form>
    <?php
    if (isset($_POST["dogName"], $_POST["breed"], $_POST["age"], $_POST["notes"])) { ?>
        <p>You added <?php echo $_POST["dogName"] ?>, who is a <?php echo $_POST["age"] ?> year old <?php echo $_POST["breed"] ?>!</p>
    <?php } ?>

    <?php
    if (isset($_GET["error"])) {
        $error = $_GET["error"]; ?>
        <?php if ($error == 1) { ?>
            <p class="error">Please leave no empty fields!</p>
        <?php } ?>
    <?php } ?>
</div>