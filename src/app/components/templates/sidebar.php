<?php
    // TODO : add icon
    



    function sidebar() {
        $sidebarItems = array(
            array("Home", "/home"),
            array("Playlists", "/playlists")
        );
?>
        <sidebar>
            <ul>
                <?php 
                    foreach($sidebarItems as $item) {
                        sidebarItem($item);
                    }                
                ?>
            </ul>
        </sidebar>
<?php
    } 
?>

<?php
   
    function sidebarItem($item) {  // later add icon
?> 
    <a href="<?php echo $item[1] ?>"> 
        <li>
              <?php echo $item[0] ?>
         </li>
    </a>
<?php
    } 
?>