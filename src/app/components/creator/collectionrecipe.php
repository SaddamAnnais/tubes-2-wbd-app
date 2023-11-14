<!DOCTYPE html>

<?php
require_once __DIR__ . '/../imports/pageSetup.php';

require_once __DIR__ . '/../templates/navbar.php';
require_once __DIR__ . '/../templates/card.php';
require_once __DIR__ . '/../templates/pagination.php';


?>

<head>
  <title>Cooklyst!</title>
  <?php pageSetup("Collection recipe page containing recipe videos that is made by creator.") ?>

  <link rel="stylesheet" type="text/css" href="/public/styles/styles.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/card.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/pagination.css">

  <link rel="stylesheet" type="text/css" href="/public/styles/playlist/playlist.css">

  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>
</head>

<body>
  <?php navbar(false) ?>
  <div id="wrapper">
    <div id="playlist-details-wrapper">
      <div id="playlist-details">
        <div id="playlist-title">
          <?php echo $this->data->title ?? "Collection not found" ?>
        </div>
        <!-- later fallback image value should be made its own image, on static -->
        <img id="playlist-thumb"
          src="<?php echo ($this->data->cover ? $this->data->cover : BASE_URL . "/static/fallback_playlist.png") ?>"
          alt="playlist-thumb" />
        <div id="playlist-owner">
          <?php echo "Collections made by " . $this->data->creator_name ?? "No owner" ?>
        </div>
        <div id="playlist-created">
          <?php echo toDatetimeDescription($this->data->created_at) ?>
        </div>
        <div id="playlist-total">
          <?php echo $this->data->total_recipe != 0 ? $this->data->total_recipe . " Recipes" : "No recipes" ?>
        </div>
      </div>
    </div>
    <div id="card-container">
      <?php
      if (isset($this->data->recipes)) {
        // recipes and pages
        foreach ($this->data->recipes as $cardItem) {
          recipeCard($cardItem, true);
        }
      }
      ?>
    </div>

  </div>
</body>