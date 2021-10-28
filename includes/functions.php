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

// Hämtar alla våra användare från databasen och gör dem tillgängliga
function getUsersFromDB()
{
    $json = file_get_contents("db.json");
    $data = json_decode($json, true);

    $everyUser = $data["users"];

    return $everyUser;
}
// Hämtar alla våra hundar från databasen och gör dem tillgängliga
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
    //nycklar för den nya hunden dessa får vi från $_POST
    $newDog = [
        "name" => $postInfo["dogName"],
        "breed" => $postInfo["breed"],
        "age" => $postInfo["age"],
        "notes" => $postInfo["notes"]
    ];

    //räknar ut den nya hundens id genom att gå igenom alla de hundarna som redan finns.
    $highestID = 0;
    $allDogs = getDogsFromDB();
    foreach ($allDogs as $dog) {
        if ($dog["id"] > $highestID) {
            $highestID = $dog["id"];
        }
    }
    //Ägar till din nya hunden, alltså den inloggade användaren.
    $newDog["owner"] = $_SESSION["id"];
    //Nya hundens ID.
    $newDog["id"] = $highestID + 1;
    //Lägger till hunden i json.db
    $data = json_decode(file_get_contents("db.json"), true);
    array_push($data["dogs"], $newDog);
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("db.json", $json);
}
//Lägger till en ny användare - fungerar på samma vis som addNewDog
function addNewUser($postInfo)
{
    $newUser = [
        "email" => $postInfo["email"],
        "username" => $postInfo["userName"],
        "password" => $postInfo["password"],
    ];

    $highestUserID = 0;

    $allUsers = getUsersFromDB();
    foreach ($allUsers as $user) {
        if ($user["id"] > $highestUserID) {
            $highestUserID = $user["id"];
        }
    }

    $newUser["id"] = $highestUserID + 1;

    $data = json_decode(file_get_contents("db.json"), true);
    array_push($data["users"], $newUser);
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("db.json", $json);
}

//Funktion för att radera hunden.
function deleteTheDog($dogID)
{
    $allOurDogs = getDogsFromDB();

    $found = false;
    //Letar upp hundens index
    foreach ($allOurDogs as $key => $dog) {
        if ($dogID == $dog["id"]) {
            $found = true;
            $index = $key;
            break;
        }
    }
    //Om den hittas så raderas hunden ur databasen
    if ($found) {
        $data = json_decode(file_get_contents("db.json"), true);
        unset($data["dogs"][$index]);
        $json = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents("db.json", $json);
    }

    header("Location: /profile.php");
    exit();
}

//Skapar den specifika hunden när man trycker på den hundens namn
function specificDog($dogInfo)
{
    $allUser = getUsersFromDB();

    //Kollar hundens ägare
    foreach ($allUser as $user) {
        if ($user["id"] == $dogInfo["owner"]) {
            $nameOfOwner = $user["username"];
            break;
        } else {
            $nameOfOwner = "<p>No Owner.</p>";
        }
    }
    //lägger in infomartionen om hunden
    $dogInfo = "<div class='infoAboutDog'>
    <h2 class='dogNameShowPage'>{$dogInfo['name']}</h2>
    <p> A <span>{$dogInfo['breed']}</span> that's {$dogInfo['age']} years old. They're owned by <span>{$nameOfOwner}</span>.<br> <span>Notes about {$dogInfo['name']}: {$dogInfo['notes']}</span></p>
    </div>";

    return $dogInfo;
}

//Skriver ut alla hundar i en lista
function showDog($dogInfo)
{
    $everyUser = getUsersFromDB();

    //Kollar ägaren
    foreach ($everyUser as $user) {
        if ($user["id"] == $dogInfo["owner"]) {
            $nameOfOwner = $user["username"];
            break;
        } else {
            $nameOfOwner = "<p>No Owner.</p>";
        }
    }
    //Om man är inne i "profile"
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
            <div class='delete'>
                <p><a href='delete.php?id={$dogInfo['id']}'>DELETE</a></p>
            </div>
        </div>";
        //Om man inte är inne i profile
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

//Funktion så att vi kan kontrollera vad som står i url:n
function checkURL($stringInURL)
{
    if (strpos($_SERVER['REQUEST_URI'], "$stringInURL") !== false) {
        return true;
    } else {
        return false;
    }
}
?>