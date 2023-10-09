<?php
require_once __DIR__ . "/logo.php";
require_once __DIR__ . "/profilebar.php";
require_once __DIR__ . "/searchbar.php";

require_once __DIR__ . "/profileModals.php";

    function navbar($userdata = [], $searchbar = true) {
        // if searchbar is true then show searchbar, else otherwise 
?>
        <navbar>
            <nav>
                <?php logo() ?>

                <!-- searchbar -->
                <div id="<?=$searchbar ? "searchbar" : ""?>">
                    <?php $searchbar && searchbar() ?>
                </div>
                <!-- login/reg section -->
                <?php profilebar() ?>
            </nav>

            <?php profileModals($userdata) ?>
        </navbar>
<?php
    } 
?>