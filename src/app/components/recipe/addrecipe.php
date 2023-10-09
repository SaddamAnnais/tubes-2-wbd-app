<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A page to add new recipe in Cooklyst. It is mandatory to insert title, description, tag, difficulty, video, and thumbnail image.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add New Recipe</title>
	<!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/addrecipe-editrecipe.css">
  <link rel="stylesheet" type="text/css" href="/public/styles/templates/navbar.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
	<!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/recipe/addrecipe.js" defer></script>
</head>

<body>
  <?php
  require_once __DIR__ . '/../templates/navbar.php';
  navbar(false)
  ?>
	<div class="container">
    <header>Add New Recipe</header>
    <form id="form">
			<div class="input-div">
				<div class="input-div">
					<label for="title">Title</label>
					<input type="text" id="title" name="title" placeholder="Insert title...">
					<p id="title-alert" class="alert hidden"></p>
				</div>

				<div class="input-div">
					<label for="desc">Description</label>
					<input type="text" id="desc" name="desc" placeholder="Insert description...">
					<p id="desc-alert" class="alert hidden"></p>
				</div>

				<div class="hstack">
					<div class="input-div">
						<label for="tag">Tag</label>
						<select name="tag" id="tag">
							<option value="">--Choose tag--</option>
							<option value="appetizer">Appetizer</option>
							<option value="main course">Main Course</option>
							<option value="dessert">Dessert</option>
							<option value="full course">Full Course</option>
						</select>
						<p id="tag-alert" class="alert hidden"></p>
					</div>

					<div class="divider"></div>

					<div class="input-div">
						<label for="difficulty">Difficulty</label>
						<select name="difficulty" id="difficulty">
							<option value="">--Choose difficulty--</option>
							<option value="easy">Easy</option>
							<option value="medium">Medium</option>
							<option value="hard">Hard</option>
						</select>
						<p id="difficulty-alert" class="alert hidden"></p>
					</div>
				</div>

				<div class="input-div">
					<label for="video">Recipe Video (.mp4)</label>
					<input type="file" id="video" name="video" accept="video/mp4">
					<p id="video-alert" class="alert hidden"></p>
				</div>

				<div class="input-div">
					<label for="image">Recipe Thumbnail Image (.jpg/.jpeg/.png)</label>
					<input type="file" id="image" name="image" accept="image/png, image/jpeg">
					<p id="image-alert" class="alert hidden"></p>
				</div>

        <p id="result-alert" class="alert hidden">Recipe successfully added!</p>

        <div class="button-div">
					<button id="button cancel" class="button cancel"><a href="<?= BASE_URL . '/home/' ?>">Cancel</a></button>
          <input type="submit" class="button add" value="Add Recipe">
        </div>
			</div>
    </form>
  </div>
</body>

</html>
