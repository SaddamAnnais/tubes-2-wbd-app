<?php
    function toMinuteFormat($seconds) {
        $m = floor($seconds / 60);
        $s = ($seconds % 60);

        if($m < 10) {
            $m = "0" . $m;
        }
        if($s < 10) {
            $s = "0" . $s;
        }

        return $m . ":" . $s;
    }

    function toDatetimeDescription($datetime) {
        $datetime_created = new DateTime($datetime);
        $datetime_now = new DateTime(date("Y-m-d H:i:s")); // later check for timezone etc. or maybe no?
        //unusedr dur desc, difficulty, video_path
        $diff = $datetime_created->diff($datetime_now);

        if($diff->days > 0)
            return $diff->days . " days ago";
        else if($diff->h > 0)
            return $diff->h . " hours ago";
        else 
            return $diff->i . " minutes ago";
    }

    function recipeCard($data, $isPremium) {
       
?>
        <a href="<?php echo "/recipe/watch/" . $data->recipe_id ?? BASE_URL . "/404" ?>">
            <div class="card-item">
                <div id="duration" >
                    <?php echo toMinuteFormat($data->duration ) ?>
                </div>
                <?php 
                    if($isPremium) {
                ?>
                    <img id="thumb" src="<?php  require_once __DIR__ . "/../../util/getImage.php" ?>" alt="<?php echo $data->title ?? "untitled" ?>" />
                <?php } else { ?>
                    <img id="thumb" src="<?php echo STORAGE_URL . "/images/" . $data->image_path ?? "" ?>" alt="<?php echo $data->title ?? "untitled" ?>" />
                <?php
                }
                ?>
                
                
                <div id="title"><?php echo $data->title ?? "untitled" ?></div>
                <div id="created">
                    <?php 
                        echo toDatetimeDescription($data->created_at);
                    ?>
                </div>
            </div>
        </a>
<?php
    }

    function playlistCard($data) {
?>
        <div id="playlist-details">
            <div id="playlist-title"><?php echo $data["title"] ?? "playlist not found" ?></div>
            <!-- later fallback image value should be made its own image, on static -->
            <img id="playlist-thumb" src="<?php echo  ($data["cover"] ? STORAGE_URL . "/images/" . $data["recipes"][0]->image_path : BASE_URL . "/static/fallback_playlist.png") ?>" alt="playlist-thumb" />
            <div id="playlist-owner"><?php echo "Playlist dibuat oleh " . $data["owner"]->username ?? "no owner" ?></div>
            <div id="playlist-created"><?php echo toDatetimeDescription($data["created_at"]) ?></div>
            <div id="playlist-total"><?php echo $data["total_recipe"] != 0 ? $data["total_recipe"] . " Resep" : "no recipes" ?></div>
        </div>
<?php
    }

    function filterCard($text, $isDiff = false, $isActive = false) {
?>
        <div class="badge <?php echo $isDiff ? "diffCard" : "tagCard" ?> <?php echo $isActive ? "active" : "" ?>">
            <?php echo strtoupper($text) ?>
        </div>
<?php
    }
?>