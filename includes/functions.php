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

//Lägger till en ny hund i databasen
function addNewDog($postInfo)
{
    //nycklar för den nya hunden, från $_POST
    $newDog = [
        "name" => $postInfo["dogName"],
        "breed" => $postInfo["breed"],
        "age" => $postInfo["age"],
        "notes" => $postInfo["notes"]
    ];
    //denna foreachen räknar ut den nya 
    //hundens id utifrån vilka som redan finns
    $highestID = 0;

    $allDogs = getDogsFromDB();
    foreach ($allDogs as $dog) {
        if ($dog["id"] > $highestID) {
            $highestID = $dog["id"];
        }
    }
    //owner till den nya hunden, vilket är den som är inloggad
    $newDog["owner"] = $_SESSION["id"];
    //ID:et av den nya hunden
    $newDog["id"] = $highestID + 1;
    //lägg till hund i db.json
    $data = json_decode(file_get_contents("db.json"), true);
    array_push($data["dogs"], $newDog);
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("db.json", $json);
}

function addNewUser($postInfo)
{
    //nycklar för den nya hunden, från $_POST
    $newUser = [
        "email" => $postInfo["email"],
        "username" => $postInfo["userName"],
        "password" => $postInfo["password"],
    ];
    //denna foreachen räknar ut den nya 
    //hundens id utifrån vilka som redan finns
    $highestUserID = 0;

    $allUsers = getUsersFromDB();
    foreach ($allUsers as $user) {
        if ($user["id"] > $highestUserID) {
            $highestUserID = $user["id"];
        }
    }
    //owner till den nya hunden, vilket är den som är inloggad
    //ID:et av den nya hunden
    $newUser["id"] = $highestUserID + 1;
    //lägg till hund i db.json
    $data = json_decode(file_get_contents("db.json"), true);
    array_push($data["users"], $newUser);
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("db.json", $json);
}

function deleteTheDog($dogID)
{
    $allOurDogs = getDogsFromDB();

    $found = false;
    foreach ($allOurDogs as $key => $dog) {
        if ($dogID == $dog["id"]) {
            $found = true;
            $index = $key;
            break;
        }
    }
    if ($found) {
        $data = json_decode(file_get_contents("db.json"), true);
        unset($data["dogs"][$index]);
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("db.json", $json);
    }

    header("Location: /profile.php");
    exit();
}

function showDog($dogInfo)
{
    $everyUser = getUsersFromDB();

    foreach ($everyUser as $user) {
        if ($user["id"] == $dogInfo["owner"]) {
            $nameOfOwner = $user["username"];
            break;
        } else {
            $nameOfOwner = "<p>No Owner.</p>";
        }
    }
    if (checkURL("profile") == true) {
        $dogDiv = "
        <div class='oneDog'>
            <div class='name'>
                <p><a href='show.php?id={$dogInfo['id']}'>{$dogInfo['name']}</a></p>
            </div>
            <div class='breed'>
                <p><a href='list.php?breed={$dogInfo['breed']}'>{$dogInfo['breed']}</a></p>
            </div>
            <div class='age'>
                <p>{$dogInfo['age']}</p>
            </div>
            <div class='notes'>
                <p>{$dogInfo['notes']}</p>
            </div>
            <div class='owner'>
                <p>{$nameOfOwner}</p>
            </div>
            <div class='delete'>
                <p><a href='delete.php?id={$dogInfo['id']}'>DELETE</a></p>
            </div>
        </div>";
    } else {
        $dogDiv = "
        <div class='oneDog' style='grid-template-columns: repeat(5, 1fr);'>
            <div class='name'>
                <p><a href='show.php?id={$dogInfo['id']}'>{$dogInfo['name']}</a></p>
            </div>
            <div class='breed'>
                <p><a href='list.php?breed={$dogInfo['breed']}'>{$dogInfo['breed']}</a></p>
            </div>
            <div class='age'>
                <p>{$dogInfo['age']}</p>
            </div>
            <div class='notes'>
                <p>{$dogInfo['notes']}</p>
            </div>
            <div class='owner'>
                <p>{$nameOfOwner}</p>
            </div>
        </div>";
    }
    return $dogDiv;
}


function checkURL($stringInURL)
{
    if (strpos($_SERVER['REQUEST_URI'], "$stringInURL") !== false) {
        return true;
    } else {
        return false;
    }
}
?>