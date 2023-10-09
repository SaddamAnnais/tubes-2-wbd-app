<?php
    require_once __DIR__ . '/card.php';

    function searchfilter() {
?>
        <div id="searchfilter">
           <?php filterCard("easy", true); ?>
           <?php filterCard("medium", true); ?>
           <?php filterCard("hard", true); ?>
           <div class="separator"></div>
           <?php filterCard("appetizer", false); ?>
           <?php filterCard("main course", false); ?>
           <?php filterCard("dessert", false); ?>
           <?php filterCard("full course", false); ?>
        </div>
<?php
    }
?>