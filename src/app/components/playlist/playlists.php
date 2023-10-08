<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="List of your loved videos saved in your playlists.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Playlists</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/playlist/playlists.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/recipemodals.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/watchrecipe.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/playlist/addplaylistmodals.js" defer></script>

</head>
<body>
  <?php
  require_once __DIR__ . '/addplaylistmodals.php';
  addPlaylistModals();
  ?>
  <?php
  require_once __DIR__ . '/../templates/navbar.php';
  navbar()
  ?>
  <?php if (isset($this->data['user_id'])): ?>
    <div class="container">
      <div class="button-group-div">
        <header>My Playlists</header>
        <button id="add-button" type="button" class="button green">
          <div class="hstack">
            <i class="fa fa-plus"></i>
            <div class="divider"></div>
          New
          </div>
        </button>
      </div>

      <div class="playlist-container">
        <?php foreach ($this->data['playlists'] as $playlist) : ?>
          <a href="<?= BASE_URL . '/playlist/' . $playlist->playlist_id?>" aria-label="<?= 'Watch playlist ' . $playlist->playlist_id?>">
            <div class="playlist-card">
              <div class="image-container">
                <div class="nvid">
                  <i class="fa fa-video-camera"></i>
                  <div class="divider"></div>
                  <?= $playlist->total_recipe ?>
                </div>
                <?php if ($playlist->cover) : ?>
                  <img src="<?= STORAGE_URL . '/images/' . $playlist->cover?>" alt="playlist cover">
                <?php else : ?>
                  <img src="<?= BASE_URL . '/static/fallback_playlist.png'?>" alt="playlist cover">
                <?php endif; ?>
              </div>
              <p class="playlist-title"><?= $playlist->title ?></p>
              <p class="playlist-capt"><?= "Created " . (new DateTime($playlist->created_at))->format('D, d M Y') ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

    </div>
  <?php endif; ?>
</body>
</html>
