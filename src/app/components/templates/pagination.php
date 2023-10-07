<?php
    function backscroller($length = 1) {
?>
        <div class="backscroller">

        </div>
<?php
    }

    function pagination($current = 0, $total = 1) {
?>
        <div id="pagination-wrapper">
                <div id="pagination" style="grid-template-columns: 
                            <?php echo $current - 0 ?>fr
                            1fr
                            <?php echo $total - ($current+1) ?>fr
                        ;">
                    <div class="bgscroller"></div>
                    <div class="scroller"></div>
                    <div class="bgscroller"></div>
                </div>
                <div id="pagination-info">
                    page <?php echo $current + 1 ?> of <?php echo $total ?>
                </div>
        </div>
        
<?php
    }
?>