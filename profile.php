<?php
// Profilsidan (obs. måste vara inloggad), lista en användares alla hundar.
error_reporting(-1);


require_once "includes/functions.php";
require_once "includes/header.php";

?>

<div id="profile">
    <h2 class="title">Your doggos</h2>
    <div id="list">

        <?php
        $allDoggos = getDogsFromDB();

        foreach ($allDoggos as $dog) {
            if ($_SESSION["id"] == $dog["owner"]) {
                echo showDog($dog);
            }
        }

        $noDogs = [];

        foreach ($allDoggos as $dog) {
            if ($_SESSION["id"] == $dog["owner"]) {
                array_push($noDogs, $dog);
            }
        }

        if (count($noDogs) == 0) {
            echo "<h4>You have no dogs. Go ahead and <a href='add.php'>add</a> one.</h4>";
        }
        ?>
    </div>
</div>

<?php require_once "includes/footer.php"; ?>