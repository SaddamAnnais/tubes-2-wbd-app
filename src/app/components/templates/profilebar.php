<?php
    function profilebar($user_id = -1) {
?>
    <div id="profilebar">
        <?php 
            if($user_id == -1) {
        ?>
                <img id="profilepic" src="<?php echo BASE_URL ?>/static/icon/user_icon_default.png" alt="profilepic" />
                <img id="profileclose" src="<?php echo BASE_URL ?>/static/icon/close.svg" alt="profileclose"/>
        <?php
            } // else logged on
        ?>
    </div>
<?php
    }

?>