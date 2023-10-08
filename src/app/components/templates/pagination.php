<?php
    function backscroller($length = 1) {
?>
        <div class="backscroller">

        </div>
<?php
    }

    function pagination($current = 1, $total = 1) {
        echo $current . $total;
        if($current > $total) {
            echo "PAGINATION PARAMS ARE INCORRECT";
            return;
        }
?>
        <div id="pagination-wrapper">
                <div id="pagination" style="grid-template-columns: 
                            <?php echo $current - 1 ?>fr
                            1fr
                            <?php echo $total - ($current) ?>fr
                        ;">
                    <div class="bgscroller"></div>
                    <div class="scroller"></div>
                    <div class="bgscroller"></div>
                </div>
                <div id="pagination-info">
                    page <?php echo $current ?> of <?php echo $total ?>
                </div>
        </div>
        
<?php
    }
?>