<?php
    function profileModals() { 
        require_once __DIR__ . '/../../middlewares/Auth.php';
        require_once __DIR__ . '/../../models/UserModel.php';

        $authenticated = isset($_SESSION['user_id']);
        $userdata = [];

        if ($authenticated) {
            $userModel = new UserModel();
            $userdata = get_object_vars($userModel->getUserById($_SESSION['user_id']));
        }

?>
        <div id="profileModals" class="notDraggable inactive <?php echo $authenticated ? "authed" : "" ?>">
            <img id="profilepicModals" src="<?php echo BASE_URL ?>/static/icon/user_icon_default.png" alt="profilepic" />
            <div id="name"><?php echo $authenticated ?  ("Hi, " . ($userdata["name"] ?? "name")) : "Hi " ?>!</div>
            

            <?php 
            if($authenticated) {
            ?>
                <div id="username"><?php echo ($userdata["username"] ?? "username") ?></div>
                
                <div class="separator"></div>

                <div id="profiletab" class="tabmenu"><a href="/user">profile</a></div>
                
                <div id="playliststab" class="tabmenu"><a href="/playlist">my playlists</a></div>

                
            <?php 
            }
            ?>
                
            <div class="separator"></div>

            <div id="logging">
                <?php 
                    if($authenticated) {
                ?>
                    <div id="logout">logout</div>
                <?php } else { ?>
                    <a href="/user/login">login</a>
                <?php
                }
                ?>
            </div>
        </div>
<?php
    }
?>