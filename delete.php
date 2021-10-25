<?php
// Hanterar radering av en hund (obs. måste vara inloggad) och slussar sedan
// vidare användaren till profilsidan.
require_once "includes/functions.php";

?>
<?php
if (isset($_GET["id"])) {
    $deleteDogID = $_GET["id"];

    deleteTheDog($deleteDogID);
}

if (!isset($_SESSION["isLoggedIn"])) {
    header("Location /sign-in.php");
    exit();
}
?>