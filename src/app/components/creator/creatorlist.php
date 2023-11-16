<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="List of your premium recipe creators.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Creators List</title>
  <!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/creator/creatorlist.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/recipemodals.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/creator/subscribemodals.js" defer></script>
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>

</head>
<body>
  <?php
  require_once __DIR__ . '/subscribemodals.php';
  subscribeModals();
  ?>
  <?php
  require_once __DIR__ . '/../templates/navbar.php';
  navbar(false)
  ?>
  <?php if (isset($this->data['user_id'])): ?>
    <div class="container">
      <div class="hdivider"></div>
      <header>Creators List</header>

      <div class="creators-container">
        <?php foreach ($this->data['creators'] as $creator) : ?>
            <div class="creator-entry">
              <div class="creator-identity">
                <p class="creator-name"><?= $creator['name'] ?></p>
                <p class="creator-username"><?= $creator['username'] ?></p>
              </div>
              <div class="button-div">
                <?php if ($creator['subsStatus'] == "NO_DATA"): ?>
                  <button id="<?= $creator['id']?>" name="subs-button" type="button" class="button green">Subscribe</button>
                <?php elseif ($creator['subsStatus'] == "APPROVED"): ?>
                  <!-- TODO: FIX URL -->
                  <a href="<?= BASE_URL ."/../creator/collection/" . $creator['id']?>" aria-label="<?= 'Creator ' . $creator['id']?> . '\'s content'">
                    <button id="view-button" type="button" class="button green">Collections</button>
                  </a>
                <?php elseif ($creator['subsStatus'] == "REJECTED"): ?>
                  <button id="wait-button" type="button" class="button white" disabled>Subscription Rejected</button>
                <?php else: ?>
                  <button id="wait-button" type="button" class="button white" disabled>Waiting Approval</button>
                <?php endif; ?>
              </div>
            </div>
        <?php endforeach; ?>
      </div>

    </div>
  <?php endif; ?>
</body>
</html>
