<?php
    class CardData {
        private $id;
        private $title;
        private $duration;
        private $image_path;
        private $created_at;

        public function __construct($id, $title, $duration, $image_path, $created_at)
        {
            $this->id = $id;
            $this->title = $title;
            $this->duration = $duration;
            $this->image_path = $image_path;
            $this->created_at = $created_at;
        }

        public function getId() {
            return $this->id;
        }

        public function getTitle() {
            return $this->title;
        }

        public function getDuration() {
            return $this->duration;
        }

        public function getImagePath() {
            return $this->image_path;
        }

        public function getCreatedAt() {
            return $this->created_at;
        }
    }


    function recipeCard(CardData $data) {
?>
        <a href="<?php echo $data->getId() ?>">
            <div class="card-item">
                <img id="thumb" src="<?php echo $data->getImagePath() ?>" alt="<?php echo $data->getTitle() ?>" />
                <div id="title"><?php echo $data->getTitle() ?></div>
                <div id="created">
                    <?php 
                        $datetime_created = new DateTime($data->getCreatedAt());
                        $datetime_now = new DateTime(date("Y-m-d H:i:s")); // later check for timezone etc. or maybe no?

                        $diff = $datetime_created->diff($datetime_now);

                        if($diff->days > 0)
                            echo $diff->days . " days ago";
                        else if($diff->h > 0)
                            echo $diff->h . " hours ago";
                        else 
                            echo $diff->m . " minutes ago";
                    ?>
                </div>
            </div>
        </a>
<?php
    }
?>