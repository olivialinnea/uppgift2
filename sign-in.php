<?php
// Inloggningssidan. Tänk på att formuläret kan skicka uppgifterna till denna
// filen också. Det gäller då att du t.ex. kontrollerar om $_POST innehåller
// något. Om inloggningen lyckas slussar du vidare dom till listningssidan.

//Kontrollerar fel
error_reporting(-1);
//Startar en ny session
session_start();
//Kopplar headern
require_once "includes/header.php";

//Hanterar JSON
$json = file_get_contents("db.json");
$data = json_decode($json, true);
