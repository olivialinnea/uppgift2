<?php
// Samling av relevanta funktioner, t.ex.:
// - Hämta en användare från databasen
// - Hämta alla hundar från databasen
// - Hämta en hund från databasen
// - Lägg till en ny hund i databasen
// ... med mera.

// kollar efter fel
error_reporting(-1)
?>
<?php

// Hämtar alla våra användare från databasen
function getUsersFromDB()
{
    $json = file_get_contents("db.json");
    $data = json_decode($json, true);

    $everyUser = $data["users"];

    return $everyUser;
}
// Hämtar alla våra hundar från databasen
function getDogsFromDB()
{
    $json = file_get_contents("db.json");
    $data = json_decode($json, true);

    $everyDog = $data["dogs"];

    return $everyDog;
}
?>