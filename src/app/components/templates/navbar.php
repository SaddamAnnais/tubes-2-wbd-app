<?php
require_once __DIR__ . "/logo.php";
require_once __DIR__ . "/profilebar.php";
require_once __DIR__ . "/searchbar.php";

require_once __DIR__ . "/profileModals.php";

    function navbar($userdata = []) {
            
?>
        <navbar>
            <nav>
                <?php logo() ?>

                <!-- searchbar -->
                <?php searchbar() ?>

                <!-- login/reg section -->
                <?php profilebar() ?>
            </nav>

            <?php profileModals($userdata) ?>
        </navbar>
<?php
    } 
?>