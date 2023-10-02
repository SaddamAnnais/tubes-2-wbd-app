<?php
require_once __DIR__ . "/logo.php";
require_once __DIR__ . "/profilebar.php";

    function navbar() {
?>
        <navbar>
            <nav>
                <?php logo() ?>

                <!-- searchbar -->
                <div>searchbar</div>

                <!-- login/reg section -->
                <?php profilebar() ?>
            </nav>
        </navbar>
<?php
    } 
?>