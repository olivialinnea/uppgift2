<?php
// Lista alla hundar.
error_reporting(-1);

require_once "includes/functions.php";
require_once "includes/header.php";

$allTheDogs = getDogsFromDB();
?>

<?php
if (!isset($_GET["breed"])) { ?>
    <h2 class="title">All of our adorable doggo!</h2>;
<?php } else { ?>
    <h2>All <?php echo $_GET["breed"] ?>s </h2>
    <h3><a href="list.php">Go back to all the dogs</a></h3>
<?php } ?>

<div id="list">
    <?php if (isset($_GET["breed"])) {
        $breed = $_GET["breed"];
        $dogBreeds = ["breed"];
        $dogBreeds = [];

        foreach ($allTheDogs as $dog) {
            if ($breed == $dog["breed"]) {
                array_push($dogBreeds, $dog);
            }
        }

        if (count($dogBreeds) == 0) {
            echo "<p class='error'>This breed does not exist.</p>";
        } else { //varje breed med samma $_GET visas
            foreach ($dogBreeds as $dog) {
                echo showDog($dog);
            }
        }
    } else {
        foreach ($allTheDogs as $dog) {
            echo showDog($dog);
        }
    }
    ?>
</div>

<?php require_once "includes/footer.php";
