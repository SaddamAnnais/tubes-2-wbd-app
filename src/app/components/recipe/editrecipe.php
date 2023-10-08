<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A page to edit existing recipe in Cooklyst. It is mandatory to insert title, description, tag, difficulty.">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Recipe</title>
	<!---Custom CSS File--->
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/styles.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/addrecipe-editrecipe.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/recipemodals.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/styles/recipe/watchrecipe.css">
  <link rel="icon" type="image/png" sizes="64x64" href="<?= BASE_URL ?>/static/icon/logo-64x64.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Custom js file -->
  <script type="text/javascript" src="<?= BASE_URL ?>/javascript/recipe/editrecipe.js" defer></script>
</head>

<body>
  <?php
  require_once __DIR__ . '/editrecipemodals.php';
  editModals();
  ?>
  <?php if (isset($this->data['recipe_id'])): ?>
    <div class="container">
      <header>Edit Recipe</header>
      <form id="form">
        <div class="input-div">
          <div class="input-div">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= $this->data['title']?>" placeholder="Insert title...">
            <p id="title-alert" class="alert hidden"></p>
          </div>

          <div class="input-div">
            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" value="<?= $this->data['desc']?>" placeholder="Insert description...">
            <p id="desc-alert" class="alert hidden"></p>
          </div>

          <div class="hstack">
            <div class="input-div">
              <label for="tag">Tag</label>
              <select name="tag" id="tag" value="<?= $this->data['tag']?>">
                <option value="">--Choose tag--</option>
                <option value="appetizer" selected="<?= $this->data['tag'] == 'appetizer' ?>">Appetizer</option>
                <option value="main course" selected="<?= $this->data['tag'] == 'main course' ?>">Main Course</option>
                <option value="dessert" selected="<?= $this->data['tag'] == 'dessert' ?>">Dessert</option>
                <option value="full course" selected="<?= $this->data['tag'] == 'full course' ?>">Full Course</option>
              </select>
              <p id="tag-alert" class="alert hidden"></p>
            </div>

            <div class="divider"></div>

            <div class="input-div">
              <label for="difficulty">Difficulty</label>
              <select name="difficulty" id="difficulty">
                <option value="">--Choose difficulty--</option>
                <option value="easy" selected="<?= $this->data['difficulty'] == 'easy' ?>">Easy</option>
                <option value="medium" selected="<?= $this->data['difficulty'] == 'medium' ?>">Medium</option>
                <option value="hard" selected="<?= $this->data['difficulty'] == 'hard' ?>">Hard</option>
              </select>
              <p id="difficulty-alert" class="alert hidden"></p>
            </div>
          </div>

          <div class="input-div">
            <label for="video">Change Recipe Video (.mp4)</label>
            <input type="file" id="video" name="video" accept="video/mp4">
          </div>

          <div class="input-div">
            <label for="image">Change Recipe Thumbnail Image (.jpg/.jpeg/.png)</label>
              <input type="file" id="image" name="image" accept="image/png, image/jpeg">
          </div>

          <p id="result-alert" class="alert hidden">Recipe successfully added!</p>

          <div class="button-div">
            <button id="button cancel" class="button cancel"><a href="<?= BASE_URL . '/recipe/watch/' . $this->data['recipe_id'] ?>">Cancel</a></button>
            <input id="edit-button" type="button" class="button add" value="Edit Recipe">
          </div>
        </div>
      </form>
    </div>
  <?php endif; ?>
</body>

</html>
