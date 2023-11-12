<?php
require_once __DIR__ . "/logo.php";
require_once __DIR__ . "/profilebar.php";
require_once __DIR__ . "/searchbar.php";

require_once __DIR__ . "/profileModals.php";

require_once __DIR__ . "/../../middlewares/Auth.php";

    function navbar($searchbar = true) {
        // if searchbar is true then show searchbar, else otherwise 
        
        // checking if it's an admin or not
        $auth_middleware = new Auth();
        $showAddRecipe = true;
        try {
            $auth_middleware->isAdmin();
        } catch (Exception $e) {
            $showAddRecipe = false;
        }
        
        
?>
        <navbar>
            <nav>
                <?php logo() ?>

                <!-- searchbar -->
                <div id="<?=$searchbar ? "searchbar" : ""?>">
                    <?php $searchbar && searchbar() ?>
                </div>
                
                <!-- add recipe -->
                <?php 
                    if ($searchbar && $showAddRecipe) {
                ?>
                    <a href="/recipe/add" id="tambah-recipe">
                        
                            <i class="fa fa-plus"></i>
                            <span>Tambah</span>
                       
                    </a>
                <?php
                    }
                ?>
                
                <!-- login/reg section -->
                <?php profilebar() ?>
            </nav>

            <?php profileModals() ?>
        </navbar>
<?php
    } 
?>