<?php
    function profileModals() { 
?>
    <div id="profileModals">
        <img id="profilepicModals" src="<?php echo BASE_URL ?>/static/icon/user_icon_default.png" alt="profilepic" />
        <div id="name">Hi, user!</div>
        <div id="username">username</div>
        
        <div class="separator"></div>

        <div id="profiletab" class="tabmenu">profile</div>
        <div id="playliststab" class="tabmenu">my playlists</div>

        <div class="separator"></div>
        
        <div id="logout">logout</div>
    </div>
<?php
    }
?>