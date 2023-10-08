<!DOCTYPE html>

<?php
    require_once __DIR__ . '/../imports/pageSetup.php';

    require_once __DIR__ . '/../templates/navbar.php';
    require_once __DIR__ . '/../templates/card.php';
    require_once __DIR__ . '/../templates/pagination.php';


?>

<head>
    <title>Cooklyst!</title>
    <?php pageSetup("Cooklyst home page. Watch recipe videos by clicking at the video cards!") ?>

    <link rel="stylesheet" type="text/css" href="/public/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/templates/card.css">
    <link rel="stylesheet" type="text/css" href="/public/styles/templates/pagination.css">

    <link rel="stylesheet" type="text/css" href="/public/styles/home/home.css">

    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/pagination.js" defer></script>
</head>

<body>
    <?php navbar() ?>
    <div id="wrapper">

        <div id="card-container">
            <?php
                if (isset($this->data)) {
                    // recipes and pages
                    foreach($this->data["recipes"] as $cardItem) {
                        recipeCard($cardItem);
                    }
                }
            ?>
        </div>

        
        <?php pagination($this->data["curPages"], $this->data["pages"]) ?>
    </div>
</body>
