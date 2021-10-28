<?php
// Hanterar radering av en hund (obs. måste vara inloggad) och slussar sedan
// vidare användaren till profilsidan.
require_once "includes/functions.php";

?>
<?php
//Kontrollerar om GET har ett id och kör sen deletfunktionen
if (isset($_GET["id"])) {
    $deleteDogID = $_GET["id"];

    deleteTheDog($deleteDogID);
}
//Om användare inte är inloggad slussas man vidare till inloggningssidan
if (!isset($_SESSION["isLoggedIn"])) {
    header("Location /sign-in.php");
    exit();
}
?>

