<?php
// Profilsidan (obs. måste vara inloggad), lista en användares alla hundar.
error_reporting(-1);


require_once "includes/functions.php";
require_once "includes/header.php";

?>
<!-- Skapar profilen och dens divar -->
<div id="profile">
    <h2 class="title">Your doggos</h2>
    <div class="smallTitles">
        <h3>Name</h3>
        <h3>Breed</h3>
        <h3>Age</h3>
        <h3>Notes</h3>
    </div>
    <div id="list">
        <!-- Går igenom alla hundarna och tar ut deras ägare - sen skapas hundivarna -->
        <?php
        $allDoggos = getDogsFromDB();

        foreach ($allDoggos as $dog) {
            if ($_SESSION["id"] == $dog["owner"]) {
                echo showDog($dog);
            }
        }
        //skapar en array med hundar som matchar den inloggade användarens ID.
        $noDogs = [];
        foreach ($allDoggos as $dog) {
            if ($_SESSION["id"] == $dog["owner"]) {
                array_push($noDogs, $dog);
            }
        }
        //Om det inte finns några hundar i den nya arrayen så visas detta medelandet
        if (count($noDogs) == 0) {
            echo "<h4 class='noDogs'>You have no dogs. Go ahead and <a href='add.php'>add</a> one.</h4>";
        }
        ?>
    </div>
</div>
<!-- Inkluderar footern -->
<?php require_once "includes/footer.php"; ?>