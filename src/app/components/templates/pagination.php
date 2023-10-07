<?php 
    function pagination($current = 0, $total = 1) {
?>
        <div id="pagination">
            <!-- temporary fix -->
            <?php 
                for($i=0; $i<$current; $i++) {
            ?>
                    <div>
                        X
                    </div>
            <?php
                }
            ?>

            <div>B</div>

            <?php 
                for($i=$current+1; $i<$total; $i++) {
            ?>
                    <div>
                        X
                    </div>
            <?php
                }
            ?>
        </div>
<?php
    }
?>