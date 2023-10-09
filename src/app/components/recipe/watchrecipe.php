<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A page to watch a recipe in Cooklyst. You can add it to your playlist.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Watch Recipe</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/watchrecipe.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/recipemodals.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/recipe/deleterecipemodals.js" defer></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/recipe/addtoplaylistmodals.js" defer></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>

</head>

<body>
  <?php
  require_once __DIR__ . '/deleterecipemodals.php';
  deleteModals();
  ?>
  <?php
  require_once __DIR__ . '/addtoplaylistmodals.php';
  addToPlaylistModals($this->data['playlist']);
  ?>
  <?php
  require_once __DIR__ . '/../templates/navbar.php';
  navbar(false)
  ?>
  <?php if (isset($this->data['recipe_id'])): ?>
    <div class="container">
      <header><?= $this->data['title'] ?></header>
      <p class="date"><?= 'Posted on ' . $this->data['created_at'] ?></p>

      <div class="button-group-div">
        <button id="add-button" type="button" class="button green">
          <div class="hstack">
            <i class="fa fa-plus"></i>
            <div class="divider"></div>
          Add to playlist
          </div>
        </button>
        <div class="button-div">
          <?php if ($this->data['is_admin']): ?>
            <button id="edit-button" class="circle green" aria-label="Edit recipe"><a href="<?= '/public/recipe/edit/' . $this->data['recipe_id'] ?>" aria-label="Edit this recipe"><i class="fa fa-pencil"></i></a></button>
            <button id="delete-button" class="circle red" aria-label="Delete recipe"><i class="fa fa-trash"></i></button>
          <?php endif; ?>
        </div>
      </div>

      <div class="video-container video-cover">
        <video height="100%" controls autoplay>
          <source src="<?= STORAGE_URL . '/videos/' . $this->data['video_path'] ?>" type="video/mp4">
          Your browser doesn't support HTML5 video tag.
        </video>
      </div>
      <p class="explain"><?= $this->data['desc'] ?></p>
      <div class="hstack">
      <div class="badge"><?= strtoupper($this->data['tag']) ?></div>
      <div class="badge"><?= strtoupper($this->data['difficulty']) ?></div>
      </div>
    </div>
  <?php endif; ?>
</body>

</html>
