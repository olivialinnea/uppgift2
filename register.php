<?php

error_reporting(-1);

require_once "includes/functions.php";
require_once "includes/header.php";

if (isset($_POST["email"], $_POST["userName"], $_POST["password"])) {
    $email = $_POST["email"];
    $username = $_POST["userName"];
    $password = $_POST["password"];

    if ($username == "" || $email == "" || $password == "") {
        header("Location: /register.php?error=1");
        exit();
    }
    addNewUser($_POST);
}
?>

<div id="add">
    <h2 class="title">Register here!</h2>
    <form action="/register.php" method="POST">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="userName" placeholder="Username">
        <input type="password" min="0" name="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>
    <?php
    if (isset($_POST["email"], $_POST["userName"], $_POST["password"])) { ?>
        <p>Welcome <?php echo $_POST["userName"] ?>! Your registration is complete!</p>
    <?php } ?>

    <?php
    if (isset($_GET["error"])) {
        $error = $_GET["error"]; ?>
        <?php if ($error == 1) { ?>
            <p class="error">Please leave no empty fields!</p>
        <?php } ?>
    <?php } ?>
</div>