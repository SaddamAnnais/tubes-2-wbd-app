<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="List of your loved videos saved in your playlists.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Creator Collections!</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/playlist/playlists.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/recipemodals.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/playlist/addplaylistmodals.js" defer></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>

</head>

<body>
  <?php
  require_once __DIR__ . '/../templates/navbar.php';
  navbar(false)
    ?>
  <div class="container">
    <div class="button-group-div">
      <header>Collection by <?=$this->data->creator_name?></header>
    </div>

    <div class="playlist-container">
      <?php foreach ($this->data->collections as $collection): ?>
        <a href="<?= BASE_URL . '/../creator/collection/' . $this->data->creator_id . "/" . $collection->id ?>"
          aria-label="<?= 'Watch playlist ' . $collection->collection_id ?>">
          <div class="playlist-card">
            <div class="image-container">
              <div class="nvid">
                <i class="fa fa-video-camera"></i>
                <div class="divider"></div>
                <?= $collection->total_recipe ?>
              </div>
              <?php if ($collection->cover): ?>
                <img src="<?= $collection->cover ?>" alt="collection cover">
              <?php else: ?>
                <img src="<?= BASE_URL . '/static/fallback_playlist.png' ?>" alt="playlist cover">
              <?php endif; ?>
            </div>
            <p class="playlist-title">
              <?= $collection->title ?>
            </p>
            <p class="playlist-capt">
              <?= "Created " . (new DateTime($collection->created_at))->format('D, d M Y') ?>
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

  </div>
</body>

</html>