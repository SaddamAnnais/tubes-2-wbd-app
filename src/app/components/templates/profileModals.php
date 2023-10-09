<?php
    function profileModals() { 
        if (isset($_SESSION['user_id'])) {
            require_once __DIR__ . '/../../models/UserModel.php';

            $userModel = new UserModel();
            $userdata = get_object_vars($userModel->getUserById($_SESSION['user_id']));
          }

?>
        <div id="profileModals">
            <img id="profilepicModals" src="<?php echo BASE_URL ?>/static/icon/user_icon_default.png" alt="profilepic" />
            <div id="name">Hi, <?php echo ($userdata["name"] ?? "name") ?>!</div>
            <div id="username"><?php echo ($userdata["username"] ?? "username") ?></div>
            
            <div class="separator"></div>

            <div id="profiletab" class="tabmenu"><a href="/user">profile</a></div>
            <!-- TODO: playlist of mine -->
            <div id="playliststab" class="tabmenu">my playlists</div>

            <div class="separator"></div>
            
            <div id="logout">logout</div>
        </div>
<?php
    }
?>