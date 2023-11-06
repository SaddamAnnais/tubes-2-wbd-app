<?php
    require_once __DIR__ . '/card.php';

    function searchfilter() {
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
                filterCard($item, true); 
            }
            ?>
           
           <div class="separator"></div>

           <?php 
            foreach($tag as $item) {
                filterCard($item, false); 
            }
            ?>
        </div>
<?php
    }

    function searchsort() {
?>
        <div id="searchsort">
            <select id="sort-by">
                <option value="created_at">Created At</option>
                <option value="title">Title</option>
            </select>
            <img id="sort-dir" src="<?php echo BASE_URL ?>/static/icon/sort-desc.svg" alt="sort direction"/>
        </div>
<?php
    }
?>