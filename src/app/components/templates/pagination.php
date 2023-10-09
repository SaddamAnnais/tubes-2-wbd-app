<?php
    function backscroller($length = 1) {
?>
        <div class="backscroller">

        </div>
<?php
    }

    function pagination($current = 1, $total = 1) {
?>
        <div id="pagination-wrapper">
            <?php
                if($total == 0) {

                }
                else if($current > $total) {
                    echo "PAGINATION PARAMS ARE INCORRECT" . $current . " > " . $total;
                } else {
            ?>
                    <div id="pagination" style="grid-template-columns: 
                                <?php echo $current - 1 ?>fr
                                1fr
                                <?php echo $total - ($current) ?>fr
                            ;">
                        <div id="backscroller" class="bgscroller"></div>
                        <div class="scroller"></div>
                        <div id="nextscroller" class="bgscroller" ></div>
                    </div>
                    <div id="pagination-info">
                        page <?php echo $current ?> of <?php echo $total ?>
                    </div>
            <?php
                }  
            ?>
            </div>      
        <?php
    }
?>