<!DOCTYPE html>

<?php
require_once __DIR__ . '/../imports/pageSetup.php';

require_once __DIR__ . '/../templates/navbar.php';
require_once __DIR__ . '/../templates/card.php';
require_once __DIR__ . '/../templates/pagination.php';


?>

<head>
	<title>Cooklyst!</title>
	<?php pageSetup("Cooklyst premium page. Watch recipe videos created by your favourites creator!") ?>

	<link rel="stylesheet" type="text/css" href="/public/styles/styles.css">
	<link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
	<link rel="stylesheet" type="text/css" href="/public/styles/templates/card.css">
	<link rel="stylesheet" type="text/css" href="/public/styles/templates/pagination.css">
	<link rel="stylesheet" type="text/css" href="/public/styles/templates/searchfilter.css">

	<link rel="stylesheet" type="text/css" href="/public/styles/home/home.css">

	<script type="text/javascript" src="<?= BASE_URL ?>/javascript/templates/navbar.js" defer></script>
	<script type="text/javascript" src="<?= BASE_URL ?>/javascript/creator/pagination.js" defer></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
	<?php navbar(false, false) ?>
	<div id="wrapper">
		<div id="card-container">
			<?php
			if (isset($this->data)) {
				// recipes and pages
				foreach ($this->data->recipes as $cardItem) {
					recipeCard($cardItem, true);
				}
			}
			?>
		</div>
		<?php pagination($this->data->currPage, $this->data->totalPage) ?>
	</div>
</body>