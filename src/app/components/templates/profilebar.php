<?php
    function profilebar($user_id = -1) {
?>
    <div id="profilebar">
        <?php 
            if($user_id == -1) {
        ?>
                <img id="profilepic" src="/public/static/icon/user_icon_default.png" alt="profilepic" />
        <?php
            } // else logged on
        ?>
    </div>
<?php
    }

?>