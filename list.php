<?php
// Lista alla hundar.
error_reporting(-1);

require_once "includes/functions.php";
require_once "includes/header.php";

$allTheDogs = getDogsFromDB();

echo '<pre>';
echo var_dump(getDogsFromDB());
echo '</pre>';
