<?php
// Lista alla hundar.
error_reporting(-1);

//Inkluderar dessa filer
require_once "includes/functions.php";
require_once "includes/header.php";

//ger oss tillgång till alla hundar
$allTheDogs = getDogsFromDB();
?>
<!-- skapar element för varje hund -->
<?php
//Ändrar information beroende på om den ska visa alla hunder eller bara en ras.
if (!isset($_GET["breed"])) { ?>
    <div class="smallTitles">
        <h3>Name</h3>
        <h3>Breed</h3>
        <h3>Age</h3>
        <h3>Notes</h3>
        <h3>Owner</h3>
    </div>
<?php } else { ?>
    <h3 id="goBack"><a href="list.php"> ◄ Go back to all the dogs</a></h3>
    <div id="infoOneDog">
        <h1 id="allBreed">All <?php echo $_GET["breed"] ?>s </h1>
        <div class="smallTitles">
            <h3>Name</h3>
            <h3>Breed</h3>
            <h3>Age</h3>
            <h3>Notes</h3>
            <h3>Owner</h3>
        </div>
    </div>

<?php } ?>

<div id="list">
    <?php if (isset($_GET["breed"])) {
        $breed = $_GET["breed"];
        $dogBreeds = ["breed"];
        $dogBreeds = [];
        //Om ID stämmer med hundens id så läggs den till i arrayen
        foreach ($allTheDogs as $dog) {
            if ($breed == $dog["breed"]) {
                array_push($dogBreeds, $dog);
            }
        }
        //Om denna breed inte finns (arrayen är tom) så skrivs ett felmeddelande ut
        if (count($dogBreeds) == 0) {
            echo "<p class='error'>This breed does not exist.</p>";
        } else { //varje breed med samma $_GET visas
            foreach ($dogBreeds as $dog) {
                echo showDog($dog);
            }
        }
    } else { //Går igenom och visar alla hundar
        foreach ($allTheDogs as $dog) {
            echo showDog($dog);
        }
    }
    ?>
</div>

<?php require_once "includes/footer.php";
