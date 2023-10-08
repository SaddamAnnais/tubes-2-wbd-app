<?php
    function toMinuteFormat($seconds) {
        $m = ($seconds / 60);
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

    function recipeCard($data) {
?>
        <a href="<?php echo $data->recipe_id ?? BASE_URL . "/404" ?>">
            <div class="card-item">
                <div id="duration" >
                    <?php echo toMinuteFormat($data->duration ) ?>
                </div>
                <img id="thumb" src="<?php echo STORAGE_URL . "/images/" . $data->image_path ?? "" ?>" alt="<?php echo $data->title ?? "untitled" ?>" />
                
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
            <!-- later to be fidxeed -->
            <img id="playlist-thumb" src="<?php echo STORAGE_URL . "/images/" . $data["image_path"] ?? "" ?>" alt="playlist-thumb" />
            <div id="playlist-owner"><?php echo "Playlist dibuat oleh " . $data["owner"]->username ?? "no owner" ?></div>
            <div id="playlist-title"><?php echo toDatetimeDescription($data["created_at"]) ?></div>
            <div id="playlist-title"><?php echo $data["total_recipe"] . " Resep" ?? "no recipes" ?></div>
        </div>
<?php
    }
?>