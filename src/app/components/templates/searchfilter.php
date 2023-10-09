<?php
    require_once __DIR__ . '/card.php';

    function searchfilter($data) {
        $diff = array(
            "easy", "medium", "hard"
        );

        $tag = array(
            "appetizer", "main course", "dessert", "full course"
        );
?>
        <div id="searchfilter">
            <?php 
            foreach($diff as $item) {
                filterCard($item, true, strtoupper($data["diff"] ?? "") == strtoupper($item)); 
            }
            ?>
           
           <div class="separator"></div>

           <?php 
            foreach($tag as $item) {
                filterCard($item, false, strtoupper($data["tag"] ?? "") == strtoupper($item)); 
            }
            ?>
        </div>
<?php
    }
?>