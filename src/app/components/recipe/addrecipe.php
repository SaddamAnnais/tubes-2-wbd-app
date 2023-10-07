<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add New Recipe</title>
	<!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/addrecipe.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
	<!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/recipe/addrecipe.js?2" defer></script>
</head>

<body>
	<div class="container">
    <header>Add New Recipe</header>
    <form id="form">
        <p class="label">Title</p>
        <input type="text" id="title" name="title">
        <p id="title-alert" class="alert hidden"></p>

        <p class="label">Description</p>
        <input type="text" id="desc" name="desc">
        <p id="desc-alert" class="alert hidden"></p>

        <p class="label">Tag</p>
        <select name="tag" id="tag">
					<option value="">--Choose recipe tag--</option>
					<option value="appetizer">Appetizer</option>
					<option value="main course">Main Course</option>
					<option value="dessert">Dessert</option>
					<option value="full course">Full Course</option>
				</select>
        <p id="tag-alert" class="alert hidden"></p>

				<p class="label">Difficulty</p>
        <select name="difficulty" id="difficulty">
					<option value="">--Choose recipe difficulty--</option>
					<option value="easy">Easy</option>
					<option value="medium">Medium</option>
					<option value="hard">Hard</option>
				</select>
        <p id="difficulty-alert" class="alert hidden"></p>

        <p class="label">Recipe Video (.mp4)</p>
        <input type="file" id="video" name="video" accept="video/mp4">
        <p id="video-alert" class="alert hidden"></p>

				<p class="label">Recipe Thumbnail Image (.jpg/.jpeg/.png)</p>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg">
        <p id="image-alert" class="alert hidden"></p>

        <p id="result-alert" class="alert hidden">Recipe successfully added!</p>

        <div class="button-div">
          <input type="submit" class="button add" value="Add Recipe">
        </div>
    </form>
  </div>
</body>

</html>
