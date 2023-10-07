<?php

    function recipeCard($data) {
?>
        <a href="<?php echo $data->recipe_id ?? BASE_URL . "/404" ?>">
            <div class="card-item">
                <img id="thumb" src="<?php echo STORAGE_URL . "/images/" . $data->image_path ?? "" ?>" alt="<?php echo $data->title ?? "untitled" ?>" />
                <div id="title"><?php echo $data->title ?? "untitled" ?></div>
                <div id="created">
                    <?php 
                        $datetime_created = new DateTime($data->created_at);
                        $datetime_now = new DateTime(date("Y-m-d H:i:s")); // later check for timezone etc. or maybe no?
                        //unusedr desc, difficulty, video_path
                        $diff = $datetime_created->diff($datetime_now);

                        if($diff->days > 0)
                            echo $diff->days . " days ago";
                        else if($diff->h > 0)
                            echo $diff->h . " hours ago";
                        else 
                            echo $diff->i . " minutes ago";
                    ?>
                </div>
            </div>
        </a>
<?php
    }
?>