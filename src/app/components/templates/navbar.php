<?php
require_once __DIR__ . "/logo.php";
require_once __DIR__ . "/profilebar.php";
require_once __DIR__ . "/searchbar.php";

require_once __DIR__ . "/profileModals.php";

require_once __DIR__ . "/../../middlewares/Auth.php";

    function navbar($searchbar = true, $showAddRecipe = true) {
        // if searchbar is true then show searchbar, else otherwise 
        
        // checking if it's an admin or not
        if ($showAddRecipe) {
            $auth_middleware = new Auth();
            try {
                $auth_middleware->isAdmin();
            } catch (Exception $e) {
                $showAddRecipe = false;
            }
        }
?>
        <navbar>
            <nav>
                <?php logo() ?>

                <!-- searchbar -->
                <div id="<?=$searchbar ? "searchbar" : ""?>">
                    <?php $searchbar && searchbar() ?>
                </div>

                <!-- creator list -->
                <?php 
                    if (!$showAddRecipe) {
                ?>                    
                    <a href="/creator" id="tambah-recipe">
                        
                        <span>Creator List</span>

                </a>                    
                <?php 
                    }
                ?>                
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